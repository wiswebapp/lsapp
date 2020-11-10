<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
    public function cmspage()
    {
        $name = isset($_GET['name']) ? trim($_GET['name']) : "";
        $status = isset($_GET['status']) ? trim($_GET['status']) : "";

        $data['pageTitle'] = "CMS Pages";
        //$dataQ  =  Admin::orderBy('iAdminId','desc')->paginate(6);
        $dataQ  =  DB::table('pages');
        if (!empty($name))
            $dataQ->where('vPageName', 'like', '%'.$name.'%');
        if (!empty($status))
            $dataQ->where('eStatus', '=', $status);

        $data['pageData'] = $dataQ->orderBy('vPageName','asc')->paginate(10);
        return view('admin.cms_page',compact('data'));
    }
    public function create_cmspage(Request $request)
    {
        $data['action'] = "Add";
        $data['pageTitle'] = "Add CMS Page";
        if($request->method() == "POST"){
            $this->validate($request, [
                'vPageName'=> 'required',
                'vTitle'=> 'required',
                'tMetaKeyword'=> 'required',
                'tMetaDescription'=> 'required',
                'tDescription'=> 'required',
                'eStatus'=> 'required|in:Active,InActive',
            ]);
            // Create Post
            $Pages = new Pages;
            $request->request->remove('_token');
            $save = Pages::Create($request->all());
            if(!$save)
                return redirect('/admin/cmspages/')->with('error','Data Added Failed');
            else
                return redirect('/admin/cmspages/')->with('success','Data Added Successfully');
        }else{
            return view('admin.cms_page_action',compact('data'));
        }
    }
    public function edit_cmspage($id, Request $request){
        $data['action'] = "Edit";
        $data['pageTitle'] = "Edit Register User";

        if($request->method() == "POST"){
            $this->validate($request, [
                'vPageName'=> 'required',
                'vTitle'=> 'required',
                'tMetaKeyword'=> 'required',
                'tMetaDescription'=> 'required',
                'tDescription'=> 'required',
                'eStatus'=> 'required|in:Active,InActive',
            ]);
            $Pages = Pages::find($id);
            $request->request->remove('_token');
            $request->merge(['vSlug'=>str_slug($request->get('vSlug'),'-')]);
            $save = $Pages->fill($request->all())->save();
            return redirect('/admin/cmspage/')->with('success','Data Updated');
        }else{
            $data['pageData'] = Pages::find($id);
            return view('admin.cms_page_action',compact('data'));
        }
    }
    public function delete_user(Request $request)
    {
        $User = new User;
        $userId = $request->input('userId');
        $userId = User::find($userId);
        if ($userId != null)
            $userId->delete();
    }
}
