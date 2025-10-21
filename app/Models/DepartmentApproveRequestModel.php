<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class DepartmentApproveRequestModel extends Model
{
    use HasFactory;

    protected $table = 'dapartment_approve_requests';

    static function getRecord()
    {
        $return = DepartmentApproveRequestModel::select(
            'dapartment_approve_requests.*',
            'dapartments.name as dapartment_name',
            'user.name as user_name',
            'user.last_name as user_last_name',
            'users.name as created_by_name',
            'users.last_name as created_by_last_name'
        )
            ->Join('users as user', 'user.id', '=', 'dapartment_approve_requests.user_id')
            ->Join('dapartments', 'dapartments.id', '=', 'dapartment_approve_requests.dapartment_id')
            ->Join('type_requests', 'type_requests.id', '=', 'dapartment_approve_requests.type_request_id')
            ->Join('users', 'users.id', '=', 'dapartment_approve_requests.created_by')
            ->where('dapartment_approve_requests.is_deleted', '=', 0);

        if (!empty(Request::get('user_name'))) {
            $return = $return->where(function ($query) {
                $query->where('user.name', 'like', '%' . Request::get('user_name') . '%')
                    ->orWhere('user.last_name', 'like', '%' . Request::get('user_name') . '%');
            });
        }
        if(!empty(Request::get('name'))){
            $return = $return->where('dapartments.name', 'like','%'. Request::get('name').'%');
        }

        if (!empty(Request::get('type_request'))) {
            $return = $return->where('dapartment_approve_requests.type_request_id', '=', Request::get('type_request'));
        }
        if (!empty(Request::get('status')) || Request::get('status') === '0') {
            $return = $return->where('dapartment_approve_requests.status', Request::get('status'));
        }
        if (!empty(Request::get('create_date_from'))) {
            $return = $return->whereDate('dapartment_approve_requests.created_at', '>=', Request::get('create_date_from'));
        }

        if (!empty(Request::get('create_date_to'))) {
            $return = $return->whereDate('dapartment_approve_requests.created_at', '<=', Request::get('create_date_to'));
        }

        $return = $return->orderBy('created_at', 'asc')
            ->paginate(25);
        return $return;
    }

    static function getAlreadyFirst($dapatment_id, $user_id, $type_request_id)
    {
        return DepartmentApproveRequestModel::where('dapartment_id', $dapatment_id)
            ->where('type_request_id', $type_request_id)
            ->where('user_id', $user_id)
            ->first();
    }

    static function getSingle($id)
    {
        $return = DepartmentApproveRequestModel::find($id);
        return $return;
    }

    static function getAssignUserID($user_id)
    {
        return DepartmentApproveRequestModel::where('user_id', '=', $user_id)->where('is_deleted', '=', 0)->get();
    }

    static function deletedUser($user_id)
    {
        return DepartmentApproveRequestModel::where('user_id', '=', $user_id)->delete();
    }
    static function getMyDepartmentTypeRequest($user_id)
    {
        return DepartmentApproveRequestModel::select(
            'dapartment_approve_requests.*',
            'dapartments.name as dapartment_name',
            'users.name as created_by_name',
            'users.last_name as created_by_last_name'
        )
            ->join('users', 'users.id', '=', 'dapartment_approve_requests.created_by')
            ->Join('dapartments', 'dapartments.id', '=', 'dapartment_approve_requests.dapartment_id')
            ->where('dapartment_approve_requests.is_deleted', '=', 0)
            ->where('dapartment_approve_requests.status', '=', 0)
            ->where('dapartment_approve_requests.user_id', '=', $user_id)
            ->orderBy('dapartments.name', 'asc')
            ->get();
    }
}
