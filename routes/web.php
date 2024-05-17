<?php
namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\OriginSchool;
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

// Area indonesia
Route::get('provinces', [AreaController::class, 'provinces'])->name('provinces');
Route::get('cities', [AreaController::class, 'cities'])->name('cities');
Route::get('districts', [AreaController::class, 'districts'])->name('districts');
Route::get('villages', [AreaController::class, 'villages'])->name('villages');

// role admin
Route::group(['prefix' => '/administrator', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('indexAdmin');

    // route untuk melakukan search orang tua
    Route::get('/parent/search', [ParentController::class, 'searchParent'])->name('searchParent');
    Route::get('/parent/detail', [ParentController::class, 'detailParent'])->name('detailParent');

    // route untuk melakukan search sekolah asal
    Route::get('/origin-school/search', [OriginSchoolController::class, 'searchOriginSchool'])->name('searchOriginSchool');
    Route::get('/origin-school/detail', [OriginSchoolController::class, 'detailOriginSchool'])->name('detailOriginSchool');

    // manajemen siswa
    Route::get('/student', [StudentController::class, 'index'])->name('indexStudent');
    Route::get('/student/form-add-student', [StudentController::class, 'formAdd'])->name('formAdd');
    Route::post('/student/process-add-student', [StudentController::class, 'addStudentAction'])->name('addStudentAction');
    Route::get('/student/form-edit-student/{id}', [StudentController::class, 'formEdit'])->name('formEdit');
    Route::post('/student/process-edit-student', [StudentController::class, 'updateStudentAction'])->name('updateStudentAction');
    Route::get('/student/delete-student/{id}', [StudentController::class, 'deleteStudentAction'])->name('deleteStudentAction');
    Route::get('/student/detail/{id}', [StudentController::class, 'detailStudent'])->name('detailStudent');
    
    //kelas
    Route::get('/schoolclass', [SchoolClassController::class, 'index'])->name('indexSchoolClass');
    Route::get('/student/form-add-schoolclass', [SchoolClassController::class, 'formAddSchoolClass'])->name('formAddSchoolClass');
    Route::post('/student/process-add-schoolclass', [SchoolClassController::class, 'addSchoolClassAction'])->name('addSchoolClassAction');
    Route::get('/student/form-edit-schoolclass/{id}', [SchoolClassController::class, 'formEditSchoolClass'])->name('formEditSchoolClass');
    Route::post('/student/process-edit-schoolclass', [SchoolClassController::class, 'updateSchoolClassAction'])->name('updateSchoolClassAction');
    Route::get('/student/delete-schoolclass/{id}', [SchoolClassController::class, 'deleteSchoolClassAction'])->name('deleteSchoolClassAction');
    Route::get('/student/detail-schoolclass/{id}', [SchoolClassController::class, 'detailSchoolClass'])->name('detailSchoolClass');

});
