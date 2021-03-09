<?php

namespace App\Http\Controllers\Api;

trait ApiFunctions
{
    private $myclass;

    public function checkUserValid($user, $id = '', $request = ''){
        $response = [];
        $statusCode = 200;

        if (!$user) {
            $statusCode = 404;
            $response['response'] =  'Whoops .! No users found';
        }
        if (!empty($id) && $request->user()->id != $id) {
            $statusCode = 401;
            $response['response'] =  'Whoops .! You are not authorized to view this';
        }
        
        return ['message'=>$response,'statusCode'=>$statusCode];
    }

    public function setResponse($data, $statusCode = 200)
    {
        return response($data, $statusCode)
                  ->withHeaders([
                      'Content-Type' => 'application/json',
                      'Accept'=> 'application/json',
                    ]);
    }

    public function getSampleBlogData($userId = '', $validContent = true){
        $blogData = [
            'title' => $validContent ? 'foo foo foo foo foo foo on '.time() : date('his'),
            'content' => $validContent ? 'some bar content some bar content some bar content some bar content' : 'small content',
        ];
        empty($userId) ?: $blogData['user_id'] = $userId;
        return $blogData;
    }

    public function getSampleUserData($DataArray = []){
        $sampleData =  [
            'name' => 'Test User',
            'email' => 'testuser'.time().rand(1,10000).'@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        return array_merge($sampleData, $DataArray);
    }
    
    public function getUser($userId = '')
    {
        if (empty($userId)) {
            return factory(\App\User::class)->create();
        }
        return \App\User::find($userId);
    }

    public function getAuthorizeHeader($token)
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$token->plainTextToken
        ];
    }
}