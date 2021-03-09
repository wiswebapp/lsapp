@extends('layouts.app')

@section('title',$blog->title)

@section('content')

<div class="content-grids">
    @include('layouts.error_msg')
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="text-success">{{ $blog->title }}</h3>
      </div>
      <div class="panel-body">
            <div class="col-md-4">
                <img class="img-responsive" style="width:100%" src="{{ empty(!$blog->blog_image) ? asset('storage/blog/'.$blog->blog_image) : asset('images/noblog.png')}}" alt="{{$blog->blog_slug}} Image Not found"/>
            </div>
            <div class="col-md-8">
                <h3 class="panel-title">{{ $blog->title }}</h3><br>
                <table class="table table-bordered">
                    <tr><th>Created On</th><td>{{date('d M Y',strtotime($blog->created_at))}}</td></tr>
                    <tr><th>Written By</th><td>{{$blog->user->name}}</td></tr>
                    <tr><th>Views</th><td>{{$blog->views}}</td></tr>
                    <tr><th>Earning</th><td>$ {{number_format((float)$blog->earning, 2 ,'.', '')}}</td></tr>
                </table>
            </div>
            <div class="clearfix"></div>
            <br>
            <p class="text-danger">Description</p>
            <hr>
            {!!$blog->content!!}
      </div>
      <div class="panel-footer">
        <p><small><i>All Rights® & content℗ are reserved™ & copyright©</i></small></p>
      </div>
    </div>
</div>
@endsection