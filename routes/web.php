<?php

use App\Helper\Helper;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitoyenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\OperateurController;

Route::prefix('citoyen/')->controller(CitoyenController::class)->middleware('auth')->name('citoyen.')->group(function(){
    Route::get('/','home')->name('dashboard');
    Route::get('incidents/','incident')->name('incident.list');
    Route::get('incident/create/{service}',[IncidentController::class,'create'])->name('incident.create');
    Route::post('incident/store',[IncidentController::class,'store'])->name('incident.store');
    Route::resource('incident',IncidentController::class)->except(['index','create','store','show']);
    Route::post('incidents/evaluate/{incident}',[IncidentController::class,'eval'])->name('incident.eval');
});

Route::prefix('operateur/')->controller(OperateurController::class)->middleware(['auth','profile:operateur'])->name('operateur.')->group(function(){
    Route::get('/','home')->name('dashboard');
    Route::get('incidents/',[IncidentController::class,'index'])->name('incident.list');
    Route::get('incidents/arhives',[IncidentController::class,'archives'])->name('incident.archive');
    Route::post('incident/update/{incident}',[IncidentController::class,'setStatut'])->name('incident.update');
    Route::get('statistiques-user/','statistiques')->name('user.statistique');
});


Route::prefix('admin/')->controller(AdminController::class)->middleware(['auth','profile:admin'])->name('admin.')->group(function(){
    Route::get('/','home')->name('dashboard');
    Route::resource('service', ServiceController::class)->except(['show','index','create','update','destroy']);
    Route::resource('operateur', OperateurController::class)->except(['show','index','create','update']);
    Route::post('service-dept/create/{service}',[ServiceController::class,'storeDept'])->name('service.dept.create');
});
Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/dashboard', function () {
    return redirect(Helper::router(Auth::user()));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
