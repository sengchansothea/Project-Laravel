<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentApproveRequestModel;
use App\Models\DepartmentModel;
use App\Models\TypeRequestModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 

class DepartmentApproveRequestController extends Controller
{
    public function DepartmentApproveRequestList()
    {
        $data['getRecord'] = DepartmentApproveRequestModel::getRecord();
        $data['header_title'] = "Department Approve Request List";
        return view('dept_admin.department_approve_request.list', $data);
    }

    public function AddDepartmentApproveRequest()
    {
        $data['getDepartment'] = DepartmentModel::getDepartment();
        $data['getUser'] = User::getUserDepartment();
        $data['getTypeRequest'] = TypeRequestModel::getTypeRequest();
        $data['header_title'] = " Add Department Approve Request";
        return view('dept_admin.department_approve_request.add', $data);
    }

    public function InsertDepartmentApproveRequest(Request $request)
    {
        //dd($request->all());
        if(!empty($request->user_id))
        {
            foreach($request->dapartment_id as $dapartment_id)
            {
                foreach($request->type_request_id as $type_request_id)
                {
                    $getAlreadyFirst = DepartmentApproveRequestModel::getAlreadyFirst($request->user_id, $dapartment_id, $type_request_id);
                    if(!empty($getAlreadyFirst))
                    {
                        $getAlreadyFirst ->status = $request->status;
                        $getAlreadyFirst->save();
                    }
                    else
                    {
                        $save = new DepartmentApproveRequestModel;
                        $save -> dapartment_id = $dapartment_id;
                        $save -> type_request_id = $type_request_id;
                        $save -> user_id= $request->user_id;
                        
                        $save -> status = $request->status;                  
                        $save -> created_by = Auth::user()->id;
                        $save -> save();
                    }
                } 
            }
            return redirect('deptAdmin/assign_department_approver/list')->with('success',"Department Assign to User Successfully");   
        }
        else
        {
            return redirect()->back()->with('error',"Due to some error pls try again");
        }
    }

    public function EditAllDepartmentApproveRequest($id)
    {
        $getRecord= DepartmentApproveRequestModel::getSingle($id);
        if(!empty($getRecord))
        {   
            $data['getRecord'] = $getRecord;
            $data['getAssignUserID'] = DepartmentApproveRequestModel::getAssignUserID($getRecord->user_id);
            $data['getDepartment'] = DepartmentModel::getDepartment();
            $data['getTypeRequest'] = TypeRequestModel::getTypeRequest();
            $data['getUser'] = User::getUserDepartment();
            $data['header_title'] = "Edit Assign Department User";
            return view('dept_admin.department_approve_request.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function UpdateAllDepartmentApproveRequest($id,Request $request)
    {
        DepartmentApproveRequestModel::deletedUser($request->user_id);
        if(!empty($request->dapartment_id))
        {
            foreach($request->dapartment_id as $dapartment_id)
            {
                foreach($request->type_request_id as $type_request_id)
                {
                    $getAlreadyFirst = DepartmentApproveRequestModel::getAlreadyFirst($request->user_id, $dapartment_id, $type_request_id);
                    if(!empty($getAlreadyFirst))
                    {
                        $getAlreadyFirst ->status = $request->status;
                        $getAlreadyFirst->save();
                    }
                    else
                    {
                        $save = new DepartmentApproveRequestModel;
                        $save -> dapartment_id = $dapartment_id;
                        $save -> type_request_id = $type_request_id;
                        $save -> user_id= $request->user_id;
                        $save -> status = $request->status;
                        $save -> created_by = Auth::user()->id;
                        $save -> save();
                    }
                }
            }
        }
        return redirect('deptAdmin/assign_department_approver/list')->with('success',"Department Assign to User Successfully");   
    }

    public function EditSingleDepartmentApproveRequest($id)
    {
        $getRecord= DepartmentApproveRequestModel::getSingle($id);
        if(!empty($getRecord))
        {   
            $data['getRecord'] = $getRecord;
            $data['getDepartment'] = DepartmentModel::getDepartment();
            $data['getTypeRequest'] = TypeRequestModel::getTypeRequest();
            $data['getUser'] = User::getUserDepartment();
            $data['header_title'] = "Edit Assign Department User";
            return view('dept_admin.department_approve_request.edit_single', $data);           
        }
        else
        {
            abort(404);
        }
    }

    public function UpdateSingleDepartmentApproveRequest($id,Request $request)
    {
        //dd($request->all());
        $getAlreadyFirst = DepartmentApproveRequestModel::getAlreadyFirst($request->user_id, $request->dapartment_id, $request->type_request_id);
            if (!empty($getAlreadyFirst)) 
            {  
                $getAlreadyFirst ->status = $request->status;
                $getAlreadyFirst->save();

                return redirect('deptAdmin/assign_department_approver/list')->with('success',"Assign Teacher Successfully Update");
            }
            else 
            {
                $save = DepartmentApproveRequestModel::getSingle($id);
                $save -> dapartment_id =$request->dapartment_id;
                $save -> type_request_id = $request->type_request_id;
                $save -> user_id= $request->user_id;
                $save -> status = $request->status;
                $save -> save();
                

                return redirect('deptAdmin/assign_department_approver/list')->with('success',"Department Assign to User Successfully");   
            }
    }

    public function DeletedDepartmentApproveRequest($id)
    {
        $save = DepartmentApproveRequestModel::getSingle($id);
        $save -> is_deleted = 1;
        $save -> save();

         return redirect()->back()->with('success',"Department Assign to User Deleted Successfully");   
    }

    static function MyDepartmentTypeRequest()
    {
        $data['getRecord'] = DepartmentApproveRequestModel::getMyDepartmentTypeRequest(Auth::user()->id);
        $data['header_title'] = "My Department & TypeRequest";
        return view('teamLeader.my_department_type_request', $data);
    }
}
