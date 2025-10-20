<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class DepartmentRequestModel extends Model
{
    use HasFactory;

    protected $table = 'dapartment_type_requests';

    static function getRecord()
    {
        $return = DepartmentRequestModel::select(
                    'dapartment_type_requests.*', 
                    'dapartments.name as dapartment_name', 
                    'type_requests.name as type_request_name',
                    'users.name as created_by_name',
                    'users.last_name as created_by_last_name',
                    )
                ->Join('dapartments', 'dapartments.id','=', 'dapartment_type_requests.dapartments_id')
                ->Join('type_requests', 'type_requests.id','=', 'dapartment_type_requests.type_requests_id')
                ->Join('users', 'users.id','=', 'dapartment_type_requests.created_by')
                ->where('dapartment_type_requests.is_deleted', '=',0 );
                
                if(!empty(Request::get('name')))
                {
                    $return = $return->where('dapartments.name', 'like', '%'.Request::get('name').'%');
                }
                if(!empty(Request::get('type_request')))
                {
                    $return = $return->where('type_requests.name', 'like', '%'.Request::get('type_request').'%');
                }
                if(!empty(Request::get('date')))
                {
                    $return = $return->wheredDate('subjects.created_at', 'like', '%'.Request::get('date').'%');
                }

        $return = $return ->orderBy('dapartment_name','asc')
                ->paginate(25);
        return $return;
    }

    static function getAssignTypeRequestID($dapartments_id)
    {
        return DepartmentRequestModel::where('dapartments_id', '=', $dapartments_id)->where('is_deleted', '=', 0)->get();
    }
    static function getSingle($id)
    {
      $return = DepartmentRequestModel::find($id);
        return $return;
    }

    static function getAlreadyFirst($dapartments_id, $typerequests_id)
    {
        return DepartmentRequestModel::where('dapartments_id', ' ', $dapartments_id)->where('type_requests_id', '=', $typerequests_id)->first();
    }

    static function deletedTypeRequest($dapartments_id)
    {
        return DepartmentRequestModel::where('dapartments_id', '=', $dapartments_id)->delete();
    }

    
}
