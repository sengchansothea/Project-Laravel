<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function userList()
    {
        $data['getRecord'] = User::getUserManagement();
        $data['header_title'] = "User List";
        return view('admin.user_management.list', $data);
    }

    public function userAdd()
    {
        $data['header_title'] = "Add User";
        return view('admin.user_management.add', $data);
    }
    public function userInsert(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'user_type' => 'required',
            'department_id' => 'required',
            'status' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = $request->user_type;
        $user->department_id = $request->department_id;
        $user->status = $request->status;
        $user->save();

        return redirect('admin/user_management/list')->with('success', 'User added successfully.');
    }

    public function userEdit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['header_title'] = "Edit User";
        return view('admin.user_management.edit', $data);
    }
   
    public function userUpdate(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'user_type' => 'required',
            'status' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->user_type = $request->user_type;
        $user->department_id = $request->department_id;
        $user->status = $request->status;
        $user->save();

        return redirect('admin/user_management/list')->with('success', 'User updated successfully.');
    }

    public function userDelete($id)
    {
        $user = User::getSingle($id);
        $user->is_deleted = 1;
        $user->save();

        return redirect('admin/user_management/list')->with('success', 'User deleted successfully.');
    }
    
}
