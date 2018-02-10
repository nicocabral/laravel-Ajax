<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
class PermissionController extends Controller
{
    //
    public function show($id){
    	$permission = Permission::whereRole_id($id)->get();
    	return $permission;
    }
}
