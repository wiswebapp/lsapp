<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use App\Myclass\MyclassFacade;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{   
    public function index()
    {
        $blog = Blog::where('user_id',Auth::user()->id)->latest();
        $data['blog'] = $blog->paginate(MyclassFacade::perPageData());
        return view('home')->with('data',$data);
    }
}
