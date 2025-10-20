<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DepartmentModel;

class DepartmentController extends Controller
{

    public function Department()
    {
        $data['getRecord'] = DepartmentModel::getRecord();
        $data['header_title'] = "Department Name";
        return view('dept_admin.department.list',$data);
    }
    
    public function AddDepartment()
    {
        $data['header_title'] = "Department Name";
        return view('dept_admin.department.add',$data);
    }
    
    public function InsertDepartment(Request $request)
    {
        //dd($request->all());
        $save = new DepartmentModel();
        $save->name = $request->name;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('deptAdmin/department')->with('success', 'Department Added Successfully.');
    }

    public function EditDepartment($id)
    {
        $data['getRecord'] = DepartmentModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Department";
            return view('dept_admin.department.edit', $data);
       }
       else
       {
           abort(404);
       }
    }

    public function UpdateDepartment($id, Request $request)
    {
        //dd($request->all());
        $save = DepartmentModel::getSingle($id);
        $save-> name = $request->name;
        $save-> status = $request->status;
        $save-> save();

        return redirect('deptAdmin/department')->with('success', 'Department Updated Successfully.');
    }

    public function DeletedDepartment($id)
    {
        $save = DepartmentModel::getSingle($id);
        $save->is_deleted = 1;
        $save->save();

        return redirect('deptAdmin/department')->with('success', 'Department Deleted Successfully.');
    }
}
