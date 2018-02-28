<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use App\Role;
use App\Permission;
use Validator;
use DB;
use Carbon\Carbon;
use App\Http\Helpers\PermissionHelper;
use App\Http\Helpers\LogsHelper;
class RoleController extends Controller
{
    //

    public function index(){
    	return view('dashboard.roles.index');
    }

    public function store(Request $request){
    	try{


    	$message = ['roletype.required' => 'Role type is required',
    				'rolename.required' => 'Role name is required'];
    	$validator = Validator::make($request->all(),['roletype' => 'required|unique:roles,roleid',
    												  'rolename' => 'required|unique:roles,name'],$message);
    	if($validator->fails()){
    		 return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
    	}
    	$role = new Role;
    	$role->roleid = $request['roletype'];
    	$role->name = $request['rolename'];
    	$role->save();
    	$permission = new PermissionHelper();
    	$permission->store($request->all());
        $log = new LogsHelper();
        $log->store('store','Role Created by '.Auth::user()->name);
    	return $role && $permission ? response()->json(['success'=>true,'message' => 'Role Created']) : "";
    }catch(\Exception $e){
    	return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    }

    }
    public function apiRoles(){
    	$role = Role::whereDeleted_at(Null)->get();
    	return DataTables::of($role)->make(true);
    }

    public function destroy($id){
    	try{
    		$role = Role::whereId($id)->update(['deleted_at'=> Carbon::now('Asia/Manila')]);
            $log = new LogsHelper();
            $log->store('Delete','Delete '.$id);
    		return $role ? response()->json(['success'=>true,'message'=>'Deleted successfully']) : "";
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message'=>$e->getMessage()]);
    	}

    }
    public function edit($id){
    	try{
    		$role = Role::findOrFail($id);
    		return $role;
    	}catch(\Exception $e){
    		return response()->json(['fail'=>true,'message' => $e->getMessage()]);
    	}
    }

    public function update(Request $request, $id){
    	try{
    		$message = ['roletype.required' => 'Role type is required',
    				'rolename.required' => 'Role name is required'];
	    	$validator = Validator::make($request->all(),['roletype' => 'required|unique:roles,roleid,'.$id,
	    												  'rolename' => 'required|unique:roles,name,'.$id],$message);
	    	if($validator->fails()){
	    		 return response()->json(['success'=>false,'errors' => $validator->getMessageBag()->toArray()]);
	    	}
	    	$role = Role::whereId($id)->update(['roleid' => $request['roletype'],'name'=>$request['rolename']]);
            $log = new LogsHelper();
            $log->store('Update','Update Role by'.Auth::user()->name);
	    	return $role ? response()->json(['success'=>true,'message'=>'Role Updated']): ""; 
    	}catch(\Exception $e){
    		return response()->json(['fail' => true,'message'=>$e->getMessage()]);
    	}
    }


    public function showRoles(){
        $role = Role::all();
        return $role;
    }
}
