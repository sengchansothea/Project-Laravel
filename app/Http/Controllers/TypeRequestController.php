<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeRequestModel;
use Illuminate\Support\Facades\Auth;

class TypeRequestController extends Controller
{
    public function TypeRequestList()
    {
        $data['getRecord'] = TypeRequestModel::getRecord();
        $data['header_title'] = "Type Request List";
        return view('dept_admin.type_request.list', $data);
    }

    public function AddTypeRequest()
    {
        $data['header_title'] = "Type Request Add";
        return view('dept_admin.type_request.add', $data);
    }
    public function InsertTypeRequest(Request $request)
    {
        //dd($request->all());
        $save = new TypeRequestModel();
        $save->name = $request->name;
        $save->type_request = $request->type_request;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('deptAdmin/type_Request/list')->with('success', 'TypeRequest Added Successfully.');
    }

    public function EditTypeRequest($id)
    {
        $data['getRecord'] = TypeRequestModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Department";
            return view('dept_admin.type_request.edit', $data);
       }
       else
       {
           abort(404);
       }
    }

    public function UpdateTypeRequest($id,Request $request)
    {
        //dd($request->all());
        $save = TypeRequestModel::getSingle($id);
        $save-> name = $request->name;
        $save-> type_request = $request->type_request;
        $save-> status = $request->status;
        $save-> save();

        return redirect('deptAdmin/type_Request/list')->with('success', 'TypeRequest Updated Successfully.');
    }

    public function DeletedTypeRequest($id)
    {
        $save = TypeRequestModel::getSingle($id);
        $save -> is_deleted = 1;
        $save -> save();

        return redirect('deptAdmin/type_Request/list')->with('success', 'TypeRequest Updated Successfully.');
    }
}
