<?php

namespace App\Http\Controllers;

use App\Models\DepartmentModel;
use Illuminate\Http\Request;
use App\Models\RequestModel;
use App\Models\TypeRequestModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FormRequestController extends Controller
{

// Admin System Dashboard
    // public function RequestList()
    // {
    //     $data['getRecord'] = RequestModel::getRecord();
    //     $data['header_title'] = "Request List";
    //     return view('admin.request.list', $data);
    // }

    // public function RequestAdd()
    // {
    //     $data['header_title'] = "Add Request";
    //     return view('admin.request.add', $data);
    // }

    // public function RequestInsert(Request $request)
    // {
    //     //dd($request->all());
    //     $save = new RequestModel();
    //     $save->name = $request->name;
    //     $save->status = $request->status;
    //     $save->created_by = Auth::user()->id;
    //     $save->save();

    //     return redirect('admin/request/requestlist')->with('success', 'Request Added Successfully.');
    // }

    // public  function RequestEdit($id)
    // {
    //     $data['getRecord'] = RequestModel::getSingle($id);
    //     if (!empty($data['getRecord'])) {
    //         $data['header_title'] = "Edit Request";
    //         return view('admin.request.edit', $data);
    //     } else {
    //         abort(404);
    //     }
    // }

    // public function RequestUpdate($id,Request $request)
    // {
    //     //dd($request->all());
    //     $save = RequestModel::getSingle($id);
    //     $save->name = $request->name;
    //     $save->status = $request->status;
    //     $save->created_by = Auth::user()->id;
    //     $save->save();

    //     return redirect('admin/request/requestlist')->with('success', 'Request Updated Successfully.');
    // }

    // public function RequestDelete($id)
    // {
    //     $save = RequestModel::getSingle($id);
    //     $save->is_deleted = 1;
    //     $save->save();

    //     return redirect('admin/request/requestlist')->with('success', 'Subject deleted successfully.');
    // }

//Employee Dashboard
    public function FormRequest()
    {   
        $data['getRecords'] = RequestModel::getRecord(Auth::id());
        $data['header_title'] = "Request Form";
        return view('employee.formRequest', $data);
    }

    public function AddRequest()
    {
        $data['user'] = Auth::user();
        $data['getTypeRequest']= TypeRequestModel::getTypeRequest();
        $data['getDepartment'] = DepartmentModel::getDepartment();
        $data['header_title'] = "Add Request Form";
        return view('employee.addRequest', $data);
    }


    public function InsertRequest(Request $request)
    {
        //dd($request->all());
        $user = Auth::user();

        $request->validate([
            'time' => 'required|max:255',
            'reason' => 'required|max:255',
        ]);

        $req = new RequestModel();
        $req->user_id = $user->id;
        // copy snapshot
        $req->name = $user->name;
        $req->last_name = $user->last_name;
        $req->gender = $user->gender;
        $req->phone_number = $user->phone_number;
        // profile picture
        if (!empty($request->file('profile_pic'))) {
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . Str::random(10) . '.' . $ext;
            $file->move(public_path('upload/'), $filename);
            $req->profile_pic = $filename;
        } else {
            $req->profile_pic = $user->profile_pic; // fallback
        }
        $req->department_id = $user->department_id;
        $req->type_request_id = $request->type_request_id;
        $req->time = $request->time;
        $req->reason = $request->reason;
        $req->status = 1;
        $req->user_type = 7;
        $req->created_by = $user->id;
        $req->save();

        return redirect(url('employee/formRequest'))->with('success', 'សំណើរបស់អ្នកត្រូវបានបញ្ចូលដោយជោគជ័យ!');

    }

    public function EditRequest($id)
    {
        $data['getRecord'] = RequestModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['getTypeRequest']= TypeRequestModel::getTypeRequest();
            $data['getDepartment'] = DepartmentModel::getDepartment();
            $data['header_title'] = "Edit Employee Leader";
                return view('employee.editRequest', $data);
        }
        else
        {
            abort(404);
        }  
    }
    
    public function UpdateRequest($id, Request $request)
    {
        //dd($request->all());
        $user = Auth::user();

        $request->validate([
            'time' => 'required|max:255',
            'reason' => 'required|max:255',
        ]);
        $req = RequestModel::getSingle($id);
        $req->user_id = $user->id;
        $req->name = $request->name;
        $req->last_name = $request->last_name;
        $req->gender = $request->gender;
        $req->phone_number = $request->phone_number;
        $req->department_id = $request->department_id;
        $req->type_request_id = $request->type_request_id;
        $req->time = $request->time;
        $req->reason = $request->reason;
        $req->status = 1;
        $req->user_type = 7;
        $req->created_by = $user->id;
        $req->save();

        return redirect(url('employee/formRequest'))->with('success', 'សំណើរបស់អ្នកត្រូវបានកែប្រែដោយជោគជ័យ!');
    }

    public function DeletedRequest($id)
    {
        $req = RequestModel::getSingle($id);
        $req->is_deleted = 1;
        $req->save();
        return redirect()->back()->with('success', 'សំណើរបស់អ្នកត្រូវបានលុបដោយជោគជ័យ');
    }
}
// ការបងប្អូន
// 2ថ្ងៃ ចាប់ពីថ្ងៃទី២៨  ខែតុលា​ ឆ្នាំ២០២៥ ដល់ថ្ងៃទី៣០ ខែតុលា ឆ្នាំ២០២៥