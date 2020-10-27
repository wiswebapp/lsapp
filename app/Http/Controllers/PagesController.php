<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to Laravel v5.X";
        //return view('pages.index',compact('title'));
        return view('pages.index')->with('title',$title);
    }

    public function about(){
        $title = "Welcome to Laravel About Us";
        return view('pages.about',compact('title'));
    }

    public function services(){        
        $data = array(
            'title' => 'Welcome to Laravel Services',
            'services' => ['web design','programming','seo'],
        );
        //return view('pages.services',compact('data'));
        return view('pages.services')->with($data);
        //return view('pages.services');
    }
}
