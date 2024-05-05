<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // create new user
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha_num|max:255',
            'email' => 'required|email'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json(['message' => 'user created successfully.'], 201);
    }

    public function getAllUsers(Request $request)
    {
        $limit = is_numeric($request->limit) ? (int)$request->limit : 5;
        $page = is_numeric($request->page) ? (int)$request->page : 1;
        $offset = ($page - 1) * $limit;
        if ($request->admin_true && $request->admin_true) {
            // if received admin_true=>true, include admin users
            $users = User::limit($limit)->offset($offset)->get();
        } else {
            $users = User::limit($limit)->offset($offset)->where('role', '!=', 'admin')->get();
        }
        return response()->json(['users' => $users, 'current_page' => $page]);
    }
}
