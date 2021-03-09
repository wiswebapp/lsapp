<?php

namespace App\Http\Controllers;

use Auth;
use App\Blog;
use App\Myclass\MyclassFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show','search']]);
    }

    public function index(Request $request)
    {
        $blogs = Blog::with(['user'])->latest();
        $data['maxViews'] = Blog::max('views') - 10;
        $data['avgViews'] = round(Blog::avg('views') - 10);
        $data['populurblog'] = Blog::with(['user'])
                                ->where('views','>',$data['avgViews'])
                                ->orderBy('views','desc')
                                ->limit(4)
                                ->get();
        $blogs->whereNotIn('id', $data['populurblog']->pluck('id')->toArray());
        $data['blog'] = $blogs->paginate(MyclassFacade::perPageData());
        return view('blog.index')->with('data',$data);
    }

    public function search(Request $request)
    {
        $data['blog'] = Blog::with(['user'])
                        ->where('title','LIKE','%'.$request->input('param').'%')
                        ->latest()
                        ->paginate(MyclassFacade::perPageData());
        $data['maxViews'] = Blog::max('views') - 10;
        $data['avgViews'] = round(Blog::avg('views') - 10);
        return view('blog.index')->with('data',$data);
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'title' => 'required|unique:blogs|max:255',
            'content' => 'required|min:20',
        ]);
        
        if ($request->hasFile('blog_image')) {
            $extension = $request->file('blog_image')->extension();
            $newFileName = "BLOG_".time().".".$extension;
            $uploadPath = '/public/blog/';
            if(!Storage::exists($uploadPath)){
                Storage::makeDirectory($uploadPath);
            }
            $request->file('blog_image')->storeAs($uploadPath,$newFileName);
            $input['blog_image'] = $newFileName;
        }else{
            $input['blog_image'] = "";
        }
        Blog::create( array_merge($input, ['user_id' => Auth::user()->id]) );
        return redirect(route('my.blogs'))->with('success','Blog Added Successfully');
    }

    public function show(Blog $blog)
    {
        if (!Auth::user() || Auth::user()->id != $blog->user_id) {
            $blog->views = MyclassFacade::addBlogView($blog->id);
            $blog->earning = MyclassFacade::addBlogEarning($blog->id);
        }
        return view('blog.show')->with('blog',$blog);
    }

    public function edit(Blog $blog)
    {
        if (Auth::user()->id !== $blog->user_id) {
            return redirect('/blog')->with('error','Unauthorized Access');
        }
        return view('blog.edit')->with('blog',$blog);
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:20',
        ]);
        
        if ($request->hasFile('blog_image')) {
            $extension = $request->file('blog_image')->extension();
            $newFileName = "BLOG_".time().".".$extension;
            $uploadPath = '/public/blog/';
            if(!Storage::exists($uploadPath)){
                Storage::makeDirectory($uploadPath);
            }
            $request->file('blog_image')->storeAs($uploadPath,$newFileName);
            $blog->blog_image = $newFileName;
        }
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->save();
        return redirect(route('my.blogs'))->with('success','Blog Updated Successfully');
    }

    public function destroy(Blog $blog)
    {
        if (Auth::user()->id !== $blog->user_id) {
            return redirect('/blog')->with('error','Unauthorized Access');
        }
        if(!empty($blog->blog_image)){
            $path = storage_path().'/app/public/blog/'.$blog->blog_image;
            if(File::exists($path)){
                unlink($path);
            }
        }
        $blog->delete();
        return redirect(route('my.blogs'))->with('error','Blog Has been Removed !');
    }
}