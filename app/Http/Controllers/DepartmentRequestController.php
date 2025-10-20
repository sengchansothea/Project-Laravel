<?php

namespace App\Http\Controllers;

use App\Models\DepartmentModel;
use Illuminate\Http\Request;
use App\Models\DepartmentRequestModel;
use App\Models\TypeRequestModel;
use Illuminate\Support\Facades\Auth; 

class DepartmentRequestController extends Controller
{
    public function DepartmentRequestList()
    {
        $data['getRecord'] = DepartmentRequestModel::getRecord();
        $data['header_title'] = "Department Request List";
        return view('dept_admin.department_request.list', $data);
    }

    public function AddDepartmentRequest()
    {
        $data['getDepartment'] = DepartmentModel::getDepartment();
        $data['getTypeRequest'] = TypeRequestModel::getTypeRequest();
        $data['header_title'] = "Department Request Add";
        return view('dept_admin.department_request.add', $data);
    } 
    public function InsertDepartmentRequest(Request $request)
    {
        //dd($request->all());
        if(!empty($request ->type_requests_id))
        {
            foreach ($request->type_requests_id as $type_requests_id) 
            {
                $getAlreadyFirst = DepartmentRequestModel::getAlreadyFirst($request->dapartments_id, $type_requests_id);
                if (!empty($getAlreadyFirst)) 
                {  
                    $getAlreadyFirst ->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else 
                {
                    $save = new DepartmentRequestModel;
                    $save -> dapartments_id = $request->dapartments_id;
                    $save -> type_requests_id= $type_requests_id;
                    $save -> status = $request->status;
                    $save -> created_by = Auth::user()->id;
                    $save -> save();
                }
            } 
            return redirect('deptAdmin/assign_department_request/list')->with('success',"Type Request Successfully Assign to Department");   
        }
        else
        {
            return redirect()->back()->with('error',"Due to some error pls try again");
        }
    }

    public function EditAllDepartmentRequest($id)
    {
        $getRecord= DepartmentRequestModel::getSingle($id);
        if(!empty($getRecord))
        {   
            $data['getRecord'] = $getRecord;
            $data['getAssignTypeRequestID'] = DepartmentRequestModel::getAssignTypeRequestID($getRecord->dapartments_id);
            $data['getDepartment'] = DepartmentModel::getDepartment();
            $data['getTypeRequest'] = TypeRequestModel::getTypeRequest();
            $data['header_title'] = "Edit Assign Subject";
            return view('dept_admin.department_request.edit', $data);
        }
        else
        {
            abort(404);
        }
    }
    
    public function UpdateAllDepartmentRequest(Request $request)
    {
        DepartmentRequestModel::deletedTypeRequest($request->dapartments_id);

        if(!empty($request->type_requests_id))
        {
            foreach($request->type_requests_id as $type_requests_id)
            {
                $getAlreadyFirst = DepartmentRequestModel::getAlreadyFirst($request->datapartments_id,$type_requests_id);
                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request ->status;
                    $getAlreadyFirst->save();
                }
                else
                {
                    $save = new DepartmentRequestModel;
                    $save -> dapartments_id = $request->dapartments_id;
                    $save -> type_requests_id= $type_requests_id;
                    $save -> status = $request->status;
                    $save -> created_by = Auth::user()->id;
                    $save -> save();
                }
            }          
        }
        return redirect('deptAdmin/assign_department_request/list')->with('success',"Type Request Successfully Assign to Department");   
    }

    public function EditSingleDepartmentRequest($id)
    {
        $getRecord= DepartmentRequestModel::getSingle($id);
        if(!empty($getRecord))
        {   
            $data['getRecord'] = $getRecord;
            $data['getDepartment'] = DepartmentModel::getDepartment();
            $data['getTypeRequest'] = TypeRequestModel::getTypeRequest();
            $data['header_title'] = "EditSingle Assign Subject";
            return view('dept_admin.department_request.edit_single', $data);
        }
        else
        {
            abort(404);
        }

        $getRecord = DepartmentRequestModel::getSingle($id);
        if(!empty($getRecord))
        {
            $data['getRecord'] =$getRecord;
            $data['getDepartment'] = DepartmentModel::getDepartment();
            $data['getTypeRequest'] = TypeRequestModel::getTypeRequest();
            $data['header_title'] = "Edit Assign Subject";
            return view('dept_admin.department_request.edit_single',$data);
        }
    }
    public function UpdateSingleDepartmentRequest($id,Request $request)
    {
        
        $getAlreadyFirst = DepartmentRequestModel::getAlreadyFirst($request->datapartments_id,$request->type_requests_id);
            if (!empty($getAlreadyFirst)) 
            {  
                $getAlreadyFirst ->status = $request->status;
                $getAlreadyFirst->save();

                return redirect('deptAdmin/assign_department_request/list')->with('success',"Type Request Successfully Assign to Department");
            }
            else 
            {
                $save = DepartmentRequestModel::getSingle($id);
                $save -> dapartments_id = $request->dapartments_id;
                $save -> type_requests_id= $request->type_requests_id;
                $save -> status = $request->status;
                
                $save -> save();

               return redirect('deptAdmin/assign_department_request/list')->with('success',"Type Request Successfully Assign to Department"); 
            }
    }
    public function DeletedDepartmentRequest($id)
    {
        $save = DepartmentRequestModel::getSingle($id);
        $save -> is_deleted = 1;
        $save -> save();

         return redirect()->back()->with('success',"Type Request Successfully Assign to Department"); 
    }

//CEO Dashboard
    public function MyDepartmentTypeRequest()
    {
        $data['getRecord'] = DepartmentRequestModel::getMyDepartmentTypeRequest(Auth::user()->id);
        $data['header_title'] = "My Dapartment & Type Request";
        return view('dept_admin.my_department_type_request', $data);
    }
}
