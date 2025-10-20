<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class CEOController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getCEO();
        $data['header_title'] = "CEO List";
        return view('admin.CEO.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add CEO";
        return view('admin.CEO.add', $data);
    }

    public function insert(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'max:12|min:9',
            'marital_status' => 'max:50',
        ]);

        $CEO = new User();
        $CEO->name = $request->name;
        $CEO->last_name = $request->last_name;
        $CEO->gender = $request->gender;
        $CEO->phone_number = $request->phone_number;
        $CEO->marital_status = $request->marital_status;
        if (!empty($request->date_of_birth)) {
            $CEO->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $CEO->date_of_joining = $request->date_of_joining;
        }
        $CEO->province = $request->province;
        $CEO->status = $request->status;
        $CEO->address = $request->address;
        $CEO->qualification = $request->qualification;
        $CEO->work_experience = $request->work_experience;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $CEO->profile_pic = $filename;
        }
        $CEO->email = $request->email;
        $CEO->password = Hash::make($request->password);
        $CEO->user_type = 3;
 
        $CEO->save();

        return redirect('admin/CEO/list')->with('success', 'CEO Added successfully.');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit CEO";
                return view('admin.CEO.edit', $data);
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

        $CEO = User::getSingle($id);
        $CEO->name = $request->name;
        $CEO->last_name = $request->last_name;
        $CEO->gender = $request->gender;
        $CEO->phone_number = $request->phone_number;
        $CEO->marital_status = $request->marital_status;
        if (!empty($request->date_of_birth)) {
            $CEO->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $CEO->date_of_joining = $request->date_of_joining;
        }
        $CEO->province = $request->province;
        $CEO->status = $request->status;
        $CEO->address = $request->address;
        $CEO->qualification = $request->qualification;
        $CEO->work_experience = $request->work_experience;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $CEO->profile_pic = $filename;
        }
        $CEO->email = $request->email;
        if (!empty($request->password)) {
            $CEO->password = Hash::make($request->password);
        }
        $CEO->save();

        return redirect('admin/CEO/list')->with('success', 'CEO Edited successfully.');
    }

    public function delete($id)
    {
        $CEO = User::getSingle($id);
        $CEO->is_deleted = 1;
        $CEO->save();

        return redirect('admin/CEO/list')->with('success', 'CEO Deleted successfully.');
    }

    public function Approve($id)
    {
        $data['CEO'] = $id;
        $data['getSearchEmployee'] = User::getSearchEmployee($id);
        $data['header_title'] = "CEO Approve List";
        return view('admin.CEO.approve', $data);
    }
}
