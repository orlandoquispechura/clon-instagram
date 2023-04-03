<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search = null)
    {
        if (!empty($search)) {
            $users = User::OrderBy('id', 'desc')
                ->where('name', 'LIKE', '%' . $search . '%')
                ->paginate(5);
        } else {
            $users = User::OrderBy('id', 'desc')->paginate(5);
        }

        return view('admin.user.index', compact('users'));
    }
    public function publicacion($id)
    {
        $user = User::find($id);

        return view('admin.user.publicacion', compact('user'));
    }
}
