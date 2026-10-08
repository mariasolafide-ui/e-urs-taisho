<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show dashboard based on authenticated user's role.
     */
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {

            'user' => view('dashboard.user'),

            'ehs' => view('dashboard.ehs'),

            'procurement' => view('dashboard.procurement'),

            'admin' => view('dashboard.admin'),

            default => abort(403, 'Unauthorized role.'),
        };
    }

    public function show()
    {
        return view('dashboard.show');
    }

    public function edit()
    {
        return view('dashboard.edit');
    }

    public function update()
    {
        //
    }

}