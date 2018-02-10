<?php 
namespace App\Http\Helpers;
use Illuminate\Support\Facades\Response;
use App\Permission;
use Carbon\Carbon;

class PermissionHelper 
{
	public function store($request){
		
		if($request['roletype'] == 2){
			$permission = new Permission;
			$permission->role_id = $request['roletype'];
			$permission->permissionid = 1;
			$permission->name = 'Admin';
			$permission->save();
			return $permission ? response()->json(['success'=>true]): "";
		}
		else{
      		$permission = new Permission;
		      		$permission->role_id = $request['roletype'];
					$permission->permissionid = 2;
					$permission->name = 'Read Only';
					$permission->save();
      		if($permission){
      			$newquery = New Permission;
      			$newquery->role_id = $request['roletype'];
					$newquery->permissionid = 3;
					$newquery->name = 'Report Only';
					$newquery->save();
      			return response()->json(['success'=>true]);
      		}
			
		}
		
	}
}