<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class DepartmentModel extends Model
{
    use HasFactory;

    protected $table = 'dapartments'; // table name
    protected $fillable = [
        'name',
        'status',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    static function getRecord()
    {
        $return = DepartmentModel::select('dapartments.*', 'users.name as created_by_name', 'users.last_name as created_by_last_name')
                ->Join('users', 'users.id', 'dapartments.created_by');

                if(!empty(Request::get('name')))
                {
                    $return = $return->where('dapartments.name', 'like', '%'.Request::get('name').'%');
                }
                if(!empty(Request::get('date')))
                {
                    $return = $return->where('dapartments.created_at', 'like', '%'.Request::get('date').'%');
                }

                $return = $return->where('dapartments.is_deleted','=', 0)
                ->orderBy('dapartments.updated_at','desc')
                ->paginate(25);
        return $return;
    }

    static function getSingle($id)
    {
        $return = DepartmentModel::find($id);
        return $return;
    }

    static function getDepartment()
    {
        $return = DepartmentModel::select('dapartments.*')
            ->Join('users', 'users.id', 'dapartments.created_by')
            ->where('dapartments.is_deleted', '=', 0)
            ->where('dapartments.status', '=', 0)
            ->orderBy('dapartments.name', 'asc')
            ->get();
        return $return;
    }
}
