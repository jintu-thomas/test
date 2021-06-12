<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;


class PermissionController extends Controller
{
    public function permission()
    {
        $user = User::findOrFail(1);
        $user->assignRole('Super_Admin');
        return response()->json(["success message"=>$user]);
    }

    // public function rolePermission()
    // {
    //     $role = Role::findOrFail(4);
    //     // $role->givePermissionTo('blog-read','blog-edit','blog-create','blog-delete','user-create','assign-permission');
    //     // $role->givePermissionTo('blog-read','blog-edit','blog-create','blog-delete','user-create','assign-permission');
    //     // $role ->givePermissionTo('blog-read','blog-edit','assign-permission','user-create');
    //     $role ->givePermissionTo('blog-read');
    //     return response()->json(["message"=>"success"]);
    // }
}
