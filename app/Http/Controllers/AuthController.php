<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Admin;


class AuthController extends Controller
{
    public function adminLoginPage()
    {
        return view('admin.login');
    }

    public function adminLoginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:190',
            'password' => 'required|min:8|max:10',
        ]);

        $admin = Admin::where(['email'=>$request->email])->first();
        if(!is_null($admin))
        {
            if(Hash::check($request->password, $admin->password))
            {
                if( Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]) )
                {
                    if(Auth::guard('admin')->check())
                    {
                        $notification = ['message'=>"admin authenticate successfully",'type'=>'danger'];
                        return redirect()->route('admin.dashboard');
                    }
                }
                else
                {
                    $notification = ['message'=>"authentication failed",'type'=>'danger'];
                    return redirect()->route('admin.login.page')->with($notification);
                }
            }
            else
            {
                $notification = ['message'=>"credentials wrong",'type'=>'danger'];
                return redirect()->route('admin.login.page')->with($notification);
            }
        }
        else
        {
            $notification = ['message'=>"record not found",'type'=>'danger'];
            return redirect()->route('admin.login.page')->with($notification);
        }
    }

    public function adminLogoutProcess(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.login.page');
    }

    public function loginPage()
    {
        return view('user.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:190',
            'password' => 'required|min:8|max:10',
        ]);

        $user = User::where(['email'=>$request->email])->first();
        if(!is_null($user))
        {
            if(Hash::check($request->password, $user->password))
            {
                if( Auth::attempt(['email' => $request->email, 'password' => $request->password]) )
                {
                    if(Auth::check())
                    {
                        $notification = ['message'=>"admin authenticate successfully",'type'=>'danger'];
                        return redirect()->route('user.dashboard');
                    }
                }
                else
                {
                    $notification = ['message'=>"authentication failed",'type'=>'danger'];
                    return redirect()->route('auth.login.page')->with($notification);
                }
            }
            else
            {
                $notification = ['message'=>"credentials wrong",'type'=>'danger'];
                return redirect()->route('auth.login.page')->with($notification);
            }
        }
        else
        {
            $notification = ['message'=>"record not found",'type'=>'danger'];
            return redirect()->route('auth.login.page')->with($notification);
        }
    }

    public function logoutProcess(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.login.page');
    }

    public function registrationPage()
    {
        return view('user.registration');
    }

    public function registrationProcess(Request $request)
    {
        $toDay = Carbon::now()->format('d-m-Y');
        $request->validate([
            'first_name' => 'required|string|max:190',
            'last_name' => 'required|string|max:190',
            'dob' => 'required|date|before:'.$toDay,
            'email' => 'required|email|max:190|unique:users,email',
            'password' => 'required|min:8|max:10|confirmed',
        ]);

        try {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->dob = $request->dob;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if($user->save()){
                $notification = ['message'=>"Your registration completed successfully.",'type'=>'success'];
                return redirect()->route('auth.register.page')->with($notification);
            }
        } catch (\Exception $e) {
            $notification = ['message'=>"Something wrong!",'type'=>'warning'];
            return redirect()->route('auth.register.page')->with($notification);
        }
    }
}
