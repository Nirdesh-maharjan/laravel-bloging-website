<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;



class UserController extends Controller
{
    public function index()
{
    $users = User::withCount('posts')
        ->latest()
        ->paginate(10);

    return view('users.index', compact('users'));
}
    function userName()
    {
        // return "John Doe";
        return view('user');
    }
    function aboutUser()
    {
        return "John Doe is a software developer.";
    }
    function getUserName($name)
    {
        // return "this is " . $name;
        return view('getUser', ['name' => $name]);
    }
    function userHome()
    {
        $name="John";
        $users=["John", "Jane", "Doe"];
        return view('home' , ['name' => $name , 'users' => $users]);
    }
    function userAbout($name)
    {
        return view('About', ['name' => $name]);
    }
    function adminLogin()
    {
        return view('admin.Login');
    }
}
