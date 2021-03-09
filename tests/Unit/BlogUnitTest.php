<?php

namespace Tests\Unit;

use App\Blog;
use App\Http\Controllers\Api\ApiFunctions;
use App\Http\Controllers\BlogController;
use Tests\TestCase;

class BlogUnitTest extends TestCase
{
    use ApiFunctions;
    
    function test_check_earning_add_properly(){        
        $blog = factory(\App\Blog::class)->create();
        $blogController = new BlogController();
        $blogController->myclass->addBlogView($blog->id);
        $actual = $blogController->myclass->addBlogEarning($blog->id);
        $expected = $blog->earning + $blogController->myclass->getEarningAmount();
        
        $this->assertEquals($expected,$actual);
    }

    function test_check_view_add_properly(){
        $blog = factory(\App\Blog::class)->create();
        $blogController = new BlogController();
        $actual = $blogController->myclass->addBlogView($blog->id);
        $blogController->myclass->addBlogEarning($blog->id);
        $expected = $blog->views + 1;
        $this->assertEquals($expected,$actual);
    }
}