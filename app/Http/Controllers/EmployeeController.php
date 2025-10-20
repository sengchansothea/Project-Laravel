<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getEmployee();
        $data['header_title'] = "Employee List";
        return view('admin.employee.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Employee Add";
        return view('admin.employee.add', $data);
    }

    public function insert(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'max:12|min:9',
            'marital_status' => 'max:50',
        ]);

        $employee = new User();
        $employee->name = $request->name;
        $employee->last_name = $request->last_name;
        $employee->gender = $request->gender;
        $employee->phone_number = $request->phone_number;
        $employee->department_id = $request->department_id;
        $employee->marital_status = $request->marital_status;

        if (!empty($request->date_of_birth)) {
            $employee->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $employee->date_of_joining = $request->date_of_joining;
        }
        $employee->status = $request->status;
        $employee->province = $request->province;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $employee->profile_pic = $filename;
        }
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->user_type = 7;
 
        $employee->save();

        return redirect('admin/employee/list')->with('success', 'Employee Added successfully.');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Employee Leader";
                return view('admin.employee.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'max:12|min:9',
            'marital_status' => 'max:50',
        ]);

        $employee = User::getSingle($id);
        $employee->name = $request->name;
        $employee->last_name = $request->last_name;
        $employee->gender = $request->gender;
        $employee->phone_number = $request->phone_number;
        $employee->department_id = $request->department_id;
        $employee->marital_status = $request->marital_status;

        if (!empty($request->date_of_birth)) {
            $employee->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $employee->date_of_joining = $request->date_of_joining;
        }
        $employee->status = $request->status;
        $employee->province = $request->province;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $employee->profile_pic = $filename;
        }
        $employee->email = $request->email;
        if (!empty($request->password)) {
            $employee->password = Hash::make($request->password);
        }
        $employee->user_type = 7;
 
        $employee->save();

        return redirect('admin/employee/list')->with('success', 'Employee Edited successfully.');
    }

    public function delete($id)
    {
        $employee = User::getSingle($id);
        $employee->is_deleted = 1;
        $employee->save();

        return redirect('admin/employee/list')->with('success', 'Employee Deleted successfully.');
    }
}
