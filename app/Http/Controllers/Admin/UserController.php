<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Session;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    protected function getRegister()
    {
        if (Auth::guard('admin')->user()->can('create_user')) {
            return $this->showRegistrationForm();
        } 
        else 
        {
            Session::flash('error', 'You are not Authorised');
            return redirect()->route('adminhome');
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    protected function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        return view('admin/auth.register');
    }

    protected function user_Store(Request $request){
    	$this->validate($request, array(
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
       ));
       
        $user = new User; 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->remember_token = $request->_token;
        // $user->created_at = 'NOW()';
        // $user->updated_at = 'NOW()';

        $user->save();
        
       
        Session::flash('success', 'The user was successfully save!');
        return redirect()->route('adminhome');
    }

    protected function index(){
    	$Allusers = User::orderBy('id', 'asc')->paginate(5);
        return view('admin/auth.users', ['Allusers' => $Allusers]);
    }

    protected function destroy($id) {
       if (Auth::guard('admin')->user()->can('delete_user')) { 
    	   $user = User::findOrFail($id);
           $user->delete();
           return redirect()->route('adminhome');
        }
        else 
        {
            Session::flash('error', 'You are not Authorised');
            return redirect()->route('adminhome');
        }   
    }

}
