<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Models\RequestModel; 

class ApprovedModel extends Model
{
    //Approve CEO Search Employee
    static public function getSearchEmployee()
    {
        //dd(Request::all());
        $return = RequestModel::select(
                'requests.*',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.email as user_email',
                'users.user_type',
                'approver.name as approver_name',
                'dapartments.name as department_name',
            )
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id')
            ->leftJoin('users as approver', 'approver.id', '=', 'requests.created_by')
            ->where('requests.is_deleted', 0)
            ->where('requests.type_request', '=','Mession');

                // Filter optional
                if (!empty(Request::get('name'))) {
                    $name = Request::get('name');
                    $return->where(function ($query) use ($name) {
                        $query->where('users.name', 'like', "%{$name}%")
                            ->orWhere('users.last_name', 'like', "%{$name}%");
                    });
                }

                if (!empty(Request::get('email'))) {
                    $return->where('users.email', 'like', '%' . Request::get('email') . '%');
                }

                if (!empty(Request::get('department_id'))) {
                    $return->where('users.department_id', Request::get('department_id'));
                }

                if (!empty(Request::get('user_type'))) {
                    $return->where('users.user_type', Request::get('user_type'));
                }

                if (!empty(Request::get('type_request'))) {
                    $return->where('requests.type_request', 'like', '%' . Request::get('type_request') . '%');
                }

        return $return->orderBy('requests.created_at', 'desc')->get();
    }

    // Approve HR Manager Search Employee 
    static public function getSearchApporveHR()
    {
        $return = RequestModel::select(
                'requests.*',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.email as user_email',
                'users.user_type',
                'dapartments.name as department_name',

            )
            ->join('users', 'users.id', '=', 'requests.user_id',)
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id')
            ->where('requests.is_deleted', 0)
            ->where(function ($query) {
                    $query->where(function ($q) {
                        $q->where('users.department_id', 1)
                        ->where('requests.type_request', 'Leave');
                    })
                    ->orWhere(function ($q) {
                        $q->where('users.department_id', 2)
                        ->whereIn('requests.type_request', ['Leave', 'Mession']);
                    });
                });

                // Filter optional
                if (!empty(Request::get('name'))) {
                    $name = Request::get('name');
                    $return->where(function ($query) use ($name) {
                        $query->where('users.name', 'like', "%{$name}%")
                            ->orWhere('users.last_name', 'like', "%{$name}%");
                    });
                }

                if (!empty(Request::get('email'))) {
                    $return->where('users.email', 'like', '%' . Request::get('email') . '%');
                }

                if (!empty(Request::get('department_id'))) {
                    $return->where('users.department_id', Request::get('department_id'));
                }

                if (!empty(Request::get('user_type'))) {
                    $return->where('users.user_type', Request::get('user_type'));
                }

                if (!empty(Request::get('type_request'))) {
                    $return->where('requests.type_request', 'like', '%' . Request::get('type_request') . '%');
                }

        return $return->orderBy('requests.created_at', 'desc')->get();
    }

    //Approve CFO Search Employee
    static public function getSearchApporveCFO()
    {
        $return = RequestModel::select(
                'requests.*',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.email as user_email',
                'users.user_type',
                'dapartments.name as department_name'
            )
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id')
            ->where('requests.is_deleted', 0)
            ->where('requests.department_id', '=', '2');
        return $return->orderBy('requests.created_at', 'desc')->get();
    }

    //Approve Team Leader Search Employee
    static public function getUserApproveDepartmentRequest($user_id)
    {
        $return = RequestModel::select(
                'requests.*',
                'dapartments.name as dapartments_name',
                'type_requests.type_request as type_requests_type_request'
            )
            ->join('dapartments', 'dapartments.id', '=', 'requests.department_id')
            ->join('type_requests', 'type_requests.id', '=', 'requests.type_request_id')
            ->join('dapartment_approve_requests as dar', function ($join) {
                $join->on('dar.dapartment_id', '=', 'requests.department_id')
                    ->whereColumn('dar.type_request_id', '=', 'requests.type_request_id');
            })
            ->where('dar.user_id', '=', $user_id)
            ->where('dar.status', '=', 0)
            ->where('dar.is_deleted', '=', 0)
            ->where('requests.user_type', '=', 7)
            ->where('requests.is_deleted', '=', 0)
            ->distinct()
            ->orderBy('requests.id', 'desc')
            ->paginate(25);

        return $return;

        // $return = RequestModel::select(
        //         'requests.*',
        //         'dapartments.name as dapartments_name',
        //         'type_requests.type_request as type_requests_type_request'
        //     )
        //     ->join('dapartment_approve_requests', 'dapartment_approve_requests.dapartment_id', '=', 'requests.department_id')
        //     ->join('dapartment_approve_requests', 'dapartment_approve_requests.type_request_id', '=', 'requests.type_request_id')
        //     ->join('dapartment_approve_requests as dar', function ($join) {
        //         $join->on('dar.dapartment_id', '=', 'requests.department_id')
        //             ->orOn('dar.type_request_id', '=', 'requests.type_request_id');
        //     })
        //     ->where('dar.user_id', '=', $user_id)
        //     ->where('dar.status', '=', 0)
        //     ->where('dar.is_deleted', '=', 0)
        //     ->where('requests.user_type', '=', 7)
        //     ->where('requests.is_deleted', '=', 0)
        //     ->distinct() // ✅ បន្ថែមនេះ ដើម្បីយកតែ row មិនស្ទួន
        //     ->orderBy('requests.id', 'desc')
        //     ->paginate(25);

        // return $return; 
    }
}
