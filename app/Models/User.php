<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use App\Models\DepartmentModel;
use Illuminate\Support\Facades\Auth;

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

    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists(public_path('upload/' . $this->profile_pic))) {
            return url('upload/' . $this->profile_pic);
        }
        return "";
    }

    static function getSingle($id)
    {
        return User::where('id', '=', $id)->first();
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

    //UserAll in Admin System
    public static function getUserManagement()
    {
        $return = self::select('users.*', 'dapartments.name as department_name')
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id') // ប្រែជា leftJoin
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

    // Get Province in Khmer
    public function getProvinceKhAttribute()
    {
        $provinces = [
            'Kratie' => 'ក្រចេះ',
            'Kandal' => 'កណ្ដាល',
            'Kep' => 'កែប',
            'Kampot' => 'កំពត',
            'Kompong Cham' => 'កំពង់ចាម',
            'Kompong Chhnang' => 'កំពង់ឆ្នាំង',
            'Kompong Thom' => 'កំពង់ធំ',
            'Kompong Speu' => 'កំពង់ស្ពឺ',
            'Koh Kong' => 'កោះកុង',
            'Takaev' => 'តាកែវ',
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

    // Department Admin System List
    public static function getDepartmentAdmins()
    {
        $return = User::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_deleted', '=', 0);

        // Filter optional
        if (!empty(Request::get('name'))) {
            $name = Request::get('name'); 
            $return->where(function($query) use ($name) {
                $query->where('name', 'like', "%{$name}%")
                    ->orWhere('last_name', 'like', "%{$name}%");
            });
        }
        if (!empty(Request::get('gender'))) {
            $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('email'))) {
            $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (is_numeric(Request::get('status'))) {
            $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return->whereDate('users.created_at', '=', Request::get('date'));
        }
        if (!empty(Request::get('province'))) {
            $return->where('users.province', '=', Request::get('province'));
        }

        return $return->orderBy('users.name', 'asc')->paginate(25);
    }

    //CEO Admin System List
    //Relation:User to Department
    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'department_id');
    }
    public static function getCEO()
    {
        $return = self::select('users.*', 'dapartments.name as department_name')
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id') // ប្រែជា leftJoin
            ->where('users.user_type', '=', 3)
            ->where('users.is_deleted', '=', 0);

        // Filter optional
        if (!empty(Request::get('name'))) {
            $name = Request::get('name'); 
            $return->where(function($query) use ($name) {
                $query->where('users.name', 'like', "%{$name}%")
                    ->orWhere('users.last_name', 'like', "%{$name}%");
            });
        }
        if (!empty(Request::get('gender'))) {
            $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('email'))) {
            $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (is_numeric(Request::get('status'))) {
            $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return->whereDate('users.created_at', '=', Request::get('date'));
        }
        if (!empty(Request::get('province'))) {
            $return->where('users.province', '=', Request::get('province'));
        }

        return $return->orderBy('users.name', 'asc')->paginate(25);
    }

    //HR Admin System List
    public static function getHRManager()
    {
        $return = self::select('users.*', 'dapartments.name as department_name')
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id') // ប្រែជា leftJoin
            ->where('users.user_type', '=', 4)
            ->where('users.is_deleted', '=', 0);

        // Filter optional
        if (!empty(Request::get('name'))) {
            $name = Request::get('name'); 
            $return->where(function($query) use ($name) {
                $query->where('users.name', 'like', "%{$name}%")
                    ->orWhere('users.last_name', 'like', "%{$name}%");
            });
        }
        if (!empty(Request::get('gender'))) {
            $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('email'))) {
            $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (is_numeric(Request::get('status'))) {
            $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return->whereDate('users.created_at', '=', Request::get('date'));
        }
        if (!empty(Request::get('province'))) {
            $return->where('users.province', '=', Request::get('province'));
        }

        return $return->orderBy('users.name', 'asc')->paginate(25);
    }

    //CFO Admin System List
    public static function getCFO()
    {
        $return = self::select('users.*', 'dapartments.name as department_name')
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id') // ប្រែជា leftJoin
            ->where('users.user_type', '=', 5)
            ->where('users.is_deleted', '=', 0);

        // Filter optional
        if (!empty(Request::get('name'))) {
            $name = Request::get('name'); 
            $return->where(function($query) use ($name) {
                $query->where('users.name', 'like', "%{$name}%")
                    ->orWhere('users.last_name', 'like', "%{$name}%");
            });
        }
        if (!empty(Request::get('gender'))) {
            $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('email'))) {
            $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (is_numeric(Request::get('status'))) {
            $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return->whereDate('users.created_at', '=', Request::get('date'));
        }
        if (!empty(Request::get('province'))) {
            $return->where('users.province', '=', Request::get('province'));
        }

        return $return->orderBy('users.name', 'asc')->paginate(25);
    }

    //TeamLeader Admin System List
    public static function getTeamLeader()
    {
        $return = self::select('users.*', 'dapartments.name as department_name')
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id') // ប្រែជា leftJoin
            ->where('users.user_type', '=', 6)
            ->where('users.is_deleted', '=', 0);

        // Filter optional
        if (!empty(Request::get('name'))) {
            $name = Request::get('name'); 
            $return->where(function($query) use ($name) {
                $query->where('users.name', 'like', "%{$name}%")
                    ->orWhere('users.last_name', 'like', "%{$name}%");
            });
        }
        if (!empty(Request::get('gender'))) {
            $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('email'))) {
            $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (is_numeric(Request::get('status'))) {
            $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('date'))) {
            $return->whereDate('users.created_at', '=', Request::get('date'));
        }
        if (!empty(Request::get('province'))) {
            $return->where('users.province', '=', Request::get('province'));
        }

        return $return->orderBy('users.name', 'asc')->paginate(25);
    }

    //Employee Admin System List
    public static function getEmployee()
    {
        $return = self::select('users.*', 'dapartments.name as department_name')
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id') // ប្រែជា leftJoin
            ->where('users.user_type', '=', 7)
            ->where('users.is_deleted', '=', 0);

        // Filter optional
        if (!empty(Request::get('name'))) {
            $name = Request::get('name'); 
            $return->where(function($query) use ($name) {
                $query->where('users.name', 'like', "%{$name}%")   // ✅ កែទីនេះ
                    ->orWhere('users.last_name', 'like', "%{$name}%"); // ✅ កែទីនេះ
            });
        }
        
        if (!empty(Request::get('gender'))) {
            $return->where('users.gender', '=', Request::get('gender'));
        }
        if (!empty(Request::get('email'))) {
            $return->where('users.email', 'like', '%' . Request::get('email') . '%');
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
        if (!empty(Request::get('province'))) {
            $return->where('users.province', '=', Request::get('province'));
        }

        return $return->orderBy('users.name', 'asc')->paginate(25);
    }

    //Approve CEO Search Employee
    static public function getSearchEmployee($id)
    {
        //dd(Request::all());
        $return = RequestModel::select(
                'requests.*',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.email as user_email',
                'users.user_type',
                'approver.name as approver_name', // ✅ អ្នកអនុម័ត
                'dapartments.name as department_name'
            )
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->leftJoin('users as approver', 'approver.id', '=', 'requests.created_by') // អ្នកអនុម័ត
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id')
            ->where('requests.is_deleted', 0)
            ->where('requests.created_by', $id) // ✅ បង្ហាញតែសំណើដែលអនុម័តដោយ CEO នោះ
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
    static public function getSearchApporveHR($id)
    {
        $return = RequestModel::select(
                'requests.*',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.email as user_email',
                'users.user_type',
                'approver.name as approver_name', // ✅ អ្នកអនុម័ត
                'dapartments.name as department_name'
            )
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->leftJoin('users as approver', 'approver.id', '=', 'requests.created_by') // អ្នកអនុម័ត
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id')
            ->where('requests.is_deleted', 0)
            ->where('requests.created_by', $id) // ✅ បង្ហាញតែសំណើដែលអនុម័តដោយ CEO នោះ
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
    static public function getSearchApporveCFO($id)
    {
       $return = RequestModel::select(
                'requests.*',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.email as user_email',
                'users.user_type',
                'approver.name as approver_name', // ✅ អ្នកអនុម័ត
                'dapartments.name as department_name'
            )
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->leftJoin('users as approver', 'approver.id', '=', 'requests.created_by') // អ្នកអនុម័ត
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id')
            ->where('requests.is_deleted', 0)
            ->where('requests.created_by', $id)
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
    static public function getSearchApporveTL($id)
    {
         $return = RequestModel::select(
                'requests.*',
                'users.name as user_name',
                'users.last_name as user_last_name',
                'users.email as user_email',
                'users.user_type',
                'approver.name as approver_name', // ✅ អ្នកអនុម័ត
                'dapartments.name as department_name'
            )
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->leftJoin('users as approver', 'approver.id', '=', 'requests.created_by') // អ្នកអនុម័ត
            ->leftJoin('dapartments', 'dapartments.id', '=', 'users.department_id')
            ->where('requests.is_deleted', 0)
            ->where('requests.created_by', $id);

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

    //Get User Approve Department
    static public function getUserDepartment()
    {
        $return = User::select('users.*', 'dapartments.name as dapartments_name',)
            ->join('dapartments', 'dapartments.id', '=', 'users.department_id', 'left')
            ->whereIn('users.user_type', [3,4,5,6])
            ->where('users.is_deleted', '=', 0);
        $return = $return->orderBy('users.updated_at', 'desc')
            ->get();
        return $return;
    }

    //Employee Request dashbord employee
    static public function getRequestEmployee($userId)
    {
        $return = User::select('users.*', 'dapartments.name as dapartments_name')
            ->join('dapartments','dapartments.id', '=', 'users.department_id')
            ->where('users.id', $userId)
            ->where('users.is_deleted', '=', 0);

        $return = $return->orderBy('users.updated_at', 'desc')
            ->paginate(25);
        return $return;
    }
}
