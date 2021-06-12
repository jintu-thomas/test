<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    public function roleAssign($user_id, $role)
    {
        if(auth()->user()->hasRole(1))
        {
            if($role == 2 || $role == 3 || $role == 4)
            {
                $user = User::findOrFail($user_id);
                $user->assignRole($role);
                return response()->json(["Assigning role is successfull "]);
            } else {
                return response()->json(["message"=>"you can not  assign this role to any user"]);
            }
        }
        if(auth()->user()->hasRole(2))
        {   
            if($role == 3 || $role == 4) 
            {
                $user = User::findOrFail($user_id);
                $user->assignRole($role);
                return response()->json(["Assigning role is successfull "]);

            } else {
                return response()->json(["message"=>"dont have Permission to assign this role to any user"]);
            }
        } 

        if(auth()->user()->hasRole(3))
        {   
            if($role == 4)
            {
                $user = User::findOrFail($user_id);
                $user->assignRole($role);
                return response()->json(["Assigning role is successfull "]);
                
            } else {
                return response()->json(["You can not assign this role to this user"]);
            }
        } else {
            return response()->json(["You can not assign this role to this user"]);
        }

        if(auth()->user()->hasRole(4))
        {
            return response()->json(["You can not have any other permissions"]);
        }
         
    }
}
