<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\Api\ApiFunctions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{
    use ApiFunctions,RefreshDatabase;

    public function test_not_logged_user_can_not_add_post()
    {
        $response = $this->get('/blog/create')->assertRedirect('/login');
    }

    public function test_login_user_can_add_post()
    {
        $user = $this->getUser();
        $this->actingAs($user);

        $response = $this->get('/blog/create')->assertOk();
    }

    public function test_only_authorized_user_can_edit_post()
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $blogData = ['user_id'=>$user->id];
        $blog = factory(\App\Blog::class)->create($blogData);

        $response = $this->get('/blog/'.$blog->id.'/edit')->assertOk();
    }

    public function test_not_authorized_user_can_not_edit_post()
    {
        $blog = factory(\App\Blog::class)->create();
        
        $response = $this->get('/blog/'.$blog->id.'/edit');

        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }
    
    public function test_it_validates_title_of_blog()
    {
        $user = $this->getUser();
        $this->actingAs($user);
        
        $response = $this->post('/blog', ['title' => '']);
        
        $response->assertStatus(302);
    }

    public function test_it_validates_content_of_blog()
    {
        $user = $this->getUser();
        $this->actingAs($user);

        $response = $this->post('/blog', ['content' => '']);

        $response->assertStatus(302);
    }

    public function test_it_store_validate_blog()
    {
        $user = $this->getUser();
        $this->actingAs($user);
        $data = $this->getSampleBlogData($user->id);
        
        $response = $this->post('/blog', $data);
        
        $response->assertRedirect('/home');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('blogs', ['title' => $data['title']]);
    }

    /**
     * -----------------------------------------
     * API TESTING CODE STARTS FROM HERE
     * -----------------------------------------
     * 
     */
     public function test_it_validate_correct_user_and_logged_them_in()
     {
        $user = $this->getUser();
        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertJsonCount(2)
        ->assertOk()
        ->assertJsonStructure([
            "user" => [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ],
            "token",
        ]);
     }

     public function test_it_validate_wrong_user_and_show_error()
     {
        $data = [
            'email' => 'randomemail@example.com',
            'password' => 'blablabla',
        ];

        $response = $this->postJson('/api/login', $data);
        
        $response->assertJsonCount(1)
        ->assertStatus(404)
        ->assertJson([
            "message" => [
                " These Credentials Do not match With Our Records"
            ]
        ]);
     }
     
     public function test_it_check_login_user_can_see_blog()
     {
        $user = $this->getUser();
        $token = $user->createToken('my-app-token');
        $headers = $this->getAuthorizeHeader($token);

        $response = $this->getJson('/api/blog', $headers);

        $response->assertOk();
        $response->assertJsonStructure([
            'blog',
            'status'
        ]);
     }

     public function test_it_check_user_can_not_see_blog_if_not_login()
     {
        $response = $this->getJson('/api/blog');
        $response->assertStatus(401);
     }

     public function test_it_validate_blog_add_by_user()
     {
        $user = $this->getUser();
        $token = $user->createToken('my-app-token');
        $headers = $this->getAuthorizeHeader($token);
        $data = $this->getSampleBlogData($user->id);

        $response = $this->postJson('/api/blog',$data,$headers);
        
        $response->assertStatus(200);
        $this->assertDatabaseHas('blogs', ['title' => $data['title']]);
     }
    
     public function test_it_check_invalid_blog_not_add_by_user()
     {
        $user = $this->getUser();
        $token = $user->createToken('my-app-token');
        $headers = $this->getAuthorizeHeader($token);
        $data = $this->getSampleBlogData($user->id,false);
        
        $response = $this->postJson('/api/blog',$data,$headers);
        
        $response->assertOk();
        $this->assertDatabaseMissing('blogs', ['title' => $data['title']]);
     }

     public function test_it_check_valid_blog_update()
     {
        $user = $this->getUser();
        $blog = factory(\App\Blog::class)->create(['user_id'=>$user->id]);
        $token = $user->createToken('my-app-token');
        $header = $this->getAuthorizeHeader($token);
        $newBlogData = [
            'user_id' => $user->id,
            'title' => 'foo foo foo foo foo foo on '.time(),
            'content' => 'some bar content some bar some bar content',
            '_method' => 'PUT'
        ];
        
        $url = '/api/blog/'.$blog->id;
        $response = $this->postJson($url,$newBlogData,$header);
        
        $response->assertOk();
        $this->assertDatabaseMissing('blogs', ['title' => $blog->title]);
     }

     public function test_it_check_invalid_blog_not_update()
     {
        $user = $this->getUser();
        $blog = factory(\App\Blog::class)->create(['user_id'=>$user->id]);
        $token = $user->createToken('my-app-token');
        $header = $this->getAuthorizeHeader($token);
        $data = [
            'user_id' => $user->id,
            'title' => 'foo foo foo',
            'content' => 'bar content',
            '_method' => 'PUT'
        ];

        $url = '/api/blog/'.$blog->id;
        $response = $this->postJson($url,$data,$header);
        
        $response->assertOk()
        ->assertJsonStructure([
            'response' => [
                'content'
            ],
            'success'
        ]);
     }
}