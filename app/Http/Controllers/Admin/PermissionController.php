<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Permission;
use Session;
use Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $AllPermission = DB::table('permissions')->get();
        $AllPermission = Permission::orderBy('id', 'asc')->paginate(5);
        // $AllPermission=Permission::get();
        return view('admin/permission.permission')->withAllpermission($AllPermission);
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
        if (Auth::guard('admin')->user()->can('create_permission')) { 
            $this->validate($request, array(
                    'name'         => 'required|max:255',
                    'label'        => 'required|max:1000',
                ));
            // store in the database
            $permission = new Permission;
            $permission->name = $request->name;
            $permission->label = $request->label;
            $permission->save();
            Session::flash('success', 'The permission was successfully save!');
            return redirect()->route('permissions.index');
        }
        else {
            Session::flash('error', 'You are not Authorised');
            $AllPermission = Permission::orderBy('id', 'asc')->paginate(5);
            return view('admin/permission.permission')->withAllpermission($AllPermission);
        }
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
       if (Auth::guard('admin')->user()->can('edit_permission')) { 
        $AllPermission = Permission::orderBy('id', 'asc')->paginate(5);
        $permission = Permission::find($id);
        return view('admin/permission.permission')->withPermission($permission)->withAllpermission($AllPermission);
        }
        else {
            Session::flash('error', 'You are not Authorised');
            $AllPermission = Permission::orderBy('id', 'asc')->paginate(5);
            return view('admin/permission.permission')->withAllpermission($AllPermission);
        }
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
        $permission = Permission::find($id);
            $this->validate($request, array(
                    'name'         => 'required|max:255',
                    'label'         => 'required|max:1000',
            ));
          
       // $post = POST::find($id);
       $permission->name = $request->name;
       $permission->label = $request->label;
       $permission->save();
       Session::flash('success', 'The permission was successfully update!');
       return redirect()->route('permissions.index', $permission->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->can('edit_permission')) { 
            $permission = Permission::findOrFail($id);
            $permission->delete();
            return redirect()->route('permissions.index');
        }
        else {
            Session::flash('error', 'You are not Authorised');
            $AllPermission = Permission::orderBy('id', 'asc')->paginate(5);
            return view('admin/permission.permission')->withAllpermission($AllPermission);
        }    
    }
}
