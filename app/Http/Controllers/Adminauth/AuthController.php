<?php

namespace App\Http\Controllers\Adminauth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins; 
    protected $redirectTo = '/dashboard';
    // protected $redirectAfterLogout = 'login';

    protected $guard = 'admin';
    public function showLoginForm()
    {
        if(Auth::guard('admin')->check())
        {
            return redirect('/dashboard');
        }
        return view('login'); 
    }


    protected function login(Request $request)
    {
        $this->validateLogin($request);
        
        $user_email = $request->email;
        $user_id = DB::table('users')->where('email', $user_email)->get();
        $role_id = DB::table('role_user')->where('user_id', $user_id[0]->id)->get();
        //print_r($role_id[0]->role_id); die;

         if($role_id[0]->role_id == 2 OR $role_id[0]->role_id == 3){

            // check role admin or subadmin inside if condition.

            $throttles = $this->isUsingThrottlesLoginsTrait();

            if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            $credentials = $this->getCredentials($request);

            if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
                return $this->handleUserWasAuthenticated($request, $throttles);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if ($throttles && ! $lockedOut) {
                $this->incrementLoginAttempts($request);
            }

            return $this->sendFailedLoginResponse($request);
         }
         else{

            Session::flash('error', 'You are not valid User!');
            return redirect('/admin');
         }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
