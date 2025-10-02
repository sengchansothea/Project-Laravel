<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class DeptAdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getDepartmentAdmins();
        $data['header_title'] = "Dept Admin List";
        return view('admin.department_admin.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add Dept Admin";
        return view('admin.department_admin.add', $data);
    }

    public function insert(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'max:12|min:9',
            'marital_status' => 'max:50',
        ]);

        $deptAdmin = new User();
        $deptAdmin->name = $request->name;
        $deptAdmin->last_name = $request->last_name;
        $deptAdmin->gender = $request->gender;
        $deptAdmin->phone_number = $request->phone_number;
        $deptAdmin->marital_status = $request->marital_status;

        if (!empty($request->date_of_birth)) {
            $deptAdmin->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $deptAdmin->date_of_joining = $request->date_of_joining;
        }
        $deptAdmin->status = $request->status;
        $deptAdmin->province = $request->province;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $deptAdmin->profile_pic = $filename;
        }
        $deptAdmin->email = $request->email;
        $deptAdmin->password = Hash::make($request->password);
        $deptAdmin->user_type = 2;

        
        $deptAdmin->save();

        return redirect('admin/department_admin/list')->with('success', 'User added successfully.');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit HR";
                return view('admin.department_admin.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        //dd($request->all());
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'max:12|min:9',
            'marital_status' => 'max:25'
        ]);


        $deptAdmin = User::getSingle($id);
        $deptAdmin->name = $request->name;
        $deptAdmin->last_name = $request->last_name;
        $deptAdmin->gender = $request->gender;
        if (!empty($request->date_of_birth)) {
            $deptAdmin->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $deptAdmin->date_of_joining = $request->date_of_joining;
        }
        $deptAdmin->phone_number = $request->phone_number;
        $deptAdmin->marital_status = $request->marital_status;
        $deptAdmin->province = $request->province;
        
        if (!empty($request->file('profile_pic'))) {
            if (!empty($deptAdmin->getProfile())) {
                unlink(public_path('upload/' . $deptAdmin->profile_pic));
            }
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $deptAdmin->profile_pic = $filename;
        }

        $deptAdmin->status = $request->status;
        $deptAdmin->email = $request->email;
        if (!empty($request->password)) {
            $deptAdmin->password = Hash::make($request->password);
        }

        $deptAdmin->save();

        return redirect('admin/department_admin/list')->with('success', 'Teacher edited successfully.');
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_deleted = 1;
        $user->save();

        return redirect('admin/department_admin/list')->with('success', 'Admin deleted successfully.');
    }
}