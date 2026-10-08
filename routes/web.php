<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EursController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    AuthController::class,
    'showLogin'
])->name('login');

Route::post('/login', [
    AuthController::class,
    'login'
])->name('login.process');


/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register', [
    AuthController::class,
    'showRegister'
])->name('register');

Route::post('/register', [
    AuthController::class,
    'register'
])->name('register.process');


/*
|--------------------------------------------------------------------------
| EMAIL VERIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


/*
|--------------------------------------------------------------------------
| EMAIL VERIFICATION LINK
|--------------------------------------------------------------------------
*/

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();

    return redirect()->route('dashboard');

})->middleware([
    'auth',
    'signed',
    'throttle:6,1',
])->name('verification.verify');


/*
|--------------------------------------------------------------------------
| RESEND VERIFICATION EMAIL
|--------------------------------------------------------------------------
*/

Route::post('/email/verification-notification', function (Request $request) {

    $request->user()->sendEmailVerificationNotification();

    return back()->with(
        'status',
        'A new verification link has been sent to your email address.'
    );

})->middleware([
    'auth',
    'throttle:6,1',
])->name('verification.send');


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [
    AuthController::class,
    'logout'
])->name('logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | GENERAL DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        $user = auth()->user();

        switch ($user->role) {

            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'ehs':
                return redirect()->route('ehs.dashboard');

            case 'procurement':
                return redirect()->route('procurement.dashboard');

            case 'user':
                return redirect()->route('user.dashboard');

            default:
                abort(403);
        }

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/', [
                EursController::class,
                'adminDashboard'
            ])->name('dashboard');

        });


    /*
    |--------------------------------------------------------------------------
    | EHS
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:ehs')
        ->prefix('ehs')
        ->name('ehs.')
        ->group(function () {

            /*
            |--------------------------------------------------------------------------
            | EHS DASHBOARD
            |--------------------------------------------------------------------------
            */

            Route::get('/', [
                EursController::class,
                'ehsDashboard'
            ])->name('dashboard');


            /*
            |--------------------------------------------------------------------------
            | EHS REVIEW LIST
            |--------------------------------------------------------------------------
            */

            Route::get('/review', [
                EursController::class,
                'ehsReviewList'
            ])->name('review.list');


            /*
            |--------------------------------------------------------------------------
            | EHS REVIEW DETAIL
            |--------------------------------------------------------------------------
            */

            Route::get('/e-urs/{eurs}', [
                EursController::class,
                'ehsReview'
            ])->name('review');


            /*
            |--------------------------------------------------------------------------
            | EHS PDF
            |--------------------------------------------------------------------------
            */

            Route::get('/e-urs/{eurs}/pdf', [
                EursController::class,
                'pdf'
            ])->name('pdf');


            /*
            |--------------------------------------------------------------------------
            | EHS APPROVE
            |--------------------------------------------------------------------------
            */

            Route::post('/e-urs/{eurs}/approve', [
                EursController::class,
                'ehsApprove'
            ])->name('approve');


            /*
            |--------------------------------------------------------------------------
            | EHS REJECT
            |--------------------------------------------------------------------------
            */

            Route::post('/e-urs/{eurs}/reject', [
                EursController::class,
                'ehsReject'
            ])->name('reject');

        });


    /*
    |--------------------------------------------------------------------------
    | PROCUREMENT
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:procurement')
        ->prefix('procurement')
        ->name('procurement.')
        ->group(function () {

            Route::get('/', [
                EursController::class,
                'procurementDashboard'
            ])->name('dashboard');

        });


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:user')
        ->prefix('user')
        ->name('user.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | USER DASHBOARD
            |--------------------------------------------------------------------------
            */

            Route::get('/', [
                EursController::class,
                'userDashboard'
            ])->name('dashboard');


            /*
            |--------------------------------------------------------------------------
            | MY E-URS
            |--------------------------------------------------------------------------
            */

            Route::get('/e-urs', [
                EursController::class,
                'index'
            ])->name('eurs.index');


            /*
            |--------------------------------------------------------------------------
            | CREATE NEW E-URS
            |--------------------------------------------------------------------------
            */

            Route::get('/e-urs/create', [
                EursController::class,
                'create'
            ])->name('eurs.create');


            /*
            |--------------------------------------------------------------------------
            | STORE NEW E-URS
            |--------------------------------------------------------------------------
            */

            Route::post('/e-urs', [
                EursController::class,
                'store'
            ])->name('eurs.store');


            /*
            |--------------------------------------------------------------------------
            | EDIT REJECTED E-URS
            |--------------------------------------------------------------------------
            */

            Route::get('/e-urs/{eurs}/edit', [
                EursController::class,
                'edit'
            ])->name('eurs.edit');


            /*
            |--------------------------------------------------------------------------
            | UPDATE / RESUBMIT EXISTING E-URS
            |--------------------------------------------------------------------------
            */

            Route::put('/e-urs/{eurs}', [
                EursController::class,
                'update'
            ])->name('eurs.update');


            /*
            |--------------------------------------------------------------------------
            | SHOW E-URS DETAIL
            |--------------------------------------------------------------------------
            */

            Route::get('/e-urs/{eurs}', [
                EursController::class,
                'show'
            ])->name('eurs.show');


            /*
            |--------------------------------------------------------------------------
            | E-URS PDF
            |--------------------------------------------------------------------------
            */

            Route::get('/e-urs/{eurs}/pdf', [
                EursController::class,
                'pdf'
            ])->name('eurs.pdf');


            /*
            |--------------------------------------------------------------------------
            | TECHNICAL REFERENCE FILE
            |--------------------------------------------------------------------------
            */

            Route::get('/e-urs/{eurs}/technical-file', [
                EursController::class,
                'technicalFile'
            ])->name('eurs.technical-file');


            /*
            |--------------------------------------------------------------------------
            | ADDITIONAL ATTACHMENT FILE
            |--------------------------------------------------------------------------
            */

            Route::get('/e-urs/{eurs}/attachment/{attachment}', [
                EursController::class,
                'attachmentFile'
            ])->name('eurs.attachment-file');

        });

});