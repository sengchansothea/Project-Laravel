<?php

namespace App\Http\Controllers;

use App\Models\DepartmentModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeptAdminITController extends Controller
{
    public function CEO()
    {
        $data['getRecord'] = user::getCEO();
        $data['header_title'] = "Dept Admin List";
        return view('dept_admin.role_department.CEO_list', $data);
    }

    public function HR_Manager()
    {
        $data['getRecord'] = user::getHRManager();
        $data['header_title'] = "Dept Admin List";
        return view('dept_admin.role_department.HR_manager_list', $data);
    }
    
    public function CFO()
    {
        $data['getRecord'] = user::getCFO();
        $data['header_title'] = "Dept Admin List";
        return view('dept_admin.role_department.CFO_list', $data);
    }
    public function TeamLeader()
    {
        $data['getRecord'] = user::getTeamLeader();
        $data['header_title'] = "Dept Admin List";
        return view('dept_admin.role_department.teamLeader_list', $data);
    }

    public function Employee()
    {
        $data['getRecord'] = user::getEmployee();
        $data['header_title'] = "Dept Admin List";
        return view('dept_admin.role_department.employee_list', $data);
    }

}
