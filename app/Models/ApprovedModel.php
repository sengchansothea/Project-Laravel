<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

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

    //Approve Team Leader Search Employee
    static public function getSearchApporveTL($user_id)
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
           
            ->join('dapartment_approve_requests', 'dapartment_approve_requests.dapartment_id', '=', 'dapartments.id')
            ->where('requests.is_deleted', 0)
            ->where('dapartment_approve_requests.status', '=', 0)
            ->where('dapartment_approve_requests.is_deleted', '=', 0)
            ->where('users.user_type', '=', 7)
            ->where('users.is_deleted', '=',0)
            ->where('dapartment_approve_requests.user_id', '=',$user_id)
            ->distinct();

        return $return->orderBy('requests.created_at', 'desc')->get();
    }
}
