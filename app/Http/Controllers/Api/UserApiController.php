<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Events\UserRegister;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\ApiFunctions;

class UserApiController extends Controller
{
    use ApiFunctions;

    public function index(Request $request)
    {
        $response['success'] = true;
        $response['response'] = User::find($request->user()->id);;
        return $this->setResponse($response);
    }

    public function store(StoreUser $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $response['success'] = true;
        $response['response'] =  $user;
        
        event( new UserRegister($user) );

        return $this->setResponse($response,201);
    }

    public function show($id,Request $request)
    {
        $response['success'] = false;
        $statusCode = 200;

        $user = User::find($id);
        $userCheck = $this->checkUserValid($user,$id,$request);
        if (empty($userCheck['message'])) {
            $response['success'] = true;
            $response['response'] =  $user;
        } else {
            $response = $userCheck['message'];
        }
        return $this->setResponse($response,$statusCode);
    }
    
    public function update(StoreUser $request, $id)
    {
        $response['success'] = false;
        $statusCode = 200;
        
        $user = User::find($id);
        $userCheck = $this->checkUserValid($user,$id,$request);
        $statusCode = $userCheck['statusCode'];
        if (empty($userCheck['message'])) {
            $user->update($request->all());
            $response['success'] = true;
            $response['response'] = $user;
        } else {
            $response = $userCheck['message'];
        }
        return $this->setResponse($response,$statusCode);
    }

    public function destroy($id,Request $request)
    {
        $response['success'] = false;
        $statusCode = 200;
        
        $user = User::find($id);
        $userCheck = $this->checkUserValid($user,$id,$request);
        if (empty($userCheck['message'])) {
            $user->delete();
            $statusCode = 204;
            $response['success'] = true;
        } else {
            $response = $userCheck['message'];
        }
        return $this->setResponse($response,$statusCode);
    }
}