<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DeptAdminController;
use App\Http\Controllers\CEOController;
use App\Http\Controllers\HRManagerController;
use App\Http\Controllers\CFOController;
use App\Http\Controllers\TeamLeaderController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DeptAdminITController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FormRequestController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\TypeRequestController;
use App\Http\Controllers\DepartmentRequestController;
use App\Http\Controllers\DepartmentApproveRequestController;
use App\Http\Controllers\EmployeeRequestController;


use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\UserController;


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

    Route::get('admin/myAccount', [UserController::class, 'MyAccount']);
    Route::post('admin/myAccount', [UserController::class, 'UpdateMyAccountAdmin']);
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);

    // Admin System Management
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

    //CEO System Admin Management
    Route::get('admin/CEO/list', [CEOController::class, 'list']);
    Route::get('admin/CEO/add', [CEOController::class, 'add']);
    Route::post('admin/CEO/add', [CEOController::class, 'insert']);
    Route::get('admin/CEO/edit/{id}', [CEOController::class, 'edit']);
    Route::post('admin/CEO/edit/{id}', [CEOController::class, 'update']);
    Route::get('admin/CEO/delete/{id}', [CEOController::class, 'delete']);

   Route::get('admin/CEO/approve/{id}', [CEOController::class, 'approve']);

    //HR Manager System Admin Management
    Route::get('admin/HR_manager/list', [HRManagerController::class, 'list']);
    Route::get('admin/HR_manager/add', [HRManagerController::class, 'add']);
    Route::post('admin/HR_manager/add', [HRManagerController::class, 'insert']);
    Route::get('admin/HR_manager/edit/{id}', [HRManagerController::class, 'edit']);
    Route::post('admin/HR_manager/edit/{id}', [HRManagerController::class, 'update']);
    Route::get('admin/HR_manager/delete/{id}', [HRManagerController::class, 'delete']);
    Route::get('admin/HR_manager/approve/{id}', [HRManagerController::class, 'Approve']);

    //CFO System Admin Management
    Route::get('admin/CFO/list', [CFOController::class, 'list']);
    Route::get('admin/CFO/add', [CFOController::class, 'add']);
    Route::post('admin/CFO/add', [CFOController::class, 'insert']);
    Route::get('admin/CFO/edit/{id}', [CFOController::class, 'edit']);
    Route::post('admin/CFO/edit/{id}', [CFOController::class, 'update']);
    Route::get('admin/CFO/delete/{id}', [CFOController::class, 'delete']);
    Route::get('admin/CFO/approve/{id}', [CFOController::class, 'Approve']);

    //Team Leader System Admin Management
    Route::get('admin/teamLeader/list', [TeamLeaderController::class, 'list']);
    Route::get('admin/teamLeader/add', [TeamLeaderController::class, 'add']);
    Route::post('admin/teamLeader/add', [TeamLeaderController::class, 'insert']);
    Route::get('admin/teamLeader/edit/{id}', [TeamLeaderController::class, 'edit']);
    Route::post('admin/teamLeader/edit/{id}', [TeamLeaderController::class, 'update']);
    Route::get('admin/teamLeader/delete/{id}', [TeamLeaderController::class, 'delete']);
    Route::get('admin/teamLeader/approve/{id}', [TeamLeaderController::class, 'Approve']);

    //Employee System Admin Management
    Route::get('admin/employee/list', [EmployeeController::class, 'list']);
    Route::get('admin/employee/add', [EmployeeController::class, 'add']);
    Route::post('admin/employee/add', [EmployeeController::class, 'insert']);
    Route::get('admin/employee/edit/{id}', [EmployeeController::class, 'edit']);
    Route::post('admin/employee/edit/{id}', [EmployeeController::class, 'update']);
    Route::get('admin/employee/delete/{id}', [EmployeeController::class, 'delete']);

    // User Management
    Route::get('admin/user_management/list', [UserManagementController::class, 'userList']);
    Route::get('admin/user_management/add', [UserManagementController::class, 'userAdd']);
    Route::post('admin/user_management/add', [UserManagementController::class, 'userInsert']);
    Route::get('admin/user_management/edit/{id}', [UserManagementController::class, 'userEdit']);
    Route::post('admin/user_management/edit/{id}', [UserManagementController::class, 'userUpdate']);
    Route::get('admin/user_management/delete/{id}', [UserManagementController::class, 'userDelete']);

    // Request Type
    Route::get('admin/request/requestlist', [FormRequestController::class, 'RequestList']);
    Route::get('admin/request/requestadd', [FormRequestController::class, 'RequestAdd']);
    Route::post('admin/request/requestadd', [FormRequestController::class, 'RequestInsert']);
    Route::get('admin/request/requestedit/{id}', [FormRequestController::class, 'RequestEdit']);
    Route::post('admin/request/requestedit/{id}', [FormRequestController::class, 'RequestUpdate']);
    Route::get('admin/request/requestdelete/{id}', [FormRequestController::class, 'RequestDelete']);
});

//Department Admin Routes 
Route::group(['middleware' => 'deptAdmin'], function () { 
    Route::get('deptAdmin/dashboard', [DashboardController::class, 'dashboard']); 

    Route::get('deptAdmin/CEO/list', [DeptAdminITController::class, 'CEO']);
    Route::get('deptAdmin/HR_manager/list', [DeptAdminITController::class, 'HR_Manager']);
    Route::get('deptAdmin/CFO/list', [DeptAdminITController::class, 'CFO']);
    Route::get('deptAdmin/teamLeader/list', [DeptAdminITController::class, 'TeamLeader']);
    Route::get('deptAdmin/employee/list', [DeptAdminITController::class, 'Employee']);

    //CRUD Department
    Route::get('deptAdmin/department', [DepartmentController::class, 'Department']);
    Route::get('deptAdmin/department/add', [DepartmentController::class, 'AddDepartment']);
    Route::post('deptAdmin/department/add', [DepartmentController::class, 'InsertDepartment']);
    Route::get('deptAdmin/department/edit/{id}', [DepartmentController::class, 'EditDepartment']);
    Route::post('deptAdmin/department/edit/{id}', [DepartmentController::class, 'UpdateDepartment']);
    Route::get('deptAdmin/department/delete/{id}', [DepartmentController::class, 'DeletedDepartment']);

    //CRUD Type Request
    Route::get('deptAdmin/type_Request/list', [TypeRequestController::class, 'TypeRequestList']);
    Route::get('deptAdmin/type_Request/add', [TypeRequestController::class, 'AddTypeRequest']);
    Route::post('deptAdmin/type_Request/add', [TypeRequestController::class, 'InsertTypeRequest']);
    Route::get('deptAdmin/type_Request/edit/{id}', [TypeRequestController::class, 'EditTypeRequest']);
    Route::post('deptAdmin/type_Request/edit/{id}', [TypeRequestController::class, 'UpdateTypeRequest']);
    Route::get('deptAdmin/type_Request/delete/{id}', [TypeRequestController::class, 'DeletedTypeRequest']);

    //Assing Department Request
    Route::get('deptAdmin/assign_department_request/list', [DepartmentRequestController::class, 'DepartmentRequestList']);
    Route::get('deptAdmin/assign_department_request/add', [DepartmentRequestController::class, 'AddDepartmentRequest']);
    Route::post('deptAdmin/assign_department_request/add', [DepartmentRequestController::class, 'InsertDepartmentRequest']);
    Route::get('deptAdmin/assign_department_request/edit_all/{id}', [DepartmentRequestController::class, 'EditAllDepartmentRequest']);
    Route::post('deptAdmin/assign_department_request/edit_all/{id}', [DepartmentRequestController::class, 'UpdateAllDepartmentRequest']);
    Route::get('deptAdmin/assign_department_request/edit_single/{id}', [DepartmentRequestController::class, 'EditSingleDepartmentRequest']);
    Route::post('deptAdmin/assign_department_request/edit_single/{id}', [DepartmentRequestController::class, 'UpdateSingleDepartmentRequest']);
    Route::get('deptAdmin/assign_department_request/delete/{id}', [DepartmentRequestController::class, 'DeletedDepartmentRequest']);

    //Assign Department Approver 
    Route::get('deptAdmin/assign_department_approver/list', [DepartmentApproveRequestController::class, 'DepartmentApproveRequestList']);
    Route::get('deptAdmin/assign_department_approver/add', [DepartmentApproveRequestController::class, 'AddDepartmentApproveRequest']);
    Route::post('deptAdmin/assign_department_approver/add', [DepartmentApproveRequestController::class, 'InsertDepartmentApproveRequest']);
    Route::get('deptAdmin/assign_department_approver/edit_all/{id}', [DepartmentApproveRequestController::class, 'EditAllDepartmentApproveRequest']);
    Route::post('deptAdmin/assign_department_approver/edit_all/{id}', [DepartmentApproveRequestController::class, 'UpdateAllDepartmentApproveRequest']);
    Route::get('deptAdmin/assign_department_approver/edit_single/{id}', [DepartmentApproveRequestController::class, 'EditSingleDepartmentApproveRequest']);
    Route::post('deptAdmin/assign_department_approver/edit_single/{id}', [DepartmentApproveRequestController::class, 'UpdateSingleDepartmentApproveRequest']);
    Route::get('deptAdmin/assign_department_approver/delete/{id}', [DepartmentApproveRequestController::class, 'DeletedDepartmentApproveRequest']);


    Route::get('deptAdmin/myAccount', [UserController::class, 'MyAccount']);
    Route::post('deptAdmin/myAccount', [UserController::class, 'UpdateMyAccountDeptAdmin']);
    Route::get('deptAdmin/change_password', [UserController::class, 'change_password']);
    Route::post('deptAdmin/change_password', [UserController::class, 'update_change_password']);
});


//CEO Routes 
Route::group(['middleware' => 'CEO'], function () { 
    Route::get('CEO/dashboard', [DashboardController::class, 'dashboard']); 

    Route::get('CEO/myAccount', [UserController::class, 'MyAccount']);
    Route::post('CEO/myAccount', [UserController::class, 'UpdateMyAccountCEO']);
    Route::get('CEO/change_password', [UserController::class, 'change_password']);
    Route::post('CEO/change_password', [UserController::class, 'update_change_password']);

    //Route::get('CEO/mydepartment_type_request',[DepartmentRequestController::class, 'MyDepartmentTypeRequest']);

    Route::get('CEO/myRequest', [ApproveController::class, 'MyRequest']);
    Route::get('CEO/myRequest/approveRequest/{id}', [ApproveController::class, 'ApproveMyRequest']);
    Route::post('CEO/myRequest/approveRequest/{id}', [ApproveController::class, 'ApprovedRequest']);
    
});

//HR Manager Routes 
Route::group(['middleware' => 'HR_manager'], function () { 
    Route::get('HR_manager/dashboard', [DashboardController::class, 'dashboard']); 

    Route::get('HR_manager/myAccount', [UserController::class, 'MyAccount']);
    Route::post('HR_manager/myAccount', [UserController::class, 'UpdateMyAccountHRManager']);
    Route::get('HR_manager/change_password', [UserController::class, 'change_password']);
    Route::post('HR_manager/change_password', [UserController::class, 'update_change_password']);

    Route::get('HR_manager/myRequest', [ApproveController::class, 'MyRequest']);
    Route::get('HR-manager/myRequest/approveRequest/{id}', [ApproveController::class, 'ApproveMyRequestHR']);
    Route::post('HR-manager/myRequest/approveRequest/{id}', [ApproveController::class, 'ApprovedMyRequestHR']);
});

//CFO Routes 
Route::group(['middleware' => 'CFO'], function () { 
    Route::get('CFO/dashboard', [DashboardController::class, 'dashboard']); 

    Route::get('CFO/myAccount', [UserController::class, 'MyAccount']);
    Route::post('CFO/myAccount', [UserController::class, 'UpdateMyAccountCFO']);
    Route::get('CFO/change_password', [UserController::class, 'change_password']);
    Route::post('CFO/change_password', [UserController::class, 'update_change_password']);

    Route::get('CFO/myRequest', [ApproveController::class, 'MyRequest']);
    Route::get('CFO/myRequest/approveRequest/{id}', [ApproveController::class, 'ApproveMyRequestCFO']);
    Route::post('CFO/myRequest/approveRequest/{id}', [ApproveController::class, 'ApprovedMyRequestCFO']);
});

//TeamLeader Routes 
Route::group(['middleware' => 'teamleader'], function () { 
    Route::get('teamleader/dashboard', [DashboardController::class, 'dashboard']); 

    Route::get('teamleader/myAccount', [UserController::class, 'MyAccount']);
    Route::post('teamleader/myAccount', [UserController::class, 'UpdateMyAccountTeamLeader']);
    Route::get('teamleader/change_password', [UserController::class, 'change_password']);
    Route::post('teamleader/change_password', [UserController::class, 'update_change_password']);

    Route::get('teamleader/mydepartment_type_request',[DepartmentApproveRequestController::class, 'MyDepartmentTypeRequest']);

    Route::get('teamleader/myRequest', [ApproveController::class, 'MyRequest']);
    Route::get('teamleader/myRequest/approveRequest/{id}', [ApproveController::class, 'ApproveMyRequestTL']);
    Route::post('teamleader/myRequest/approveRequest/{id}', [ApproveController::class, 'ApprovedMyRequestTL']);
});

//Employee Routes 
Route::group(['middleware' => 'employee'], function () { 
    Route::get('employee/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('employee/myAccount', [UserController::class, 'MyAccount']);
    Route::post('employee/myAccount', [UserController::class, 'UpdateMyAccount']);
    Route::get('employee/change_password', [UserController::class, 'change_password']);
    Route::post('employee/change_password', [UserController::class, 'update_change_password']);

    Route::get('employee/formRequest', [FormRequestController::class, 'FormRequest']);
    Route::get('employee/formRequest/addRequest', [FormRequestController::class, 'AddRequest']);
    Route::post('employee/formRequest/addRequest', [FormRequestController::class, 'InsertRequest']);
    Route::get('employee/formRequest/editRequest/{id}', [FormRequestController::class, 'EditRequest']);
    Route::post('employee/formRequest/editRequest/{id}', [FormRequestController::class, 'UpdateRequest']);
    Route::get('employee/formRequest/deleteRequest/{id}', [FormRequestController::class, 'DeletedRequest']);

});

