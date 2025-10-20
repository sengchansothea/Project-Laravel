<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HRManagerController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getHRManager();
        $data['header_title'] = "HR Manager List";
        return view('admin.HR_manager.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add HR Manager List";
        return view('admin.HR_manager.add', $data);
    }

    public function insert(Request $request)
    {
        //dd($request-.all());
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'max:12|min:9',
            'marital_status' => 'max:50',
        ]);

        $HR_manager = new User();
        $HR_manager->name = $request->name;
        $HR_manager->last_name = $request->last_name;
        $HR_manager->gender = $request->gender;
        $HR_manager->phone_number = $request->phone_number;
        $HR_manager->marital_status = $request->marital_status;
        if (!empty($request->date_of_birth)) {
            $HR_manager->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $HR_manager->date_of_joining = $request->date_of_joining;
        }
        $HR_manager->status = $request->status;
        $HR_manager->address = $request->address;
        $HR_manager->qualification = $request->qualification;
        $HR_manager->work_experience = $request->work_experience;
        $HR_manager->province = $request->province;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $HR_manager->profile_pic = $filename;
        }
        $HR_manager->email = $request->email;
        $HR_manager->password = Hash::make($request->password);
        $HR_manager->user_type = 4;
 
        $HR_manager->save();

        return redirect('admin/HR_manager/list')->with('success', 'HR Manager Added successfully.');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit HR Manager";
                return view('admin.HR_manager.edit', $data);
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

        $HR_manager = User::getSingle($id);
        $HR_manager->name = $request->name;
        $HR_manager->last_name = $request->last_name;
        $HR_manager->gender = $request->gender;
        $HR_manager->phone_number = $request->phone_number;
        $HR_manager->marital_status = $request->marital_status;


        if (!empty($request->date_of_birth)) {
            $HR_manager->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $HR_manager->date_of_joining = $request->date_of_joining;
        }
        $HR_manager->status = $request->status;
        $HR_manager->address = $request->address;
        $HR_manager->qualification = $request->qualification;
        $HR_manager->work_experience = $request->work_experience;
        $HR_manager->province = $request->province;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $HR_manager->profile_pic = $filename;
        }
        $HR_manager->email = $request->email;
        if (!empty($request->password)) {
            $HR_manager->password = Hash::make($request->password);
        }
        $HR_manager->user_type = 4;
 
        $HR_manager->save();

        return redirect('admin/HR_manager/list')->with('success', 'HR Manager Edited successfully.');
    }

    public function delete($id)
    {
        $HR_manager = User::getSingle($id);
        $HR_manager->is_deleted = 1;
        $HR_manager->save();

        return redirect('admin/HR_manager/list')->with('success', 'HR Manager Deleted successfully.');
    }

    public function Approve($id)
    {
        $data['HR_Manager'] = $id;
        $data['getSearchApporveHR'] = User::getSearchApporveHR($id);
        $data['header_title'] = "HR Manager Approve List";
        return view('admin.HR_manager.approve', $data);
    }
}
