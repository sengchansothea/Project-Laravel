<?php

namespace App\Http\Controllers;

use App\Models\ApprovedModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\RequestModel;
use App\Models\User;
use Illuminate\Support\Str;

class ApproveController extends Controller
{
    public function MyRequest()
    {
        
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Request Approve";
        if(Auth::user() ->user_type == 3)
        {
            $data['getUserApproveDepartmentRequest'] = ApprovedModel::getUserApproveDepartmentRequest(Auth::user()->id);
            return view('CEO.my_request',$data);
        }
        else if(Auth::user() ->user_type == 4)
        {
            $data['getUserApproveDepartmentRequest'] = ApprovedModel::getUserApproveDepartmentRequest(Auth::user()->id);
            return view('HR_manager.my_request',$data);
        }
        else if(Auth::user() ->user_type == 5)
        {
            $data['getUserApproveDepartmentRequest'] = ApprovedModel::getUserApproveDepartmentRequest(Auth::user()->id);
            return view('CFO.my_request',$data);
        }
        else if(Auth::user() ->user_type == 6)
        {
            $data['getUserApproveDepartmentRequest'] = ApprovedModel::getUserApproveDepartmentRequest(Auth::user()->id);
            return view('teamleader.my_request',$data);
        }
    }
    public function ApproveMyRequest($id)
    {
        $data['getRecord'] = RequestModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Approve My Request";
                return view('CEO.approve_my_request', $data);
        }
        else
        {
            abort(404);
        }  
    }
    
    public function ApprovedRequest($id, Request $request)
    {
        //dd($request->all());
        $request->validate([
            'time' => 'required|max:255',
            'reason' => 'required|max:255',
        ]);

        $user = Auth::user();
        $req = RequestModel::findOrFail($id);

        $req->name = $request->name;
        $req->last_name = $request->last_name;
        $req->gender = $request->gender;
        $req->phone_number = $request->phone_number;
        $req->type_request_id = $request->type_request_id;
        $req->time = $request->time;
        $req->reason = $request->reason;
        $req->status = $request->status;
        $req->created_by = $user->id;

        $req->save();

        return redirect(url('CEO/myRequest'))->with('success', 'សំណើរបស់អ្នកស្នើសុំបានពិនិត្យដោយជោគជ័យ!');
    }

//HR Manager Approve Request
    public function ApproveMyRequestHR($id)
    {
        $data['getRecord'] = RequestModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Approve My Request";
                return view('HR_manager.approve_my_request', $data);
        }
        else
        {
            abort(404);
        } 
    }

    public function ApprovedMyRequestHR($id, Request $request)
    {
        //dd($request->all());
        $request->validate([
            'time' => 'required|max:255',
            'reason' => 'required|max:255',
        ]);

        $user = Auth::user();
        $req = RequestModel::findOrFail($id);

        $req->name = $request->name;
        $req->last_name = $request->last_name;
        $req->gender = $request->gender;
        $req->phone_number = $request->phone_number;
        $req->type_request_id = $request->type_request_id;
        $req->time = $request->time;
        $req->reason = $request->reason;
        $req->status = $request->status;
        $req->created_by = $user->id;

        $req->save();

        return redirect(url('HR_manager/myRequest'))->with('success', 'សំណើរបស់អ្នកស្នើសុំបានពិនិត្យដោយជោគជ័យ!');
    }

    // CFO Approve Request
    public function ApproveMyRequestCFO($id)
    {
        $data['getRecord'] = RequestModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Approve My Request";
                return view('CFO.approve_my_request', $data);
        }
        else
        {
            abort(404);
        } 
    }

    public function ApprovedMyRequestCFO($id, Request $request)
    {
        $request->validate([
            'time' => 'required|max:255',
            'reason' => 'required|max:255',
        ]);

        $user = Auth::user();
        $req = RequestModel::findOrFail($id);

        $req->name = $request->name;
        $req->last_name = $request->last_name;
        $req->gender = $request->gender;
        $req->phone_number = $request->phone_number;
        $req->type_request_id = $request->type_request_id;
        $req->time = $request->time;
        $req->reason = $request->reason;
        $req->status = $request->status;
        $req->created_by = $user->id;

        $req->save();

        return redirect(url('CFO/myRequest'))->with('success', 'សំណើរបស់អ្នកស្នើសុំបានពិនិត្យដោយជោគជ័យ!');
    }

    //Team Leader Approve Request
    public function ApproveMyRequestTL($id)
    {
        $data['getRecord'] = RequestModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Approve My Request";
                return view('teamleader.approve_my_request', $data);
        }
        else
        {
            abort(404);
        } 
    }

    public function ApprovedMyRequestTL($id, Request $request)
    {
        //dd($request->all());
        $request->validate([
            'type_request' => 'required|string|max:255',
            'time' => 'required|max:255',
            'reason' => 'required|max:255',
        ]);

        $user = Auth::user();
        $req = RequestModel::findOrFail($id);

        $req->name = $request->name;
        $req->last_name = $request->last_name;
        $req->gender = $request->gender;
        $req->phone_number = $request->phone_number;
        $req->type_request_id = $request->type_request_id;
        $req->time = $request->time;
        $req->reason = $request->reason;
        $req->status = $request->status;
        $req->created_by = $user->id;

        $req->save();

        return redirect(url('teamleader/myRequest'))->with('success', 'សំណើរបស់អ្នកស្នើសុំបានពិនិត្យដោយជោគជ័យ!');
    }
}
