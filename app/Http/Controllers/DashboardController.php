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
        DB::enableQueryLog();
        $userid = auth()->user()->iUserId;
        $user = User::find($userid);
        $data['postdata'] = $user->post()->orderBy('iPostId','desc')->paginate(10);
        //$data['postdata'] = $userX->post;
        //dd(DB::getQueryLog());
        // $data['postdata'] =  Post::where('iUserId',$userid)
        //                             ->orderBy('iPostId','desc')
        //                             ->paginate(6);
        //                             //->get();
        return view('dashboard',compact('data'));
    }
}
