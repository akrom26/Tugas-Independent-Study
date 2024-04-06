<?php
namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('loginProcess');

// role admin
Route::group(['prefix' => '/administrator', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('indexAdmin');

    // manajemen siswa
    Route::get('/student', [StudentController::class, 'index'])->name('indexStudent');
    Route::get('/form-add-student', [StudentController::class, 'formAdd'])->name('formAdd');
    Route::post('/process-add-student', [StudentController::class, 'addStudentAction'])->name('addStudentAction');
    Route::get('/form-edit-student/{id}', [StudentController::class, 'formEdit'])->name('formEdit');
    Route::post('/process-edit-student', [StudentController::class, 'updateStudentAction'])->name('updateStudentAction');
    Route::get('/delete-student/{id}', [StudentController::class, 'deleteStudentAction'])->name('deleteStudentAction');
});
