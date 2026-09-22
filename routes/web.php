<?php

use App\Http\Controllers\FuelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleDriverController;
use App\Http\Controllers\ServiceCOntroller;
use App\Http\Controllers\VehicleRequestsController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\ServiceStationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', function () {
    return view('welcome');
})->name('landing');

Route::get(
    '/dashboard',
    [HomeController::class, 'dashboard']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    //User Management
    Route::resource('users', UserController::class);
    Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');

    // Vehicle Management
    Route::resource('vehicles', VehicleController::class);

    // vehicle-driver assignments
    Route::get('vehicles/{vehicle}/assign', [VehicleDriverController::class, 'edit'])
        ->name('vehicledrivers.edit');

    Route::put('vehicles/{vehicle}/assign', [VehicleDriverController::class, 'update'])
        ->name('vehicledrivers.update');

    Route::patch('vehicles/{vehicle}/unassign', [VehicleDriverController::class, 'unassignFromList'])
        ->name('vehicles.unassign');

    Route::patch('vehicles/{vehicle}/status', [VehicleController::class, 'toggleStatus'])
        ->name('vehicles.toggleStatus');

    // Vehicle Inspections
    Route::resource('inspections', InspectionController::class);

    // service Management
    Route::resource('services', ServiceCOntroller::class);


    // service station management
    Route::resource('servicestations', ServiceStationController::class);
    Route::post('servicestations/{id}/restore', [ServiceStationController::class, 'restore'])->name('servicestations.restore');

    // Fuel Management
    Route::resource('fuels', FuelController::class);

    //requests management
    Route::resource('vehiclerequests', VehicleRequestsController::class);

    // transport officer assigns
    Route::get('vehiclerequests/{vehiclerequest}/assign', [VehicleRequestsController::class, 'assignForm'])->name('vehiclerequests.assignForm');
    Route::put('vehiclerequests/{vehiclerequest}/assign', [VehicleRequestsController::class, 'assign'])->name('vehiclerequests.assign');

    // driver uploads ticket
    Route::get('vehiclerequests/{vehiclerequest}/upload-ticket', [VehicleRequestsController::class, 'uploadWorkTicket'])->name('vehiclerequests.uploadForm');
    Route::put('vehiclerequests/{vehiclerequest}/upload-ticket', [VehicleRequestsController::class, 'uploadWorkTicket'])->name('vehiclerequests.uploadWorkTicket');


    //Service Requests
    Route::resource('servicerequests', ServiceRequestController::class);
    Route::get('approval/{id}', [ServiceRequestController::class, 'openapproval'])->name('servicerequests.openapproval');
    Route::put('approval/{servicerequest}', [ServiceRequestController::class, 'approve'])->name('servicerequests.approve');
    Route::get('servicerequests/{servicerequest}/download', [ServiceRequestController::class, 'download'])->name('servicerequests.download');

    // Notifications
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::patch('notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
});

require __DIR__ . '/auth.php';
