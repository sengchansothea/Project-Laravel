<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DeptAdminController;


// Route::get('/', function () {
//     return view('layout.app');
// });

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'Authlogin'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'resetPassword']);
Route::post('reset/{token}', [AuthController::class, 'PostResetPassword']);

//System Admin Routes
Route::group(['middleware' => 'systemAdmin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    // CEO Management
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    //Dept Admin Management
    Route::get('admin/department_admin/list', [DeptAdminController::class, 'list']);
    Route::get('admin/department_admin/add', [DeptAdminController::class, 'add']);
    Route::post('admin/department_admin/add', [DeptAdminController::class, 'insert']);
    Route::get('admin/department_admin/edit/{id}', [DeptAdminController::class, 'edit']);
    Route::post('admin/department_admin/edit/{id}', [DeptAdminController::class, 'update']);
    Route::get('admin/department_admin/delete/{id}', [DeptAdminController::class, 'delete']);


    // User Management
    Route::get('admin/user_management/list', [UserManagementController::class, 'userList']);
    Route::get('admin/user_management/add', [UserManagementController::class, 'userAdd']);
    Route::post('admin/user_management/add', [UserManagementController::class, 'userInsert']);
    Route::get('admin/user_management/edit/{id}', [UserManagementController::class, 'userEdit']);
    Route::post('admin/user_management/edit/{id}', [UserManagementController::class, 'userUpdate']);
    Route::get('admin/user_management/delete/{id}', [UserManagementController::class, 'userDelete']);
});

//Department Admin Routes 
Route::group(['middleware' => 'deptAdmin'], function () { 
    Route::get('deptAdmin/dashboard', [DashboardController::class, 'dashboard']); 
});


//CEO Routes 
Route::group(['middleware' => 'CEO'], function () { 
    Route::get('CEO/dashboard', [DashboardController::class, 'dashboard']); 
});

//HR Manager Routes 
Route::group(['middleware' => 'HR_manager'], function () { 
    Route::get('HR_manager/dashboard', [DashboardController::class, 'dashboard']); 
});

//CFO Routes 
Route::group(['middleware' => 'CFO'], function () { 
    Route::get('CFO/dashboard', [DashboardController::class, 'dashboard']); 
});

//TeamLeader Routes 
Route::group(['middleware' => 'teamleader'], function () { 
    Route::get('teamleader/dashboard', [DashboardController::class, 'dashboard']); 
});

//Employee Routes 
Route::group(['middleware' => 'employee'], function () { 
    Route::get('employee/dashboard', [DashboardController::class, 'dashboard']); 
});

