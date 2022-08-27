<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        $users=User::all();
        return view('admin.users.index',compact('users'));
        
    }

    public function viewUser($id)
    {
        $user=User::find($id);
        return view('admin.users.view',compact('user'));
    }
}
