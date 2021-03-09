<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
    {
    public function index()
    {
        $data['totalUser'] = User::all()->count();
        $data['totalBlog'] = Blog::all()->count();
        $data['totalViews'] = Blog::all()->sum('views');
        $data['totalEarning'] = Blog::all()->sum('earning');
        return view('admin.dashboard',compact('data'));
    }
}
