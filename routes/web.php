<?php
namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\OriginSchool;
use App\Models\StudentParent;
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
    Route::post('/update-profile-action', [AdminController::class, 'updateProfileAction'])->name('updateProfileAction');

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
    Route::get('/student-not-have-class/search', [StudentController::class, 'studentNotHaveClass'])->name('studentNotHaveClass');
    Route::get('/student/download/{id}', [StudentController::class, 'downloadAction'])->name('downloadAction');
    
    // manajemen kelas
    Route::get('/schoolclass', [SchoolClassController::class, 'index'])->name('indexSchoolClass');
    Route::get('/schoolclass/form-add-schoolclass', [SchoolClassController::class, 'formAddSchoolClass'])->name('formAddSchoolClass');
    Route::post('/schoolclass/process-add-schoolclass', [SchoolClassController::class, 'addSchoolClassAction'])->name('addSchoolClassAction');
    Route::get('/schoolclass/form-edit-schoolclass/{id}', [SchoolClassController::class, 'formEditSchoolClass'])->name('formEditSchoolClass');
    Route::post('/schoolclass/process-edit-schoolclass', [SchoolClassController::class, 'updateSchoolClassAction'])->name('updateSchoolClassAction');
    Route::get('/schoolclass/delete-schoolclass/{id}', [SchoolClassController::class, 'deleteSchoolClassAction'])->name('deleteSchoolClassAction');
    Route::get('/schoolclass/detail-schoolclass/{id}', [SchoolClassController::class, 'detailSchoolClass'])->name('detailSchoolClass');

    Route::get('/schoolclass/{id}/add-student', [SchoolClassController::class, 'addStudentClass'])->name('addStudentClass');
    Route::get('/schoolclass/{id}/student/{id_student}', [SchoolClassController::class, 'addStudentClassAction'])->name('addStudentClassAction');

    Route::get('/schoolclass/{id}/move-student-class', [SchoolClassController::class, 'moveStudentClass'])->name('moveStudentClass');
    Route::post('/schoolclass/move-student-class-action', [SchoolClassController::class, 'moveStudentClassAction'])->name('moveStudentClassAction');

    Route::post('/schoolclass/move-all-student-class-action]', [SchoolClassController::class, 'moveStudentAllClassAction'])->name('moveStudentAllClassAction');

    // manajemen user
    Route::get('/user', [UserController::class, 'index'])->name('indexUser');
    Route::get('/user/form-add-user', [UserController::class, 'formAddUser'])->name('formAddUser');
    Route::post('/user/process-add-user', [UserController::class, 'addUserAction'])->name('addUserAction');
    Route::get('/user/form-edit-user/{id}', [UserController::class, 'formEditUser'])->name('formEditUser');
    Route::post('/user/process-edit-user', [UserController::class, 'editUserAction'])->name('editUserAction');
    Route::get('/user/delete-user/{id}', [UserController::class, 'deleteUserAction'])->name('deleteUserAction');
});
