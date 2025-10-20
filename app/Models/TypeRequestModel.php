<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class TypeRequestModel extends Model
{
    use HasFactory;

    protected $table = 'type_requests';

    static function getRecord()
    {
        $return = TypeRequestModel::select('type_requests.*', 'users.name as created_by_name', 'users.last_name as created_by_last_name')
                ->Join('users', 'users.id', 'type_requests.created_by'); 
                
                if(!empty(Request::get('name')))
                {
                    $return = $return->where('type_requests.name', 'like','%'.Request::get('name').'%');
                }
                if(!empty(Request::get('type_request')))
                {
                    $return = $return->where('type_requests.type_request','=',Request::get('type_request'));
                }
                if(!empty(Request::get('date')))
                {
                    $return = $return->where('type_requests.created_at', 'like', '%'.Request::get('date').'%');
                }

                $return = $return->where('type_requests.is_deleted','=', 0)
                ->orderBy('type_requests.type_request','asc')
                ->paginate(25);
        return $return;
    }

    static function getSingle($id)
    {
        $return = TypeRequestModel::find($id);
        return $return;
    }

    static function getTypeRequest()
    {
        $return = TypeRequestModel::select('type_requests.*')
                ->Join('users', 'users.id', 'type_requests.created_by')
                ->where('type_requests.is_deleted','=', 0)
                ->where('type_requests.status','=', 0)
                ->orderBy('type_requests.name','asc')
                ->get();
        return $return;
    }
}
