<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Eurs extends Model
{
    protected $table = 'e_urs';

    protected $fillable = [
        // =========================================================
        // BASIC INFORMATION
        // =========================================================
        'request_number',
        'user_id',
        'department',

        // =========================================================
        // EHS
        // =========================================================
        'requires_ehs',
        'ehs_status',
        'ehs_notes',
        'ehs_attachment',
        'ehs_reviewed_at',

        // =========================================================
        // REQUIREMENT
        // =========================================================
        'item_service_name',
        'requirement',
        'expected_arrival_date',
        'expected_date_of_delivery',

        // QUANTITY & PRICE
        'quantity',
        'unit',
        'currency',
        'unit_price',
        'amount_actual',

        // BRAND
        'preferred_brand',
        'brand',

        // SPECIFICATION
        'technical_description',
        'special_requirements',
        'technical_reference_file',

        // REFERENCE
        'reference_supplier',
        'reference_customer',

        // =========================================================
        // EHS RECOMMENDATION
        // =========================================================
        'ehs_recommendation',
        'ehs_recommendation_details',

        // =========================================================
        // APPROVAL
        // =========================================================
        'approver_email',
        'approval_token',
        'approved_at',
        'submitted_at',
        'status',
        'current_stage',
    ];

    protected $casts = [
        // =========================================================
        // BASIC
        // =========================================================
        'user_id' => 'integer',

        // =========================================================
        // EHS
        // =========================================================
        'requires_ehs' => 'boolean',
        'ehs_reviewed_at' => 'datetime',

        // =========================================================
        // REQUIREMENT
        // =========================================================
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'amount_actual' => 'decimal:2',
        'expected_arrival_date' => 'date',
        'expected_date_of_delivery' => 'date',

        // =========================================================
        // APPROVAL
        // =========================================================
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    // =============================================================
    // RELATIONSHIP : USER
    // =============================================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // =============================================================
    // RELATIONSHIP : APPROVALS
    // =============================================================

    public function approvals(): HasMany
    {
        return $this->hasMany(EursApproval::class, 'e_urs_id');
    }

    // =============================================================
    // RELATIONSHIP : ATTACHMENTS
    // =============================================================

    public function attachments(): HasMany
    {
        return $this->hasMany(EursAttachment::class, 'e_urs_id');
    }

    // =============================================================
    // RELATIONSHIP : ACTIVITY LOGS
    // =============================================================

    public function activityLogs(): HasMany
    {
        return $this->hasMany(EursActivityLog::class, 'e_urs_id');
    }
}