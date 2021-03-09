<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\Api\ApiFunctions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use ApiFunctions,RefreshDatabase;

    public function test_it_create_user_with_valid_data()
    {
        $data = $this->getSampleUserData();
        $response = $this->postJson('/register', $data);
        $response->assertStatus(201);
    }

    public function test_it_validate_user_if_wrong_data()
    {
        $data = $this->getSampleUserData([
                'email'=>'wrongemail'
            ]);

        $response = $this->postJson('/register',$data);

        $response->assertStatus(422);
    }

    public function test_it_check_profile_in_user_call()
    {
        $user = $this->getUser();
        $token = $user->createToken('my-app-token');
        $headers = $this->getAuthorizeHeader($token);
        
        $response = $this->getJson('/api/user', $headers);

        $response->assertOk();
        $response->assertJson([
            "success" => true,
            "response" => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function test_it_check_valid_user_can_update_data()
    {
        $user = $this->getUser();
        $token = $user->createToken('my-app-token');
        $headers = $this->getAuthorizeHeader($token);
        $data = $this->getSampleUserData([
            '_method' => 'PUT',
        ]);
        
        $url = '/api/user/'.$user-> id;
        $response = $this->postJson($url, $data, $headers);

        $response->assertOk();
        $response->assertJson([
            "success" => true,
            "response" => [
                'id' => $user->id,
                'name' => $data['name'],
                'email' => $data['email'],
            ],
        ]);
    }

    public function test_it_check_non_exist_user_can_not_update_data(){
        $user = $this->getUser();
        $token = $user->createToken('my-app-token');
        $headers = $this->getAuthorizeHeader($token);
        $data = $this->getSampleUserData([
            '_method' => 'PUT',
        ]);

        $response = $this->postJson('/api/user/xyz/', $data, $headers);

        $response->assertStatus(404);
        $response->assertJson([
            'response' => 'Whoops .! No users found',
        ]);
    }

    public function test_it_check_unauthorized_user_can_not_update_data(){
        $Fakeuser = $this->getUser();
        $user = $this->getUser();
        $token = $user->createToken('my-app-token');
        $headers = $this->getAuthorizeHeader($token);
        $data = $this->getSampleUserData([
            '_method' => 'PUT',
        ]);

        $response = $this->postJson('/api/user/'.$Fakeuser->id.'/' ,$data ,$headers);

        $response->assertStatus(401);
    }
}