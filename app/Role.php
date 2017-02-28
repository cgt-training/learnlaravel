<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    public function permissions(){
    	return $this->belongsToMany('App\Permission'); 
    }

    public function assign(Permission $permission) {
    	return $this->permissions()->save($permission);
    }



    public function users()
    {
        return $this->hasMany('App\User');
    }




//==========for custom query using method===================================
    // public static function assignQuery($id){
    // 	$results = DB::select('select * from roles where id = :id', ['id' => $id]);
    // 	echo '<pre>'; print_r($results); die;
    // }
//=============================================    
}
