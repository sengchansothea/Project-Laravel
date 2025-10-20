<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;
use App\Models\User;
class RequestModel extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'user_id', 'name', 'last_name', 'gender', 'phone_number',
        'profile_pic', 'email', 'type_request', 'time', 'reason', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // get profile image fallback
    public function getProfile()
    {
        if (!empty($this->profile_pic)) {
            return url('upload/' . $this->profile_pic);
        } elseif ($this->user) {    
            return $this->user->getProfile();
        }
        return '';
    }

    public static function getRecord($userId)
    {
        return self::select('requests.*', 'users.name as user_name','dapartments.name as department_name')
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->join('dapartments', 'dapartments.id', '=', 'requests.department_id')
            ->where('requests.user_id', $userId)
            ->where('requests.is_deleted', 0)
            ->orderBy('requests.created_at', 'desc')
            ->get();
    }
    

    // static function getRecord()
    // {
    //     $return = RequestModel::select('requests.*', 'users.name as created_by_name', 'users.last_name as created_by_last_name')
    //             ->Join('users', 'users.id', 'requests.created_by'); 
    //             $return = $return->where('requests.is_deleted','=', 0)
    //             ->orderBy('requests.name','asc')
    //             ->paginate(25);
    //     return $return;
    // }

    static function getSingle($id)
    {
        $return = RequestModel::find($id);
        return $return;
    }
}
