<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function getUsers(Request $request)
    {
        
    	return view('admin', [
    		'users' => User::orderBy('created_at','asc')
						->get()
    		]);
    }
    public function approveUser(Request $request, User $user)
    {
    	$user->approved = true;
    	$user->save();
    	return redirect('/admin');
    }

}
