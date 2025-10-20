<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        //dd(Hash::make('123456'));
        if (!empty(Auth::check())) {
           if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 2) {
                return redirect('deptAdmin/dashboard');
            } else if (Auth::user()->user_type == 3) {
                return redirect('CEO/dashboard');
            } else if (Auth::user()->user_type == 4) {
                return redirect('HR_manager/dashboard');
            } else if (Auth::user()->user_type == 5) {
                return redirect('CFO/dashboard');
            } else if (Auth::user()->user_type == 6) {
                return redirect('teamleader/dashboard');
            } else if (Auth::user()->user_type == 7) {
                return redirect('employee/dashboard');
            }
        }
        return view('auth.login');
    }

    public function Authlogin(Request $request)
    {
        $remenber = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remenber)) 
        {
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 2) {
                return redirect('deptAdmin/dashboard');
            } else if (Auth::user()->user_type == 3) {
                return redirect('CEO/dashboard');
            } else if (Auth::user()->user_type == 4) {
                return redirect('HR_manager/dashboard');
            } else if (Auth::user()->user_type == 5) {
                return redirect('CFO/dashboard');
            } else if (Auth::user()->user_type == 6) {
                return redirect('teamleader/dashboard');
            } else if (Auth::user()->user_type == 7) {
                return redirect('employee/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function forgotPassword()
    {
         return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request)
    {
        $user = User::getcheckEmail($request->email);

          if (!empty($user))
          {
               $user->remember_token = Str::random(64);
               $user->save();

               Mail::to($user->email)->send(new ForgetPasswordMail($user));

               return redirect()->back()->with('success', 'Please check your email and reset your password');
          }
          else
          {
               return redirect()->back()->with('error', 'Email not found');
          }
    }


     public function resetPassword($remember_token)
     {
          $user = User::getcheckToken($remember_token);
          if(!empty($user))
          {
               $data['user'] = $user;
               return view('auth.reset', $data);
          }
          else
          {
              abort(404);
          }
     }

     public function PostResetPassword($remember_token,Request $request)
     {
          if($request->password == $request->cpassword)
          {
               $user=User::getcheckToken(($remember_token));
               $user->password = Hash::make($request->password);
               $user->remember_token = Str::random(64);
               $user->save();

               return redirect(url(''))->with('success', 'Password has been reset successfully');
          }
          else
          {
               return redirect()->back()->with('error', 'Password and Confirm Password does not match');
          }
     }

    
}
