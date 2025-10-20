<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CFOController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getCFO();
        $data['header_title'] = "CFO List";
        return view('admin.CFO.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "CFO Add";
        return view('admin.CFO.add', $data);
    }

    public function insert(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'max:12|min:9',
            'marital_status' => 'max:50',
        ]);

        $CFO = new User();
        $CFO->name = $request->name;
        $CFO->last_name = $request->last_name;
        $CFO->gender = $request->gender;
        $CFO->phone_number = $request->phone_number;
        $CFO->marital_status = $request->marital_status;

        if (!empty($request->date_of_birth)) {
            $CFO->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $CFO->date_of_joining = $request->date_of_joining;
        }
        $CFO->status = $request->status;
        $CFO->province = $request->province;
        $CFO->address = $request->address;
        $CFO->qualification = $request->qualification;
        $CFO->work_experience = $request->work_experience;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $CFO->profile_pic = $filename;
        }
        $CFO->email = $request->email;
        $CFO->password = Hash::make($request->password);
        $CFO->user_type = 5;
 
        $CFO->save();

        return redirect('admin/CFO/list')->with('success', 'CFO Added successfully.');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit CFO";
                return view('admin.CFO.edit', $data);
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

        $CFO = User::getSingle($id);
        $CFO->name = $request->name;
        $CFO->last_name = $request->last_name;
        $CFO->gender = $request->gender;
        $CFO->phone_number = $request->phone_number;
        $CFO->marital_status = $request->marital_status;

        if (!empty($request->date_of_birth)) {
            $CFO->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $CFO->date_of_joining = $request->date_of_joining;
        }
        $CFO->status = $request->status;
        $CFO->province = $request->province;
        $CFO->address = $request->address;
        $CFO->qualification = $request->qualification;
        $CFO->work_experience = $request->work_experience;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $CFO->profile_pic = $filename;
        }
        $CFO->email = $request->email;
        if (!empty($request->password)) {
            $CFO->password = Hash::make($request->password);
        }
        $CFO->user_type = 5;
 
        $CFO->save();

        return redirect('admin/CFO/list')->with('success', 'CFO Edited successfully.');
    }

    public function delete($id)
    {
        $CFO = User::getSingle($id);
        $CFO->is_deleted = 1;
        $CFO->save();

        return redirect('admin/CFO/list')->with('success', 'CFO Deleted successfully.');
    }

    public function Approve($id)
    {
        $data['CFO'] = $id;
        $data['getSearchApporveCFO'] = User::getSearchApporveCFO($id);
        $data['header_title'] = "CFO Approve List";
        return view('admin.CFO.approve', $data);
    }
}
