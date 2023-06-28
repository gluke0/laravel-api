<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//localhost:8000/admin cause NOT inside the group with prefix 
Route::get('/', function (){
    return view('.guest.welcome');
});

// profile routes, middleware handles all these routes 
// prefix to land in admin zone only after login
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function(){

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //localhost:8000/admin cause inside the group with prefix 
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/projects', ProjectController::class)->parameters(
        [
            'projects' => 'project:slug'
        ]
    );

});


//localhost:8000/admin/projects
//localhost:8000/admin/projects{project} 
//localhost:8000/admin/projects/create


require __DIR__.'/auth.php';
