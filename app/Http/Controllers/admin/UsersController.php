<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return redirect()->to('/admin');
    }

    /*--------------------------FOR ADMIN USERS--------------------------*/
    public function admin()
    {
        $name = isset($_GET['name']) ? trim($_GET['name']) : "";
        $email = isset($_GET['email']) ? trim($_GET['email']) : "";
        $status = isset($_GET['status']) ? trim($_GET['status']) : "";

        $data['pageTitle'] = "Admin Users";
        //$dataQ  =  Admin::orderBy('iAdminId','desc')->paginate(6);
        $dataQ  =  DB::table('admin')->where('deleted_at', '=', NULL);
        if (!empty($name))
            $dataQ->where('vName', 'like', '%'.$name.'%');
        if (!empty($email))
            $dataQ->where('vEmail', 'like', '%'.$email.'%');
        if (!empty($status))
            $dataQ->where('eStatus', '=', $status);

        $data['pageData'] = $dataQ->orderBy('iAdminId','desc')->paginate(10);
        return view('admin.admin_users',compact('data'));
    }
    public function create_admin(Request $request)
    {
        $data['action'] = "Add";
        $data['pageTitle'] = "Create Admin Users";

        if($request->method() == "POST"){
            $this->validate($request, [
                'vName'=> 'required',
                'vEmail'=> 'required|email',
                'vMobile'=> 'required|numeric',
                'eStatus'=> 'required|in:Active,InActive',
                'vPassword'=> 'required|min:6|max:16',
            ]);
            // Create Post
            $Admin = new Admin;
            $Admin->vName = $request->input('vName');
            $Admin->vEmail = $request->input('vEmail');
            $Admin->vMobile = $request->input('vMobile');
            $Admin->eStatus = $request->input('eStatus');
            $Admin->vPassword = Hash::make($request->input('vPassword'));
            $Admin->save();
            return redirect('/admin/adminuser/')->with('success','Data Added Successfully');
        }else{
            return view('admin.admin_users_action',compact('data'));
        }
    }
    public function edit_admin($id, Request $request){
        $data['action'] = "Edit";
        $data['pageTitle'] = "Edit Admin Users";

        if($request->method() == "POST"){
            $this->validate($request, [
                'vName'=> 'required',
                'vEmail'=> 'required|email',
                'eStatus'=> 'required|in:Active,InActive',
                'vMobile'=> 'required|numeric',
                //'vPassword'=> 'min:6|max:16',
            ]);
            $Admin = Admin::find($id);
            $Admin->vName = $request->input('vName');
            $Admin->vEmail = $request->input('vEmail');
            $Admin->vMobile = $request->input('vMobile');
            $Admin->eStatus = $request->input('eStatus');
            if(!empty($request->input('vPassword'))){
                $Admin->vPassword = Hash::make($request->input('vPassword'));
            }
            $save = $Admin->save();
            
            return redirect('/admin/adminuser/')->with('success','Data Updated');
        }else{
            $data['pageData'] = Admin::find($id);
            return view('admin.admin_users_action',compact('data'));
        }
    }
    public function delete_admin(Request $request)
    {
        $Admin = new Admin;
        $userId = $request->input('dataId');
        $Admin = Admin::find($userId);
        if ($Admin != null)
            $Admin->delete();
    }

    /*--------------------------FOR REGISTER USERS--------------------------*/
    public function user()
    {
        $name = isset($_GET['name']) ? trim($_GET['name']) : "";
        $email = isset($_GET['email']) ? trim($_GET['email']) : "";
        $status = isset($_GET['status']) ? trim($_GET['status']) : "";

        $data['pageTitle'] = "Register Users";
        //$dataQ  =  Admin::orderBy('iAdminId','desc')->paginate(6);
        $dataQ  =  DB::table('users')->where('deleted_at', '=', NULL);
        if (!empty($name))
            $dataQ->where('vName', 'like', '%'.$name.'%');
        if (!empty($email))
            $dataQ->where('vEmail', 'like', '%'.$email.'%');
        if (!empty($status))
            $dataQ->where('eStatus', '=', $status);

        $data['pageData'] = $dataQ->orderBy('iUserId','desc')->paginate(10);
        return view('admin.register_user',compact('data'));
    }
    public function create_user(Request $request)
    {
        $data['action'] = "Add";
        $data['pageTitle'] = "Create Register Users";

        if($request->method() == "POST"){
            $this->validate($request, [
                'vName'=> 'required',
                'vEmail'=> 'required|email',
                'vMobile'=> 'required|numeric',
                'eStatus'=> 'required|in:Active,InActive',
                'vPassword'=> 'required|min:6|max:16',
            ]);
            // Create Post
            $User = new User;
            $User->vName = $request->input('vName');
            $User->vEmail = $request->input('vEmail');
            $User->vMobile = $request->input('vMobile');
            $User->eStatus = $request->input('eStatus');
            $User->vPassword = Hash::make($request->input('vPassword'));
            $User->save();
            return redirect('/admin/user/')->with('success','Data Added Successfully');
        }else{
            return view('admin.register_user_action',compact('data'));
        }
    }
    public function edit_user($id, Request $request){
        $data['action'] = "Edit";
        $data['pageTitle'] = "Edit Register User";

        if($request->method() == "POST"){
            $this->validate($request, [
                'vName'=> 'required',
                'vEmail'=> 'required|email',
                'eStatus'=> 'required|in:Active,InActive',
                'vMobile'=> 'required|numeric',
                //'vPassword'=> 'min:6|max:16',
            ]);
            $User = User::find($id);
            $User->vName = $request->input('vName');
            $User->vEmail = $request->input('vEmail');
            $User->vMobile = $request->input('vMobile');
            $User->eStatus = $request->input('eStatus');
            if(!empty($request->input('vPassword'))){
                $User->vPassword = Hash::make($request->input('vPassword'));
            }
            $save = $User->save();
            
            return redirect('/admin/user/')->with('success','Data Updated');
        }else{
            $data['pageData'] = User::find($id);
            return view('admin.register_user_action',compact('data'));
        }
    }
    public function delete_user(Request $request)
    {
        $User = new User;
        $userId = $request->input('dataId');
        $userId = User::find($userId);
        if ($userId != null)
            $userId->delete();
    }
}
