<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadtimelineController;

Route::get('/', function () {
    return view('welcome');
});


// Route for dashboard view
Route::middleware('guest')->group(function () {
    Route::view('login', 'Auth.login')->name('login');
    Route::post('loginMatch', [UserController::class, 'login'])->name('loginMatch');

    Route::view('register', 'Auth.register')->name('register');
    Route::post('registerSave', [UserController::class, 'register'])->name('registerSave');
});

// Protect dashboard route to authenticated users
Route::view('dashboard', 'Auth.dashboard')->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::post('dashboard', [UserController::class, 'dashboard'])->name('dashboard.post');
});

// Logout should be accessible only by authenticated users
Route::post('logout', [UserController::class, 'logout'])->name('logout');








// Register reoutes started

// group -> prefix = register
// post -> save





// Route::get('Lead', [LeadController::class, 'index'])->name('Lead.lead');
// Route::get('Lead/create', [LeadController::class, 'create'])->name('Lead.create');
// Route::post('Lead', [LeadController::class, 'store'])->name('Lead.store');
// Route::get('Lead/{id}', [LeadController::class, 'show'])->name('Lead.show');
// Route::get('Lead/{id}/edit', [LeadController::class, 'edit'])->name('Lead.edit');
// Route::put('Lead/{id}', [LeadController::class, 'update'])->name('Lead.lead');
// Route::delete('Lead/{id}', [LeadController::class, 'destroy'])->name('Lead.destroy');


// Route::prefix('lead')->group(function () {
//     Route::get('/', [LeadController::class, 'indexLead']); // Route for index
//     Route::get('add', [LeadController::class, 'indexAddLead']); // Route for create
//     Route::post('add', [LeadController::class, 'addLead']); // Route for store
//     Route::get('view', [LeadController::class, 'viewLead']); // Route for show
//     Route::get('update', [LeadController::class, 'update']); // Route for edit
//     Route::post('update', [LeadController::class, 'update']); // Route for edit
    // Route::put('{id}', [LeadController::class, 'update']); // Route for update
    // Route::delete('{id}', [LeadController::class, 'destroy']); // Route for destroy
// });



Route::group(['prefix' => 'Lead', 'as' => 'lead.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => LeadController::class . '@index']);
    Route::get('create', ['as' => 'create', 'uses' => LeadController::class . '@create']);
    Route::post('/', ['as' => 'store', 'uses' => LeadController::class . '@store']);
    // Route::get('{id}', ['as' => 'show', 'uses' => LeadController::class . '@show']);
    Route::get('{id}/edit', ['as' => 'edit', 'uses' => LeadController::class . '@edit']);
    Route::put('{id}', ['as' => 'update', 'uses' => LeadController::class . '@update']);
    Route::delete('{id}', ['as' => 'destroy', 'uses' => LeadController::class . '@destroy']);
});

Route::group(['prefix' => 'LeadTimeline', 'as' => 'leadtimeline.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => LeadtimelineController::class . '@index']);
    Route::get('create', ['as' => 'create', 'uses' => LeadtimelineController::class . '@create']);
    Route::post('/', ['as' => 'store', 'uses' => LeadtimelineController::class . '@store']);
    Route::get('{id}/edit', ['as' => 'edit', 'uses' => LeadtimelineController::class . '@edit']);
    Route::put('{id}', ['as' => 'update', 'uses' => LeadtimelineController::class . '@update']);
    Route::delete('{id}', ['as' => 'destroy', 'uses' => LeadtimelineController::class . '@destroy']);
});

