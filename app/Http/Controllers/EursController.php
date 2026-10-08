<?php

namespace App\Http\Controllers;

use App\Models\Eurs;
use App\Models\EursActivityLog;
use App\Models\EursAttachment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;

class EursController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DEPARTMENTS
    |--------------------------------------------------------------------------
    */

    private function departments(): array
    {
        return [
            'IT',
            'Marketing & Souvenir',
            'Gimmick gifts',
            'Technical Service',
            'Production',
            'Quality',
            'Mechanical Engineering & EHS',
            'General Affair / Plant Admin',
            'Continuous Improvement',
            'Supply Chain',
            'CAPEX Project',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVER MAPPING
    |--------------------------------------------------------------------------
    */

    private function approverMapping(): array
    {
        return [
            'IT' =>
                'lisnawati.josefina@ma.taisho.co.id',

            'Marketing & Souvenir' =>
                null,

            'Gimmick gifts' =>
                null,

            'Technical Service' =>
                'rustianti.wijaya@ma.taisho.co.id',

            'Production' =>
                'tubagus.rahmaputra@ma.taisho.co.id',

            'Quality' =>
                'rica.rahmawati@ma.taisho.co.id',

            'Mechanical Engineering & EHS' =>
                'jatmiko.setyadi@ma.taisho.co.id',

            'General Affair / Plant Admin' =>
                'Naomi.Rentauli@ma.taisho.co.id',

            'Continuous Improvement' =>
                null,

            'Supply Chain' =>
                'ika.kartikaningrum@ma.taisho.co.id',

            'CAPEX Project' =>
                'jatmiko.setyadi@ma.taisho.co.id',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALIZE UNIT PRICE
    |--------------------------------------------------------------------------
    */

    private function normalizeMoney($value): float
    {
        if ($value === null || $value === '') {
            return 0;
        }

        $value = trim((string) $value);

        if (
            str_contains($value, '.') &&
            str_contains($value, ',')
        ) {
            $lastDot =
                strrpos($value, '.');

            $lastComma =
                strrpos($value, ',');

            if ($lastComma > $lastDot) {

                /*
                | 1.500,50
                */

                $value =
                    str_replace(
                        '.',
                        '',
                        $value
                    );

                $value =
                    str_replace(
                        ',',
                        '.',
                        $value
                    );

            } else {

                /*
                | 1,500.50
                */

                $value =
                    str_replace(
                        ',',
                        '',
                        $value
                    );
            }
        }

        elseif (
            str_contains($value, ',')
        ) {
            $parts =
                explode(
                    ',',
                    $value
                );

            if (
                count($parts) === 2 &&
                strlen($parts[1]) <= 2
            ) {

                /*
                | 1500,50
                */

                $value =
                    str_replace(
                        ',',
                        '.',
                        $value
                    );

            } else {

                /*
                | 1,500
                */

                $value =
                    str_replace(
                        ',',
                        '',
                        $value
                    );
            }
        }

        elseif (
            str_contains($value, '.')
        ) {
            $parts =
                explode(
                    '.',
                    $value
                );

            if (
                count($parts) === 2 &&
                strlen($parts[1]) <= 2
            ) {

                /*
                | 1500.50
                */

            } else {

                /*
                | 1.500
                */

                $value =
                    str_replace(
                        '.',
                        '',
                        $value
                    );
            }
        }

        $value =
            preg_replace(
                '/[^0-9.\-]/',
                '',
                $value
            );

        return (float) $value;
    }


    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function userDashboard()
    {
        $user =
            Auth::user();

        $userRequests =
            Eurs::where(
                'user_id',
                $user->id
            );

        $stats = [

            'total' =>
                (clone $userRequests)
                    ->count(),

            'review' =>
                (clone $userRequests)
                    ->whereIn(
                        'status',
                        [
                            'submitted',
                            'ehs_in_review',
                            'pending_approval',
                        ]
                    )
                    ->count(),

            'approved' =>
                (clone $userRequests)
                    ->whereIn(
                        'status',
                        [
                            'approved',
                            'approved_with_note',
                        ]
                    )
                    ->count(),

            'rejected' =>
                (clone $userRequests)
                    ->where(
                        'status',
                        'rejected'
                    )
                    ->count(),

        ];

        $recentRequests =
            Eurs::where(
                'user_id',
                $user->id
            )
                ->latest('created_at')
                ->take(5)
                ->get();

        return view(
            'dashboard.user',
            compact(
                'stats',
                'recentRequests'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - E-URS INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user =
            Auth::user();

        $eurs =
            Eurs::where(
                'user_id',
                $user->id
            )
                ->latest('created_at')
                ->get();

        return view(
            'urs.index',
            compact('eurs')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - CREATE E-URS
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $user =
            Auth::user();

        $departments =
            $this->departments();

        $approverMapping =
            $this->approverMapping();

        return view(
            'urs.create',
            compact(
                'user',
                'departments',
                'approverMapping'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - STORE E-URS
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request
    ) {
        $user =
            Auth::user();

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated =
            $request->validate([

                /*
                |--------------------------------------------------------------------------
                | GENERAL
                |--------------------------------------------------------------------------
                */

                'department' => [
                    'required',
                    'string',
                    'in:' .
                        implode(
                            ',',
                            $this->departments()
                        ),
                ],

                'requires_ehs' => [
                    'required',
                    'boolean',
                ],

                'supplier_recommendation' => [
                    'required',
                    'in:Punya Rekomendasi,Tidak Punya Rekomendasi',
                ],


                /*
                |--------------------------------------------------------------------------
                | SUPPLIER
                |--------------------------------------------------------------------------
                */

                'reference_supplier' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'supplier_contact_person' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'supplier_contact' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'supplier_quotation_file' => [
                    'nullable',
                    'file',
                    'max:10240',
                    'mimes:pdf,jpg,jpeg,png',
                ],

                'procurement_sla_date' => [
                    'nullable',
                    'date',
                ],


                /*
                |--------------------------------------------------------------------------
                | ADDITIONAL FILES
                |--------------------------------------------------------------------------
                */

                'attachments' => [
                    'nullable',
                    'array',
                ],

                'attachments.*' => [
                    'file',
                    'max:10240',
                    'mimes:pdf,jpg,jpeg,png',
                ],


                /*
                |--------------------------------------------------------------------------
                | REQUIREMENT
                |--------------------------------------------------------------------------
                */

                'item_service_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'special_requirements' => [
                    'nullable',
                    'string',
                    'max:5000',
                ],

                'quantity' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'unit' => [
                    'required',
                    'string',
                    'max:100',
                ],


                /*
                |--------------------------------------------------------------------------
                | CURRENCY
                |--------------------------------------------------------------------------
                */

                'currency' => [
                    'required',
                    'in:IDR,USD,EUR,JPY,CHF',
                ],


                /*
                |--------------------------------------------------------------------------
                | UNIT PRICE
                |--------------------------------------------------------------------------
                */

                'unit_price' => [
                    'required',
                    'string',
                    'max:50',
                ],

                'expected_arrival_date' => [
                    'required',
                    'date',
                ],


                /*
                |--------------------------------------------------------------------------
                | BRAND
                |--------------------------------------------------------------------------
                */

                'preferred_brand' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'alternative_brand' => [
                    'nullable',
                    'string',
                    'max:255',
                ],


                /*
                |--------------------------------------------------------------------------
                | TECHNICAL
                |--------------------------------------------------------------------------
                */

                'technical_description' => [
                    'required',
                    'string',
                    'max:10000',
                ],

                'technical_reference_file' => [
                    'nullable',
                    'file',
                    'max:10240',
                    'mimes:pdf,jpg,jpeg,png',
                ],


                /*
                |--------------------------------------------------------------------------
                | AMOUNT CATEGORY
                |--------------------------------------------------------------------------
                */

                'amount_category' => [
                    'required',
                    'in:below_50m,above_50m',
                ],


                /*
                |--------------------------------------------------------------------------
                | CAPEX
                |--------------------------------------------------------------------------
                */

                'capex_budget_number' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'capex_layout_file' => [
                    'nullable',
                    'file',
                    'max:10240',
                    'mimes:pdf,jpg,jpeg,png',
                ],


                /*
                |--------------------------------------------------------------------------
                | IT
                |--------------------------------------------------------------------------
                */

                'it_ram' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'it_internal_memory' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'it_connectivity' => [
                    'nullable',
                    'in:Wifi Only,E-SIM,Ethernet',
                ],

                'it_os' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'it_recommendation_details' => [
                    'nullable',
                    'string',
                    'max:5000',
                ],

            ]);


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE UNIT PRICE
        |--------------------------------------------------------------------------
        */

        $unitPrice =
            $this->normalizeMoney(
                $validated['unit_price']
            );


        if ($unitPrice < 0) {

            return back()
                ->withInput()
                ->withErrors([
                    'unit_price' =>
                        'Unit Price must be a valid number.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CALCULATE AMOUNT ACTUAL
        |--------------------------------------------------------------------------
        */

        $quantity =
            (int) $validated['quantity'];

        $amountActual =
            $quantity * $unitPrice;


        /*
        |--------------------------------------------------------------------------
        | DEPARTMENT
        |--------------------------------------------------------------------------
        */

        $department =
            $validated['department'];


        /*
        |--------------------------------------------------------------------------
        | EHS
        |--------------------------------------------------------------------------
        */

        $requiresEhs =
            $request->boolean(
                'requires_ehs'
            );


        /*
        |--------------------------------------------------------------------------
        | SUPPLIER RECOMMENDATION
        |--------------------------------------------------------------------------
        */

        $hasSupplierRecommendation =
            $validated[
                'supplier_recommendation'
            ] ===
            'Punya Rekomendasi';


        /*
        |--------------------------------------------------------------------------
        | REQUEST NUMBER
        |--------------------------------------------------------------------------
        */

        $requestNumber =
            'URS-' .
            now()->format(
                'YmdHis'
            ) .
            '-' .
            strtoupper(
                Str::random(4)
            );


        /*
        |--------------------------------------------------------------------------
        | TECHNICAL FILE
        |--------------------------------------------------------------------------
        */

        $technicalReferencePath =
            null;

        if (
            $request->hasFile(
                'technical_reference_file'
            )
        ) {

            $technicalReferencePath =
                $request
                    ->file(
                        'technical_reference_file'
                    )
                    ->store(
                        'e-urs/technical',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | SUPPLIER QUOTATION
        |--------------------------------------------------------------------------
        */

        $supplierQuotationPath =
            null;

        if (
            $request->hasFile(
                'supplier_quotation_file'
            )
        ) {

            $supplierQuotationPath =
                $request
                    ->file(
                        'supplier_quotation_file'
                    )
                    ->store(
                        'e-urs/supplier',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | CAPEX FILE
        |--------------------------------------------------------------------------
        */

        $capexLayoutPath =
            null;

        if (
            $department === 'CAPEX Project' &&
            $request->hasFile(
                'capex_layout_file'
            )
        ) {

            $capexLayoutPath =
                $request
                    ->file(
                        'capex_layout_file'
                    )
                    ->store(
                        'e-urs/capex',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | APPROVER
        |--------------------------------------------------------------------------
        */

        $approverEmail =
            $this->approverMapping()[
                $department
            ] ?? null;


        /*
        |--------------------------------------------------------------------------
        | INITIAL STATUS
        |--------------------------------------------------------------------------
        */

        if ($requiresEhs) {

            $initialStatus =
                'submitted';

            $currentStage =
                'EHS Review';

            $ehsStatus =
                'pending';

        } else {

            $initialStatus =
                'pending_approval';

            $currentStage =
                'Pending Approval';

            $ehsStatus =
                null;
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE E-URS
        |--------------------------------------------------------------------------
        */

        $eurs =
            new Eurs();

        $eurs->forceFill([

            'request_number' =>
                $requestNumber,

            'user_id' =>
                $user->id,

            'department' =>
                $department,

            'requires_ehs' =>
                $requiresEhs,

            'ehs_status' =>
                $ehsStatus,


            /*
            |--------------------------------------------------------------------------
            | REQUIREMENT
            |--------------------------------------------------------------------------
            */

            'item_service_name' =>
                $validated[
                    'item_service_name'
                ],

            'special_requirements' =>
                $validated[
                    'special_requirements'
                ] ?? null,

            'quantity' =>
                $quantity,

            'unit' =>
                $validated['unit'],

            'currency' =>
                $validated['currency'],

            'unit_price' =>
                $unitPrice,

            'amount_actual' =>
                $amountActual,

            'expected_arrival_date' =>
                $validated[
                    'expected_arrival_date'
                ],


            /*
            |--------------------------------------------------------------------------
            | BRAND
            |--------------------------------------------------------------------------
            */

            'preferred_brand' =>
                $validated[
                    'preferred_brand'
                ] ?? null,

            'alternative_brand' =>
                $validated[
                    'alternative_brand'
                ] ?? null,


            /*
            |--------------------------------------------------------------------------
            | TECHNICAL
            |--------------------------------------------------------------------------
            */

            'technical_description' =>
                $validated[
                    'technical_description'
                ],

            'technical_reference_file' =>
                $technicalReferencePath,


            /*
            |--------------------------------------------------------------------------
            | SUPPLIER
            |--------------------------------------------------------------------------
            */

            'supplier_recommendation' =>
                $validated[
                    'supplier_recommendation'
                ],

            'reference_supplier' =>
                $hasSupplierRecommendation
                    ? (
                        $validated[
                            'reference_supplier'
                        ] ?? null
                    )
                    : null,

            'supplier_contact_person' =>
                $hasSupplierRecommendation
                    ? (
                        $validated[
                            'supplier_contact_person'
                        ] ?? null
                    )
                    : null,

            'supplier_contact' =>
                $hasSupplierRecommendation
                    ? (
                        $validated[
                            'supplier_contact'
                        ] ?? null
                    )
                    : null,

            'supplier_quotation_file' =>
                $supplierQuotationPath,


            /*
            |--------------------------------------------------------------------------
            | PROCUREMENT SLA
            |--------------------------------------------------------------------------
            */

            'procurement_sla_date' =>
                !$hasSupplierRecommendation
                    ? (
                        $validated[
                            'procurement_sla_date'
                        ] ?? null
                    )
                    : null,


            /*
            |--------------------------------------------------------------------------
            | AMOUNT CATEGORY
            |--------------------------------------------------------------------------
            */

            'amount_category' =>
                $validated[
                    'amount_category'
                ],


            /*
            |--------------------------------------------------------------------------
            | CAPEX
            |--------------------------------------------------------------------------
            */

            'capex_budget_number' =>
                $department === 'CAPEX Project'
                    ? (
                        $validated[
                            'capex_budget_number'
                        ] ?? null
                    )
                    : null,

            'capex_layout_file' =>
                $capexLayoutPath,


            /*
            |--------------------------------------------------------------------------
            | IT
            |--------------------------------------------------------------------------
            */

            'it_ram' =>
                $department === 'IT'
                    ? (
                        $validated[
                            'it_ram'
                        ] ?? null
                    )
                    : null,

            'it_connectivity' =>
                $department === 'IT'
                    ? (
                        $validated[
                            'it_connectivity'
                        ] ?? null
                    )
                    : null,

            'it_internal_memory' =>
                $department === 'IT'
                    ? (
                        $validated[
                            'it_internal_memory'
                        ] ?? null
                    )
                    : null,

            'it_os' =>
                $department === 'IT'
                    ? (
                        $validated[
                            'it_os'
                        ] ?? null
                    )
                    : null,

            'it_recommendation_details' =>
                $department === 'IT'
                    ? (
                        $validated[
                            'it_recommendation_details'
                        ] ?? null
                    )
                    : null,


            /*
            |--------------------------------------------------------------------------
            | APPROVAL
            |--------------------------------------------------------------------------
            */

            'approver_email' =>
                $approverEmail,

            'submitted_at' =>
                now(),

            'status' =>
                $initialStatus,

            'current_stage' =>
                $currentStage,

        ]);

        $eurs->save();


        /*
        |--------------------------------------------------------------------------
        | ADDITIONAL FILES
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile('attachments')
        ) {

            foreach (
                $request->file('attachments')
                as $file
            ) {

                if (!$file->isValid()) {
                    continue;
                }

                $path =
                    $file->store(
                        'e-urs/attachments',
                        'public'
                    );

                EursAttachment::create([

                    'e_urs_id' =>
                        $eurs->id,

                    'file_name' =>
                        $file->getClientOriginalName(),

                    'file_path' =>
                        $path,

                    'file_type' =>
                        $file->getMimeType(),

                    'file_size' =>
                        $file->getSize(),

                    'attachment_type' =>
                        'additional',

                    'uploaded_by' =>
                        $user->id,

                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOG
        |--------------------------------------------------------------------------
        */

        $activity =
            new EursActivityLog();

        $activity->forceFill([

            'e_urs_id' =>
                $eurs->id,

            'user_id' =>
                $user->id,

            'activity' =>
                'E-URS Submitted',

            'description' =>
                $requiresEhs
                    ? 'User submitted a new Electronic User Requirement Specification. EHS assessment is required.'
                    : 'User submitted a new Electronic User Requirement Specification.',

            'old_status' =>
                null,

            'new_status' =>
                $eurs->status,

            'ip_address' =>
                $request->ip(),

        ]);

        $activity->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'user.eurs.show',
                $eurs->id
            )
            ->with(
                'success',
                'E-URS has been submitted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - SHOW E-URS
    |--------------------------------------------------------------------------
    */

    public function show(
        Eurs $eurs
    ) {
        $user =
            Auth::user();

        if (
            $user->role === 'user' &&
            $eurs->user_id !== $user->id
        ) {
            abort(403);
        }

        $eurs->load([
            'user',
            'approvals',
            'attachments',
            'activityLogs',
        ]);

        return view(
            'urs.show',
            compact('eurs')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - TECHNICAL REFERENCE FILE
    |--------------------------------------------------------------------------
    */

    public function technicalFile(
        Eurs $eurs
    ) {
        $user =
            Auth::user();

        if (
            $user->role === 'user' &&
            $eurs->user_id !== $user->id
        ) {
            abort(403);
        }

        $path =
            $eurs->technical_reference_file;

        if (
            empty($path)
        ) {
            abort(
                404,
                'Technical reference file not found.'
            );
        }

        if (
            !Storage::disk('public')
                ->exists($path)
        ) {
            abort(
                404,
                'Technical reference file not found.'
            );
        }

        $fullPath =
            Storage::disk('public')
                ->path($path);

        $mimeType =
            Storage::disk('public')
                ->mimeType($path)
                ?: 'application/octet-stream';

        return response()->file(
            $fullPath,
            [
                'Content-Type' =>
                    $mimeType,

                'Content-Disposition' =>
                    'inline; filename="' .
                    basename($path) .
                    '"',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - ADDITIONAL ATTACHMENT FILE
    |--------------------------------------------------------------------------
    */

    public function attachmentFile(
        Eurs $eurs,
        EursAttachment $attachment
    ) {
        $user =
            Auth::user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY - E-URS OWNER
        |--------------------------------------------------------------------------
        */

        if (
            $user->role === 'user' &&
            $eurs->user_id !== $user->id
        ) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | SECURITY - ATTACHMENT BELONGS TO E-URS
        |--------------------------------------------------------------------------
        */

        if (
            (int) $attachment->e_urs_id !==
            (int) $eurs->id
        ) {
            abort(
                404,
                'Attachment not found.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILE PATH
        |--------------------------------------------------------------------------
        */

        $path =
            $attachment->file_path;

        if (
            empty($path)
        ) {
            abort(
                404,
                'Attachment file not found.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILE EXISTS
        |--------------------------------------------------------------------------
        */

        if (
            !Storage::disk('public')
                ->exists($path)
        ) {
            abort(
                404,
                'Attachment file not found.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FULL PATH
        |--------------------------------------------------------------------------
        */

        $fullPath =
            Storage::disk('public')
                ->path($path);


        /*
        |--------------------------------------------------------------------------
        | MIME TYPE
        |--------------------------------------------------------------------------
        */

        $mimeType =
            $attachment->file_type
            ?: Storage::disk('public')
                ->mimeType($path)
            ?: 'application/octet-stream';


        /*
        |--------------------------------------------------------------------------
        | DISPLAY INLINE
        |--------------------------------------------------------------------------
        */

        return response()->file(
            $fullPath,
            [
                'Content-Type' =>
                    $mimeType,

                'Content-Disposition' =>
                    'inline; filename="' .
                    basename(
                        $attachment->file_name
                        ?: $path
                    ) .
                    '"',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - EDIT REJECTED E-URS
    |--------------------------------------------------------------------------
    */

    public function edit(
        Eurs $eurs
    ) {
        $user =
            Auth::user();

        if (
            $user->role === 'user' &&
            $eurs->user_id !== $user->id
        ) {
            abort(403);
        }

        if (
            $eurs->status !== 'rejected'
        ) {

            return redirect()
                ->route(
                    'user.eurs.show',
                    $eurs->id
                )
                ->withErrors([
                    'edit' =>
                        'Only rejected E-URS can be edited.',
                ]);
        }

        $eurs->load([
            'user',
            'approvals',
            'attachments',
            'activityLogs',
        ]);

        $departments =
            $this->departments();

        $approverMapping =
            $this->approverMapping();

        return view(
            'urs.edit',
            compact(
                'eurs',
                'user',
                'departments',
                'approverMapping'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - UPDATE REJECTED E-URS
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Eurs $eurs
    ) {
        $user =
            Auth::user();

        if (
            $user->role === 'user' &&
            $eurs->user_id !== $user->id
        ) {
            abort(403);
        }

        if (
            $eurs->status !== 'rejected'
        ) {

            return redirect()
                ->route(
                    'user.eurs.show',
                    $eurs->id
                )
                ->withErrors([
                    'edit' =>
                        'Only rejected E-URS can be revised.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated =
            $request->validate([

                'department' => [
                    'required',
                    'string',
                    'in:' .
                        implode(
                            ',',
                            $this->departments()
                        ),
                ],

                'requires_ehs' => [
                    'required',
                    'boolean',
                ],

                'supplier_recommendation' => [
                    'required',
                    'in:Punya Rekomendasi,Tidak Punya Rekomendasi',
                ],

                'reference_supplier' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'supplier_contact_person' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'supplier_contact' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'supplier_quotation_file' => [
                    'nullable',
                    'file',
                    'max:10240',
                    'mimes:pdf,jpg,jpeg,png',
                ],

                'procurement_sla_date' => [
                    'nullable',
                    'date',
                ],


                /*
                |--------------------------------------------------------------------------
                | ADDITIONAL FILES
                |--------------------------------------------------------------------------
                */

                'attachments' => [
                    'nullable',
                    'array',
                ],

                'attachments.*' => [
                    'file',
                    'max:10240',
                    'mimes:pdf,jpg,jpeg,png',
                ],


                'item_service_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'special_requirements' => [
                    'nullable',
                    'string',
                    'max:5000',
                ],

                'quantity' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'unit' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'currency' => [
                    'required',
                    'in:IDR,USD,EUR,JPY,CHF',
                ],

                'unit_price' => [
                    'required',
                    'string',
                    'max:50',
                ],

                'expected_arrival_date' => [
                    'required',
                    'date',
                ],

                'preferred_brand' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'alternative_brand' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'technical_description' => [
                    'required',
                    'string',
                    'max:10000',
                ],

                'technical_reference_file' => [
                    'nullable',
                    'file',
                    'max:10240',
                    'mimes:pdf,jpg,jpeg,png',
                ],

                'amount_category' => [
                    'required',
                    'in:below_50m,above_50m',
                ],

                'capex_budget_number' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'capex_layout_file' => [
                    'nullable',
                    'file',
                    'max:10240',
                    'mimes:pdf,jpg,jpeg,png',
                ],

                'it_ram' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'it_internal_memory' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'it_connectivity' => [
                    'nullable',
                    'in:Wifi Only,E-SIM,Ethernet',
                ],

                'it_os' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'it_recommendation_details' => [
                    'nullable',
                    'string',
                    'max:5000',
                ],

            ]);


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE UNIT PRICE
        |--------------------------------------------------------------------------
        */

        $unitPrice =
            $this->normalizeMoney(
                $validated['unit_price']
            );

        if (
            $unitPrice < 0
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'unit_price' =>
                        'Unit Price must be a valid number.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CALCULATE AMOUNT ACTUAL
        |--------------------------------------------------------------------------
        */

        $quantity =
            (int) $validated['quantity'];

        $amountActual =
            $quantity * $unitPrice;


        /*
        |--------------------------------------------------------------------------
        | DEPARTMENT
        |--------------------------------------------------------------------------
        */

        $department =
            $validated['department'];


        /*
        |--------------------------------------------------------------------------
        | EHS
        |--------------------------------------------------------------------------
        */

        $requiresEhs =
            $request->boolean(
                'requires_ehs'
            );


        /*
        |--------------------------------------------------------------------------
        | SUPPLIER RECOMMENDATION
        |--------------------------------------------------------------------------
        */

        $hasSupplierRecommendation =
            $validated[
                'supplier_recommendation'
            ] ===
            'Punya Rekomendasi';


        /*
        |--------------------------------------------------------------------------
        | TECHNICAL FILE
        |--------------------------------------------------------------------------
        */

        $technicalReferencePath =
            $eurs->technical_reference_file;

        if (
            $request->hasFile(
                'technical_reference_file'
            )
        ) {

            if (
                !empty(
                    $eurs->technical_reference_file
                )
            ) {

                Storage::disk('public')
                    ->delete(
                        $eurs->technical_reference_file
                    );
            }

            $technicalReferencePath =
                $request
                    ->file(
                        'technical_reference_file'
                    )
                    ->store(
                        'e-urs/technical',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | SUPPLIER QUOTATION
        |--------------------------------------------------------------------------
        */

        $supplierQuotationPath =
            $eurs->supplier_quotation_file;

        if (
            $request->hasFile(
                'supplier_quotation_file'
            )
        ) {

            if (
                !empty(
                    $eurs->supplier_quotation_file
                )
            ) {

                Storage::disk('public')
                    ->delete(
                        $eurs->supplier_quotation_file
                    );
            }

            $supplierQuotationPath =
                $request
                    ->file(
                        'supplier_quotation_file'
                    )
                    ->store(
                        'e-urs/supplier',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | CAPEX FILE
        |--------------------------------------------------------------------------
        */

        $capexLayoutPath =
            $eurs->capex_layout_file;

        if (
            $department === 'CAPEX Project' &&
            $request->hasFile(
                'capex_layout_file'
            )
        ) {

            if (
                !empty(
                    $eurs->capex_layout_file
                )
            ) {

                Storage::disk('public')
                    ->delete(
                        $eurs->capex_layout_file
                    );
            }

            $capexLayoutPath =
                $request
                    ->file(
                        'capex_layout_file'
                    )
                    ->store(
                        'e-urs/capex',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | APPROVER
        |--------------------------------------------------------------------------
        */

        $approverEmail =
            $this->approverMapping()[
                $department
            ] ?? null;


        /*
        |--------------------------------------------------------------------------
        | NEW STATUS
        |--------------------------------------------------------------------------
        */

        if ($requiresEhs) {

            $newStatus =
                'submitted';

            $currentStage =
                'EHS Review';

            $ehsStatus =
                'pending';

        } else {

            $newStatus =
                'pending_approval';

            $currentStage =
                'Pending Approval';

            $ehsStatus =
                null;
        }


        /*
        |--------------------------------------------------------------------------
        | OLD STATUS
        |--------------------------------------------------------------------------
        */

        $oldStatus =
            $eurs->status;


        /*
        |--------------------------------------------------------------------------
        | UPDATE EXISTING E-URS
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $eurs,
                $validated,
                $department,
                $requiresEhs,
                $hasSupplierRecommendation,
                $technicalReferencePath,
                $supplierQuotationPath,
                $capexLayoutPath,
                $approverEmail,
                $newStatus,
                $currentStage,
                $ehsStatus,
                $quantity,
                $unitPrice,
                $amountActual,
                $oldStatus,
                $user,
                $request
            ) {

                $eurs->forceFill([

                    'department' =>
                        $department,

                    'requires_ehs' =>
                        $requiresEhs,

                    'ehs_status' =>
                        $ehsStatus,

                    'item_service_name' =>
                        $validated[
                            'item_service_name'
                        ],

                    'special_requirements' =>
                        $validated[
                            'special_requirements'
                        ] ?? null,

                    'quantity' =>
                        $quantity,

                    'unit' =>
                        $validated['unit'],

                    'currency' =>
                        $validated['currency'],

                    'unit_price' =>
                        $unitPrice,

                    'amount_actual' =>
                        $amountActual,

                    'expected_arrival_date' =>
                        $validated[
                            'expected_arrival_date'
                        ],

                    'preferred_brand' =>
                        $validated[
                            'preferred_brand'
                        ] ?? null,

                    'alternative_brand' =>
                        $validated[
                            'alternative_brand'
                        ] ?? null,

                    'technical_description' =>
                        $validated[
                            'technical_description'
                        ],

                    'technical_reference_file' =>
                        $technicalReferencePath,

                    'supplier_recommendation' =>
                        $validated[
                            'supplier_recommendation'
                        ],

                    'reference_supplier' =>
                        $hasSupplierRecommendation
                            ? (
                                $validated[
                                    'reference_supplier'
                                ] ?? null
                            )
                            : null,

                    'supplier_contact_person' =>
                        $hasSupplierRecommendation
                            ? (
                                $validated[
                                    'supplier_contact_person'
                                ] ?? null
                            )
                            : null,

                    'supplier_contact' =>
                        $hasSupplierRecommendation
                            ? (
                                $validated[
                                    'supplier_contact'
                                ] ?? null
                            )
                            : null,

                    'supplier_quotation_file' =>
                        $supplierQuotationPath,

                    'procurement_sla_date' =>
                        !$hasSupplierRecommendation
                            ? (
                                $validated[
                                    'procurement_sla_date'
                                ] ?? null
                            )
                            : null,

                    'amount_category' =>
                        $validated[
                            'amount_category'
                        ],

                    'capex_budget_number' =>
                        $department === 'CAPEX Project'
                            ? (
                                $validated[
                                    'capex_budget_number'
                                ] ?? null
                            )
                            : null,

                    'capex_layout_file' =>
                        $capexLayoutPath,

                    'it_ram' =>
                        $department === 'IT'
                            ? (
                                $validated[
                                    'it_ram'
                                ] ?? null
                            )
                            : null,

                    'it_internal_memory' =>
                        $department === 'IT'
                            ? (
                                $validated[
                                    'it_internal_memory'
                                ] ?? null
                            )
                            : null,

                    'it_connectivity' =>
                        $department === 'IT'
                            ? (
                                $validated[
                                    'it_connectivity'
                                ] ?? null
                            )
                            : null,

                    'it_os' =>
                        $department === 'IT'
                            ? (
                                $validated[
                                    'it_os'
                                ] ?? null
                            )
                            : null,

                    'it_recommendation_details' =>
                        $department === 'IT'
                            ? (
                                $validated[
                                    'it_recommendation_details'
                                ] ?? null
                            )
                            : null,

                    'approver_email' =>
                        $approverEmail,

                    'submitted_at' =>
                        now(),

                    'status' =>
                        $newStatus,

                    'current_stage' =>
                        $currentStage,

                    'ehs_notes' =>
                        null,

                    'ehs_reviewed_at' =>
                        null,

                ]);

                $eurs->save();


                /*
                |--------------------------------------------------------------------------
                | ADDITIONAL FILES DURING RESUBMIT
                |--------------------------------------------------------------------------
                */

                if (
                    $request->hasFile('attachments')
                ) {

                    foreach (
                        $request->file('attachments')
                        as $file
                    ) {

                        if (!$file->isValid()) {
                            continue;
                        }

                        $path =
                            $file->store(
                                'e-urs/attachments',
                                'public'
                            );

                        EursAttachment::create([

                            'e_urs_id' =>
                                $eurs->id,

                            'file_name' =>
                                $file->getClientOriginalName(),

                            'file_path' =>
                                $path,

                            'file_type' =>
                                $file->getMimeType(),

                            'file_size' =>
                                $file->getSize(),

                            'attachment_type' =>
                                'additional',

                            'uploaded_by' =>
                                $user->id,

                        ]);
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | ACTIVITY LOG
                |--------------------------------------------------------------------------
                */

                $activity =
                    new EursActivityLog();

                $activity->forceFill([

                    'e_urs_id' =>
                        $eurs->id,

                    'user_id' =>
                        $user->id,

                    'activity' =>
                        'E-URS Resubmitted',

                    'description' =>
                        'User revised the rejected E-URS and resubmitted the same E-URS for review.',

                    'old_status' =>
                        $oldStatus,

                    'new_status' =>
                        $newStatus,

                    'ip_address' =>
                        $request->ip(),

                ]);

                $activity->save();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'user.eurs.show',
                $eurs->id
            )
            ->with(
                'success',
                'E-URS has been revised and resubmitted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | USER - PDF
    |--------------------------------------------------------------------------
    */

   public function pdf(Eurs $eurs)
{
    /*
    |--------------------------------------------------------------------------
    | LOAD DATA
    |--------------------------------------------------------------------------
    */

    $eurs->load([
        'user',
        'approvals',
        'attachments',
    ]);


    /*
    |--------------------------------------------------------------------------
    | TEMP DIRECTORY
    |--------------------------------------------------------------------------
    */

    $tempDirectory = storage_path('app/temp');

    if (!is_dir($tempDirectory)) {
        mkdir($tempDirectory, 0777, true);
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE URS PDF
    |--------------------------------------------------------------------------
    */

    $fileName = 'E-URS-' . ($eurs->request_number ?? $eurs->id);

    $ursTempPath =
        $tempDirectory .
        DIRECTORY_SEPARATOR .
        $fileName .
        '-urs.pdf';


    $ursPdf = Pdf::loadView(
        'urs.pdf',
        [
            'eurs' => $eurs,
        ]
    );

    $ursPdf->setPaper(
        'a4',
        'portrait'
    );


    file_put_contents(
        $ursTempPath,
        $ursPdf->output()
    );


    /*
    |--------------------------------------------------------------------------
    | FINAL PDF
    |--------------------------------------------------------------------------
    */

    $finalPdf = new Fpdi();


    /*
    |--------------------------------------------------------------------------
    | 1. APPEND URS PDF
    |--------------------------------------------------------------------------
    */

    $this->appendPdfToFpdi(
        $finalPdf,
        $ursTempPath
    );


    /*
    |--------------------------------------------------------------------------
    | 2. APPEND TECHNICAL REFERENCE
    |--------------------------------------------------------------------------
    */

    if (
        !empty(
            $eurs->technical_reference_file
        )
    ) {

        $technicalPath =
            Storage::disk('public')->path(
                $eurs->technical_reference_file
            );


        if (
            file_exists($technicalPath)
        ) {

            $this->appendFileToFpdi(
                $finalPdf,
                $technicalPath
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | 3. APPEND ADDITIONAL FILES
    |--------------------------------------------------------------------------
    */

    foreach (
        $eurs->attachments
        ->sortBy('id')
        as $attachment
    ) {

        if (
            empty(
                $attachment->file_path
            )
        ) {
            continue;
        }


        $attachmentPath =
            Storage::disk('public')->path(
                $attachment->file_path
            );


        if (
            !file_exists(
                $attachmentPath
            )
        ) {
            continue;
        }


        $this->appendFileToFpdi(
            $finalPdf,
            $attachmentPath
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CLEAN TEMP URS PDF
    |--------------------------------------------------------------------------
    */

    if (
        file_exists($ursTempPath)
    ) {

        unlink($ursTempPath);

    }


    /*
    |--------------------------------------------------------------------------
    | OUTPUT
    |--------------------------------------------------------------------------
    */

    $output =
        $finalPdf->Output('S');


    return response(
        $output,
        200,
        [
            'Content-Type' =>
                'application/pdf',

            'Content-Disposition' =>
                'inline; filename="' .
                $fileName .
                '.pdf"',

            'Content-Length' =>
                strlen($output),
        ]
    );
}

/**
 * Append an existing PDF into the final FPDI document.
 */
private function appendPdfToFpdi(
    Fpdi $finalPdf,
    string $pdfPath
): void {

    if (
        !file_exists($pdfPath)
    ) {
        return;
    }


    $pageCount =
        $finalPdf->setSourceFile(
            $pdfPath
        );


    for (
        $pageNumber = 1;
        $pageNumber <= $pageCount;
        $pageNumber++
    ) {

        $template =
            $finalPdf->importPage(
                $pageNumber
            );


        $size =
            $finalPdf->getTemplateSize(
                $template
            );


        $orientation =
            $size['width'] >
            $size['height']
                ? 'L'
                : 'P';


        $finalPdf->AddPage(
            $orientation,
            [
                $size['width'],
                $size['height'],
            ]
        );


        $finalPdf->useTemplate(
            $template,
            0,
            0,
            $size['width'],
            $size['height']
        );

    }
}


/**
 * Append PDF / JPG / JPEG / PNG file.
 */
private function appendFileToFpdi(
    Fpdi $finalPdf,
    string $filePath
): void {

    if (
        !file_exists($filePath)
    ) {
        return;
    }


    $extension =
        strtolower(
            pathinfo(
                $filePath,
                PATHINFO_EXTENSION
            )
        );


    /*
    |--------------------------------------------------------------------------
    | PDF
    |--------------------------------------------------------------------------
    */

    if (
        $extension === 'pdf'
    ) {

        $this->appendPdfToFpdi(
            $finalPdf,
            $filePath
        );

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE
    |--------------------------------------------------------------------------
    */

    if (
        !in_array(
            $extension,
            [
                'jpg',
                'jpeg',
                'png',
            ],
            true
        )
    ) {

        return;

    }


    $imageInfo =
        @getimagesize(
            $filePath
        );


    if (
        !$imageInfo
    ) {
        return;
    }


    $imageWidth =
        $imageInfo[0];

    $imageHeight =
        $imageInfo[1];


    /*
    |--------------------------------------------------------------------------
    | LANDSCAPE / PORTRAIT
    |--------------------------------------------------------------------------
    */

    $isLandscape =
        $imageWidth >
        $imageHeight;


    if ($isLandscape) {

        $finalPdf->AddPage(
            'L',
            'A4'
        );

        $pageWidth = 297;
        $pageHeight = 210;

    } else {

        $finalPdf->AddPage(
            'P',
            'A4'
        );

        $pageWidth = 210;
        $pageHeight = 297;

    }


    /*
    |--------------------------------------------------------------------------
    | MARGIN
    |--------------------------------------------------------------------------
    */

    $margin = 10;


    $availableWidth =
        $pageWidth -
        ($margin * 2);


    $availableHeight =
        $pageHeight -
        ($margin * 2);


    /*
    |--------------------------------------------------------------------------
    | CALCULATE IMAGE SIZE
    |--------------------------------------------------------------------------
    */

    $ratioWidth =
        $availableWidth /
        $imageWidth;


    $ratioHeight =
        $availableHeight /
        $imageHeight;


    $ratio =
        min(
            $ratioWidth,
            $ratioHeight
        );


    $displayWidth =
        $imageWidth *
        $ratio;


    $displayHeight =
        $imageHeight *
        $ratio;


    /*
    |--------------------------------------------------------------------------
    | CENTER IMAGE
    |--------------------------------------------------------------------------
    */

    $x =
        ($pageWidth -
        $displayWidth) / 2;


    $y =
        ($pageHeight -
        $displayHeight) / 2;


    /*
    |--------------------------------------------------------------------------
    | ADD IMAGE
    |--------------------------------------------------------------------------
    */

    $finalPdf->Image(
        $filePath,
        $x,
        $y,
        $displayWidth,
        $displayHeight
    );
}

    /*
    |--------------------------------------------------------------------------
    | EHS DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function ehsDashboard()
    {
        $pendingRequests =
            Eurs::with('user')
                ->where(
                    'requires_ehs',
                    true
                )
                ->where(
                    'ehs_status',
                    'pending'
                )
                ->latest(
                    'submitted_at'
                )
                ->get();

        $inReviewRequests =
            Eurs::with('user')
                ->where(
                    'requires_ehs',
                    true
                )
                ->where(
                    'ehs_status',
                    'in_review'
                )
                ->latest(
                    'updated_at'
                )
                ->get();

        $approvedRequests =
            Eurs::with('user')
                ->where(
                    'requires_ehs',
                    true
                )
                ->where(
                    'ehs_status',
                    'approved'
                )
                ->latest(
                    'ehs_reviewed_at'
                )
                ->get();

        $rejectedRequests =
            Eurs::with('user')
                ->where(
                    'requires_ehs',
                    true
                )
                ->where(
                    'ehs_status',
                    'rejected'
                )
                ->latest(
                    'ehs_reviewed_at'
                )
                ->get();

        $stats = [

            'pending' =>
                $pendingRequests->count(),

            'in_review' =>
                $inReviewRequests->count(),

            'approved' =>
                $approvedRequests->count(),

            'rejected' =>
                $rejectedRequests->count(),

        ];

        return view(
            'ehs.dashboard',
            compact(
                'stats',
                'pendingRequests',
                'inReviewRequests',
                'approvedRequests',
                'rejectedRequests'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EHS REVIEW
    |--------------------------------------------------------------------------
    */

    public function ehsReview(
        Eurs $eurs
    ) {
        if (
            !$eurs->requires_ehs
        ) {
            abort(404);
        }

        if (
            $eurs->ehs_status ===
            'pending'
        ) {

            $oldStatus =
                $eurs->status;

            $eurs->forceFill([

                'ehs_status' =>
                    'in_review',

                'status' =>
                    'ehs_in_review',

                'current_stage' =>
                    'EHS Review',

            ]);

            $eurs->save();


            /*
            |--------------------------------------------------------------------------
            | ACTIVITY LOG
            |--------------------------------------------------------------------------
            */

            $activity =
                new EursActivityLog();

            $activity->forceFill([

                'e_urs_id' =>
                    $eurs->id,

                'user_id' =>
                    Auth::id(),

                'activity' =>
                    'EHS Review Started',

                'description' =>
                    'EHS has started reviewing the User Requirement Specification.',

                'old_status' =>
                    $oldStatus,

                'new_status' =>
                    'ehs_in_review',

                'ip_address' =>
                    request()->ip(),

            ]);

            $activity->save();
        }

        $eurs->load([
            'user',
            'attachments',
        ]);

        return view(
            'ehs.review',
            compact('eurs')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EHS APPROVE
    |--------------------------------------------------------------------------
    */

    public function ehsApprove(
        Request $request,
        Eurs $eurs
    ) {

        if (
            !$eurs->requires_ehs
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated =
            $request->validate([

                'assessment_ppe' => [
                    'required',
                    'in:Yes,No',
                ],

                'assessment_hazard' => [
                    'required',
                    'in:Yes,No',
                ],

                'assessment_asbestos' => [
                    'required',
                    'in:Yes,No',
                ],

                'assessment_ods' => [
                    'required',
                    'in:Yes,No',
                ],

                'assessment_toxic' => [
                    'required',
                    'in:Yes,No',
                ],

                'assessment_chemical' => [
                    'required',
                    'in:Yes,No',
                ],

                'ehs_notes' => [
                    'nullable',
                    'string',
                    'max:2000',
                ],

                'ehs_attachment' => [
                    'nullable',
                    'file',
                    'mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx',
                    'max:10240',
                ],

            ]);


        /*
        |--------------------------------------------------------------------------
        | CHECK STATUS
        |--------------------------------------------------------------------------
        */

        if (
            !in_array(
                $eurs->ehs_status,
                [
                    'pending',
                    'in_review',
                ],
                true
            )
        ) {

            return back()
                ->withErrors([
                    'ehs' =>
                        'This E-URS has already been processed by EHS.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | EHS ASSESSMENT SUMMARY
        |--------------------------------------------------------------------------
        */

        $assessmentSummary =
            "EHS Recommendation is specific for:\n" .
            "Please assess whether the requested material/service is related to the following:\n" .
            "1. APD/PPE : " .
            $validated['assessment_ppe'] .
            "\n" .
            "2. Alcohol/Explosive/Flammable/Combustible : " .
            $validated['assessment_hazard'] .
            "\n" .
            "3. Asbestos : " .
            $validated['assessment_asbestos'] .
            "\n" .
            "4. ODS : " .
            $validated['assessment_ods'] .
            "\n" .
            "5. Toxic Materials/Pesticides/Sanitation : " .
            $validated['assessment_toxic'] .
            "\n" .
            "6. Raw Material/New Chemical with MSDS : " .
            $validated['assessment_chemical'];


        /*
        |--------------------------------------------------------------------------
        | EHS NOTES
        |--------------------------------------------------------------------------
        */

        if (
            !empty(
                trim(
                    $validated['ehs_notes'] ?? ''
                )
            )
        ) {

            $assessmentSummary .=
                "\n\nEHS Recommendation / Notes:\n" .
                trim(
                    $validated['ehs_notes']
                );
        }


        /*
        |--------------------------------------------------------------------------
        | EHS ATTACHMENT
        |--------------------------------------------------------------------------
        */

        $ehsAttachmentPath =
            $eurs->ehs_attachment;

        if (
            $request->hasFile(
                'ehs_attachment'
            )
        ) {

            if (
                !empty(
                    $eurs->ehs_attachment
                )
            ) {

                Storage::disk('public')
                    ->delete(
                        $eurs->ehs_attachment
                    );
            }

            $ehsAttachmentPath =
                $request
                    ->file(
                        'ehs_attachment'
                    )
                    ->store(
                        'e-urs/ehs',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $eurs,
                $assessmentSummary,
                $ehsAttachmentPath
            ) {

                $oldStatus =
                    $eurs->status;

                $eurs->forceFill([

                    'ehs_status' =>
                        'approved',

                    'ehs_notes' =>
                        $assessmentSummary,

                    'ehs_attachment' =>
                        $ehsAttachmentPath,

                    'ehs_reviewed_at' =>
                        now(),

                    'status' =>
                        'pending_approval',

                    'current_stage' =>
                        'Pending Approval',

                ]);

                $eurs->save();


                /*
                |--------------------------------------------------------------------------
                | ACTIVITY LOG
                |--------------------------------------------------------------------------
                */

                $activity =
                    new EursActivityLog();

                $activity->forceFill([

                    'e_urs_id' =>
                        $eurs->id,

                    'user_id' =>
                        Auth::id(),

                    'activity' =>
                        'EHS Approved',

                    'description' =>
                        'EHS assessment has been approved. The User Requirement Specification is now waiting for Approval Person / Department Head approval.',

                    'old_status' =>
                        $oldStatus,

                    'new_status' =>
                        'pending_approval',

                    'ip_address' =>
                        request()->ip(),

                ]);

                $activity->save();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | RETURN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'ehs.dashboard'
            )
            ->with(
                'success',
                'EHS assessment has been approved. The E-URS is now waiting for Department Head approval.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EHS REJECT
    |--------------------------------------------------------------------------
    */

    public function ehsReject(
        Request $request,
        Eurs $eurs
    ) {

        if (
            !$eurs->requires_ehs
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated =
            $request->validate([

                'ehs_notes' => [
                    'required',
                    'string',
                    'max:2000',
                ],

            ]);


        /*
        |--------------------------------------------------------------------------
        | CHECK STATUS
        |--------------------------------------------------------------------------
        */

        if (
            !in_array(
                $eurs->ehs_status,
                [
                    'pending',
                    'in_review',
                ],
                true
            )
        ) {

            return back()
                ->withErrors([
                    'ehs' =>
                        'This E-URS has already been processed by EHS.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $oldStatus =
            $eurs->status;

        $eurs->forceFill([

            'ehs_status' =>
                'rejected',

            'ehs_notes' =>
                $validated['ehs_notes'],

            'ehs_reviewed_at' =>
                now(),

            'status' =>
                'rejected',

            'current_stage' =>
                'EHS Rejected',

        ]);

        $eurs->save();


        /*
        |--------------------------------------------------------------------------
        | ACTIVITY LOG
        |--------------------------------------------------------------------------
        */

        $activity =
            new EursActivityLog();

        $activity->forceFill([

            'e_urs_id' =>
                $eurs->id,

            'user_id' =>
                Auth::id(),

            'activity' =>
                'EHS Rejected',

            'description' =>
                'EHS has rejected the User Requirement Specification and returned it for revision.',

            'old_status' =>
                $oldStatus,

            'new_status' =>
                'rejected',

            'ip_address' =>
                $request->ip(),

        ]);

        $activity->save();


        /*
        |--------------------------------------------------------------------------
        | RETURN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'ehs.dashboard'
            )
            ->with(
                'success',
                'E-URS has been rejected and returned for revision.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EHS REVIEW LIST
    |--------------------------------------------------------------------------
    */

    public function ehsReviewList()
    {
        $pendingRequests =
            Eurs::with('user')
                ->where(
                    'requires_ehs',
                    true
                )
                ->where(
                    'ehs_status',
                    'pending'
                )
                ->latest(
                    'submitted_at'
                )
                ->get();

        $inReviewRequests =
            Eurs::with('user')
                ->where(
                    'requires_ehs',
                    true
                )
                ->where(
                    'ehs_status',
                    'in_review'
                )
                ->latest(
                    'updated_at'
                )
                ->get();

        $approvedRequests =
            Eurs::with('user')
                ->where(
                    'requires_ehs',
                    true
                )
                ->where(
                    'ehs_status',
                    'approved'
                )
                ->latest(
                    'ehs_reviewed_at'
                )
                ->get();

        $rejectedRequests =
            Eurs::with('user')
                ->where(
                    'requires_ehs',
                    true
                )
                ->where(
                    'ehs_status',
                    'rejected'
                )
                ->latest(
                    'ehs_reviewed_at'
                )
                ->get();

        return view(
            'ehs.review-index',
            compact(
                'pendingRequests',
                'inReviewRequests',
                'approvedRequests',
                'rejectedRequests'
            )
        );
    }
}