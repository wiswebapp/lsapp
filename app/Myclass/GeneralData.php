<?php

namespace App\Myclass;

use App\Blog;

class GeneralData{

    private $perPageData = 10;

    private $earningAmount = '0.05';
    
    public function getEarningAmount()
    {
        return $this->earningAmount;
    }

    public function perPageData()
    {
        return $this->perPageData;
    }

    public function addBlogView(int $blogId){
        $blog = Blog::find($blogId);
        if($blog){
            ($blog->views == null) ? $blog->views = 1 : $blog->increment('views',1);
            $blog->save();
            return $blog->views;
        }
    }

    public function addBlogEarning(int $blogId){
        $blog = Blog::find($blogId);
        if($blog){
            $blog->earning = $blog->earning + $this->earningAmount;
            $blog->save();
            return $blog->earning;
        }
    }
}