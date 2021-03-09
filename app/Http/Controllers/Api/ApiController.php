<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Blog;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiFunctions;

class ApiController extends Controller
{
    use ApiFunctions;

    public function index()
    {
        $posts = Blog::all()->toArray();
        return array_reverse($posts);
        $data['blog'] = Blog::orderBy('id','desc')->paginate(5);
        $data['status'] = (count($data['blog']) > 0) ? true : false;
        
        return response($data, 200)
                  ->withHeaders([
                      'Content-Type', 'application/json',
                      'Accept', 'application/json',
                    ]);
    }

    public function store(Request $request)
    {
        $rules = ([
            'title' => 'required|unique:blogs|max:255',
            'content' => 'required|min:20',
            'user_id' => 'required',
        ]);
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            $response['response'] =  Blog::create($request->all());
            $response['success'] = true;
        }
        return $response;
    }

    public function show($id)
    {
        if (!Auth::user() || Auth::user()->id != $id) {
            $this->addBlogView($id);
            $this->addBlogEarning($id);
        }
        $blog = Blog::find($id);
        return $blog;
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $rules = ([
            'title' => 'required|max:255',
            'content' => 'required|min:20',
            'user_id' => 'required',
        ]);
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            $blog->update($request->all());
            $response = $blog;
        }
        return $response;
    }

    public function destroy($id)
    {
        $Blog = Blog::findOrFail($id);
        $Blog->delete();
        return 204;
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => [' These Credentials Do not match With Our Records']
            ], 404);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return $response;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response = [
            'message' => 'Logout Success',
        ];
        return $response;
    }
}