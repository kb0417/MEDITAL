<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\DoctorController;
// use App\Http\Controllers\PatientController;

// Route::get('/', [PatientController::class, 'index'])->name('patient.home');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



// /*
// |--------------------------------------------------------------------------
// | PATIENT (PUBLIC)
// |--------------------------------------------------------------------------
// */
// Route::get('/', [PatientController::class, 'index'])->name('patient.home');
// Route::post('/resultat', [PatientController::class, 'search'])->name('patient.search');

// /*
// |--------------------------------------------------------------------------
// | DOCTOR
// |--------------------------------------------------------------------------
// */
// Route::middleware(['auth', 'isDoctor'])->group(function () {

//     Route::get('/doctor', [DoctorController::class, 'dashboard'])
//         ->name('doctor.dashboard');

//     Route::get('/analyses/create', [DoctorController::class, 'create'])
//         ->name('doctor.analyses.create');

//     Route::post('/analyses', [DoctorController::class, 'store'])
//         ->name('doctor.analyses.store');
// });


// /*
// |--------------------------------------------------------------------------
// | ADMIN
// |--------------------------------------------------------------------------
// */
// Route::middleware(['auth', 'isAdmin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });


// require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorPatientController;

/*
|--------------------------------------------------------------------------
| PATIENT (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [PatientController::class, 'index'])
    ->name('patient.home');

Route::post('/resultat', [PatientController::class, 'search'])
    ->name('patient.search');

/*
|--------------------------------------------------------------------------
| AUTH DEFAULT (BREEZE / JETSTREAM)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| DOCTOR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isDoctor'])->group(function () {

    Route::get('/doctor', [DoctorController::class, 'dashboard'])
        ->name('doctor.dashboard');

    Route::get('/analyses/create', [DoctorController::class, 'create'])
        ->name('doctor.analyses.create');

    Route::post('/analyses', [DoctorController::class, 'store'])
        ->name('doctor.analyses.store');
    
    Route::get('/doctor/patients/create', [DoctorPatientController::class, 'create'])->name('doctor.patients.create');
    Route::post('/doctor/patients', [DoctorPatientController::class, 'store'])->name('doctor.patients.store');
    // Patients
    Route::get('/doctor/patients', [DoctorPatientController::class, 'index'])
        ->name('doctor.patients.index');

    // Analyses (liste)
    Route::get('/doctor/analyses', [DoctorAnalyseController::class, 'index'])
        ->name('doctor.analyses.index');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/doctors', [AdminController::class, 'doctors'])->name('admin.doctors');
    Route::post('/admin/doctors/{user}/validate', [AdminController::class, 'validateDoctor'])->name('admin.doctors.validate');
});


require __DIR__.'/auth.php';

