<?php
namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use PhpParser\Builder\ClassConst;

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

    // kelas
    Route::get('/kelas', [ClassController::class, 'index'])->name('indexClass');
    Route::get('/form-tambah-kelas', [ClassController::class, 'formAdd'])->name('formAdd');
    Route::post('/proses-tambah-kelas', [ClassController::class, 'addClassAction'])->name('addClassAction');
});
