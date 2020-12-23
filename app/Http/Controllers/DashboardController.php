<?php

namespace App\Http\Controllers;


use DB;
use App\User;
use Illuminate\Http\Request;
//use App\Post;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $userid = auth()->user()->iUserId;
        $user = User::find($userid);
        $data['postdata'] = $user->post()->orderBy('iPostId','desc')->paginate(10);
        return view('dashboard',compact('data'));
    }
}
