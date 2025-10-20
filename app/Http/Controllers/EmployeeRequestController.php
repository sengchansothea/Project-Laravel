<?php

namespace App\Http\Controllers;

use App\Models\DepartmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EmployeeRequestController extends Controller
{
    public function RequestList()
    {
        $data['getRecord'] = User::getRequestEmployee(Auth::id());
        $data['header_title'] = "Request Employee";
        return view('employee.request.list', $data);
    }

    public function AddRequest()
    {
        $data['user'] = Auth::user();
        $data['getDepartment'] = DepartmentModel::getDepartment();
        $data['header_title'] = "Add Request Employee";
        return view('employee.request.add', $data);
    }

    public function InsertRequest(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
        request()->validate([
            'time' => 'max:255',
            'weight' => 'max:255',           
        ]);

        $save = User::getSingle($id);
        $save -> name = $request->name;
        $save -> last_name = $request->last_name;
        $save -> gender = $request->gender;
        $save -> phone_number = $request->phone_number;
        $save -> type_request = $request->type_request;
        $save -> department_id = $request->department_id;
        $save -> time = $request->time;
        $save -> reason = $request->reason;
        $save->save();

        return redirect('employee/request/list')->with('success', 'Requested Sended Successfully.');
    }
}
