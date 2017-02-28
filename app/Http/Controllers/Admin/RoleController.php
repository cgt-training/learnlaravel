<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Role;
use Session;
use App\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AllRole = DB::table('roles')->get();
        return view('admin/permission.role')->withAllrole($AllRole);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //=============================================
        // for custom query show particular user by id
        // $id=2;
        // Role::assignQuery($id);
        //=============================================

        $this->validate($request, array(
                'name'         => 'required|max:255',
                'label'        => 'required|max:1000',
            ));
        // store in the database
        $role = new Role;
        $role->name = $request->name;
        $role->label = $request->label;
        $role->save();
        Session::flash('success', 'The role was successfully save!');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AllRole = DB::table('roles')->get();
        $role = Role::find($id);
        return view('admin/permission.role')->withRole($role)->withAllrole($AllRole);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
            $this->validate($request, array(
                    'name'         => 'required|max:255',
                    'label'         => 'required|max:1000',
            ));
          
       // $post = POST::find($id);
       $role->name = $request->name;
       $role->label = $request->label;
       $role->save();
       Session::flash('success', 'The role was successfully update!');
       return redirect()->route('roles.index', $role->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index');
    }


/*===============For Assign Permission===================*/
    public function assignindex(){
        $AllRole=Role::get();
        return view('admin/permission.assign')->withAllrole($AllRole);
    }

    public function fetchassigndata($id){
        $role = Role::find($id);
        $AllRole = Role::get();

        $allpermission = [];
        $allPermissions = DB::table('permissions')->get();
            foreach($allPermissions as $allPermissionss) {
               $allpermission[$allPermissionss->id] = $allPermissionss->name;
            }

        return view('admin/permission.assign')->withAllrole($AllRole)->withRole($role)->withPermissions($allpermission);
    }

    public function permissionupdate(Request $request, $id){
        $role = Role::find($id);
        // sync id's tags and posts
       if(isset($request->permissions)){
            $role->permissions()->sync($request->permissions);
       } else {
            $role->permissions()->sync(array());
       }

       $AllRole=Role::get();

       Session::flash('success', 'The permissions was successfully update!');
       return view('admin/permission.assign')->withAllrole($AllRole);
    }
/*===============For Assign Role===================*/


   public function assignroleindex(){
        $AllUser=User::get();
        return view('admin/permission.assignrole')->withAlluser($AllUser);
    }

    public function fetchassignrole($id){
        $userdetail = User::find($id);
        $AllUser=User::get();

        $allrole = [];
        $allRoles = DB::table('roles')->get();
            foreach($allRoles as $allRoless) {
               $allrole[$allRoless->id] = $allRoless->name;
            }

        return view('admin/permission.assignrole')->withAlluser($AllUser)->withUserdetail($userdetail)->withAllrole($allrole);
    }

    public function roleupdate(Request $request, $id){
        $AllUser=User::get();
        $user = User::find($id);
        $role=Role::find($request->role_id);
        
        // echo $user['id']; die;
        $role_user = DB::table('role_user')->where('user_id', '=', $user->id)->get();  

        if(isset($role_user)) {
            DB::table('role_user')->where('user_id', '=', $user->id)->delete();
            $user->assign($role['name']);
        }  else {
            $user->assign($role['name']);
        }
       
        Session::flash('success', 'The Role for User was successfully update!');
       return view('admin/permission.assignrole')->withAlluser($AllUser);
    }

}    
