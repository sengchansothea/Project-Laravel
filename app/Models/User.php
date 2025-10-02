<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static function getcheckEmail($email)
    {
        return User::where('email', '=', $email)->first();
    }

    static function getcheckToken($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }

    static function getAdmin()
    {
        $return = User::select('users.*')
            ->where('user_type', '=', 1)
            ->where('is_deleted', '=', 0);

        if (!empty(Request::get('name'))) {
            $name = Request::get('name'); 
            $return->where(function($query) use ($name) {
                $query->where('name', 'like', "%{$name}%")
                    ->orWhere('last_name', 'like', "%{$name}%");
            });
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('name', 'asc')
            ->paginate(25);

        return $return;
    }

    static function getSingle($id)
    {
        return User::where('id', '=', $id)->first();
    }

    public static function getUserManagement()
    {
        $return = self::select('users.*', 'departments.name as department_name')
            ->leftJoin('departments', 'departments.id', '=', 'users.department_id') // ប្រែជា leftJoin
            ->where('users.is_deleted', '=', 0);

        // Filter optional
        if (!empty(Request::get('name'))) {
            $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('user_type'))) {
            $return->where('users.user_type', '=', Request::get('user_type'));
        }
        if (!empty(Request::get('department_id'))) {
            $return->where('users.department_id', '=', Request::get('department_id'));
        }
        if (is_numeric(Request::get('status'))) {
            $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return->whereDate('users.created_at', '=', Request::get('date'));
        }

        return $return->orderBy('users.name', 'asc')->paginate(25);
    }

    // Get User_type 
    public function getRoleNameAttribute()
    {
        $roles = [
            1 => 'System Admin',
            2 => 'Department Admin',
            3 => 'CEO',
            4 => 'HR Manager',
            5 => 'CFO',
            6 => 'Team Leader',
            7 => 'Employee',
        ];

        return $roles[$this->user_type] ?? 'Unknown';
    }

    // Get Province in Khmer
    public function getProvinceKhAttribute()
    {
        $provinces = [
            'Kratie' => 'ក្រចេះ',
            'Kandal' => 'កណ្ដាល',
            'Kep' => 'កែប',
            'Kampot' => 'កំពត',
            'ompong Cham' => 'កំពង់ចាម',
            'Kompong Chhnang' => 'កំពង់ឆ្នាំង',
            'Kompong Thom' => 'កំពង់ធំ',
            'Kompong Speu' => 'កំពង់ស្ពឺ',
            'Koh Kong' => 'កោះកុង',
            'TaKaev' => 'តាកែវ',
            'Thbong Khmum' => 'ត្បូងឃ្មុំ',
            'Pailin' => 'ប៉ៃលិន',
            'Battambang' => 'បាត់ដំបង',
            'Banteay Meanchey' => 'បន្ទាយមានជ័យ',
            'Prey Veng' => 'ព្រៃវែង',
            'Pursat' => 'ពោធិ៍សាត់',
            'Preah Sihanouk' => 'ព្រះសិហនុ',
            'Preah Vihear' => 'ព្រះវិហារ',
            'Phnom Penh' => 'ភ្នំពេញ',
            'Mondulkiri' => 'មណ្ឌលគិរី',
            'Ratanakiri' => 'រតនៈគីរី',
            'Svay Rieng' => 'ស្វាយរៀង',
            'Stung Treng' => 'ស្ទឹងត្រែង',
            'Siem Reap' => 'សៀមរាប',
            'Uddor Meanchey' => 'ឧត្តរមានជ័យ',
        ];

        return $provinces[($this->province)] ?? $this->province;
    }

    // Department Admin List
    public static function getDepartmentAdmins()
    {
        $return = User::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_deleted', '=', 0);

        return $return->orderBy('users.name', 'asc')->paginate(25);
    }

    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists(public_path('upload/' . $this->profile_pic))) {
            return url('upload/' . $this->profile_pic);
        }
        return "";
    }
}
