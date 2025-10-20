<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeamLeaderController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getTeamLeader();
        $data['header_title'] = "Team Leader List";
        return view('admin.teamLeader.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Team Leader Add";
        return view('admin.teamLeader.add', $data);
    }

    public function insert(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'max:12|min:9',
            'marital_status' => 'max:50',
        ]);

        $teamLeader = new User();
        $teamLeader->name = $request->name;
        $teamLeader->last_name = $request->last_name;
        $teamLeader->gender = $request->gender;
        $teamLeader->phone_number = $request->phone_number;
        $teamLeader->marital_status = $request->marital_status;

        if (!empty($request->date_of_birth)) {
            $teamLeader->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $teamLeader->date_of_joining = $request->date_of_joining;
        }
        $teamLeader->status = $request->status;
        $teamLeader->province = $request->province;
        $teamLeader->address = $request->address;
        $teamLeader->qualification = $request->qualification;
        $teamLeader->work_experience = $request->work_experience;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $teamLeader->profile_pic = $filename;
        }
        $teamLeader->email = $request->email;
        $teamLeader->password = Hash::make($request->password);
        $teamLeader->user_type = 6;
 
        $teamLeader->save();

        return redirect('admin/teamLeader/list')->with('success', 'Team Leader Added successfully.');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Team Leader";
                return view('admin.teamLeader.edit', $data);
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

        $teamLeader = User::getSingle($id);
        $teamLeader->name = $request->name;
        $teamLeader->last_name = $request->last_name;
        $teamLeader->gender = $request->gender;
        $teamLeader->phone_number = $request->phone_number;
        $teamLeader->marital_status = $request->marital_status;

        if (!empty($request->date_of_birth)) {
            $teamLeader->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->date_of_joining)) {
            $teamLeader->date_of_joining = $request->date_of_joining;
        }
        $teamLeader->status = $request->status;
        $teamLeader->address = $request->address;
        $teamLeader->qualification = $request->qualification;
        $teamLeader->work_experience = $request->work_experience;
        $teamLeader->province = $request->province;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $teamLeader->profile_pic = $filename;
        }
        $teamLeader->email = $request->email;
        if (!empty($request->password)) {
            $teamLeader->password = Hash::make($request->password);
        }
        $teamLeader->user_type = 6;
 
        $teamLeader->save();

        return redirect('admin/teamLeader/list')->with('success', 'HR Manager Edited successfully.');
    }

    public function delete($id)
    {
        $teamLeader = User::getSingle($id);
        $teamLeader->is_deleted = 1;
        $teamLeader->save();

        return redirect('admin/teamLeader/list')->with('success', 'Team Leader Deleted successfully.');
    }

    public function Approve($id)
    {
        $data['TL'] = $id;
        $data['getSearchApporveTL'] = User::getSearchApporveTL($id);
        $data['header_title'] = "Team Leader Approve List";
        return view('admin.teamleader.approve', $data);
    }
}
