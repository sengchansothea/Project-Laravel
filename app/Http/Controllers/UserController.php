<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function change_password()
    {
        $data['header_title'] = "Change_Password";
        return view('profile.change_password',$data);
    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user() -> id);
        if(Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', "Passsword Successfully Updated");
        }
        else
        {
            return redirect()->back()->with('error', "Old Password isn't Correct");
        }
    }

    public function MyAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";
        if(Auth::user() ->user_type == 1)
        {
            return view('admin.my_account',$data);
        }
        else if(Auth::user() ->user_type == 2)
        {
            return view('dept_admin.my_account',$data);
        }
        else if(Auth::user() ->user_type == 3)
        {
            return view('CEO.my_account',$data);
        }
        else if(Auth::user() ->user_type == 4)
        {
            return view('HR_manager.my_account',$data);
        }
        else if(Auth::user() ->user_type == 5)
        {
            return view('CFO.my_account',$data);
        }
        else if(Auth::user() ->user_type == 6)
        {
            return view('teamleader.my_account',$data);
        }
        else if(Auth::user() ->user_type == 7)
        {
            return view('employee.my_account',$data);
        }
    }

    //Employee Account
    public function UpdateMyAccount(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
        request()->validate([
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
        $employee->user_type = 7;
 
        $employee->save();

        return redirect()->back()->with('success', 'Employee Edited Account successfully.');
    }

    //Admin System Account 
    public function UpdateMyAccountAdmin(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->last_name = $request->last_name;
        $user->email = trim($request->email);

        $user->save();

        return redirect()->back()->with('success', 'Admin Edited Account successfully.');
    }

    //Dapartment Admin Account
    public function UpdateMyAccountDeptAdmin(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
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
        $deptAdmin->email = $request->email;

        $deptAdmin->save();

        return redirect()->back()->with('success', 'Department Admin Edited Account successfully.');
    }

    //CEO Account
    public function UpdateMyAccountCEO(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
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
        $CEO->department_id = $request->department_id;
        $CEO->marital_status = $request->marital_status;

        if (!empty($request->date_of_birth)) {
            $CEO->date_of_birth = $request->date_of_birth;
        }
        $CEO->province = $request->province;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $CEO->profile_pic = $filename;
        }
        $CEO->email = $request->email;
        $CEO->user_type = 3;
 
        $CEO->save();

        return redirect()->back()->with('success', 'CEO Edited Account Successfully.');
    }

    //HR Manager Account 
    public function UpdateMyAccountHRManager(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
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
        $HR_manager->department_id = $request->department_id;
        $HR_manager->marital_status = $request->marital_status;

        if (!empty($request->date_of_birth)) {
            $HR_manager->date_of_birth = $request->date_of_birth;
        }
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
        $HR_manager->user_type = 4;
 
        $HR_manager->save();

        return redirect('HR_manager/myAccount')->with('success', 'HR Manager Edited Account Successfully.');
    }

    //CFO Account 
    public function UpdateMyAccountCFO(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
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
        $CFO->department_id = $request->department_id;
        $CFO->marital_status = $request->marital_status;
        if (!empty($request->date_of_birth)) {
            $CFO->date_of_birth = $request->date_of_birth;
        }
        $CFO->province = $request->province;
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $CFO->profile_pic = $filename;
        }
        $CFO->email = $request->email;
        $CFO->user_type = 5;
 
        $CFO->save();

        return redirect()->back()->with('success', 'CFO Edited successfully.');
    }

    //Team Leader Account
    public function UpdateMyAccountTeamLeader(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
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
        $teamLeader->user_type = 6;
 
        $teamLeader->save();

        return redirect()->back()->with('success', 'Team Leader Edited successfully.');
    }

    
}
