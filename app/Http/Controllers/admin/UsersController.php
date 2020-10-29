<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return redirect()->to('/admin');
    }

    public function admin()
    {
        $data['pageTitle'] = "Admin Users";
        $data['pageData'] =  Admin::orderBy('iAdminId','desc')->paginate(6);
        return view('admin.admin_users',compact('data'));
    }
}
