<?php

namespace App\Http\Controllers;

use DB;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //DB::connection()->enableQueryLog();
        $this->middleware('auth',['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data['post'] =  Post::all();
        $data['post'] =  Post::orderBy('created_at','desc')->paginate(6);
        // $data['post'] =  DB::table('posts')
        //                         ->join('users','users.iUserId','=','posts.iUserId')
        //                         ->paginate(6);
                                //->get();
        //$data['post'] = json_decode(json_encode($data['post']),TRUE);
        //echo "<pre>";print_r($data);exit;
        //$data['post'] =  Post::where('vTitle','Post Two')->get();
        //$data['post'] = Db::select('SELECT * FROM posts');
        /*
            TO Enable Query Log Also check constructer
            $queries = DB::getQueryLog();
            $last_query = end($queries);
            echo "<pre>";print_r($queries);exit;
        */        
        return view('posts.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'vTitle'=> 'required',
            'vBody'=> 'required',
            'vImage'=> 'image|nullable|max:1999',
        ]);

        //Handle File Upload
        if($request->hasFile('vImage')){
            //Get Filename Extension
            $fileExt = $request->file('vImage')->getClientOriginalName();
            //Get Just filename
            $fileName = pathinfo($fileExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('vImage')->getClientOriginalExtension();
            //Filename to store
            $fileNametoStore = $fileName."_".time().".".$extension;
            //Upload Image
            $path = $request->file('vImage')->storeAs('public/postImage',$fileNametoStore);
        }else{
            $fileNametoStore = "noimage.jpg";
        }
        
        // Create Post
        $post = new post;
        $post->vTitle = $request->input('vTitle');
        $post->vBody = $request->input('vBody');
        $post->iUserId = auth()->user()->iUserId;
        $post->vImage = $fileNametoStore;
        $post->save();

        return redirect('/dashboard')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['post'] = Post::find($id);        
        return view('posts.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['post'] = Post::find($id);
        //Check for correct user
        if(auth()->user()->iUserId !== $data['post']['iUserId']){
            return redirect('/post')->with('error','Unauthorized Page');
        }
        return view('posts.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vTitle'=> 'required',
            'vBody'=> 'required',
        ]);
        
        //Handle File Upload
        if($request->hasFile('vImage')){
            //Get Filename Extension
            $fileExt = $request->file('vImage')->getClientOriginalName();
            //Get Just filename
            $fileName = pathinfo($fileExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('vImage')->getClientOriginalExtension();
            //Filename to store
            $fileNametoStore = $fileName."_".time().".".$extension;
            //Upload Image
            $path = $request->file('vImage')->storeAs('public/postImage',$fileNametoStore);
        }

        // Create Post
        $post = Post::find($id);
        $post->vTitle = $request->input('vTitle');
        $post->vBody = $request->input('vBody');
        if($request->hasFile('vImage')){
            $post->vImage = $fileNametoStore;
        }
        $save = $post->save();
        
        return redirect('/post/'.$id)->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        //Check for correct user
        if(auth()->user()->iUserId !== $post->iUserId){
            return redirect('/post')->with('error','Unauthorized Page');
        }
        //Remov Image
        if($post->vImage != "" && !empty($post->vImage)){
            Storage::delete('public/postImage/'.$post->vImage);
        }
        $post->delete();
        return redirect('/post/')->with('success','Post Removed');
    }
}
