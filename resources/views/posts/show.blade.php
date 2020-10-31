<?php
    //echo "<pre>";print_r($data);exit;
    $post = $data['post'];
?>
@extends('layouts.app')

@section('content')
    <a href="/post" class="btn btn-sm btn-danger">Go Back</a>
    <hr>
    <img src="/storage/postImage/{{$post['vImage']}}" alt="{{$post['vTitle']}}" style="width: 100%">
    <h1>{{$post['vTitle']}}</h1>    
    <p><small>{!!$post['vBody']!!}</small></p>
    <hr>
    <small>Created On {{date('d-m-Y h:i:s A',strtotime($post['created_at']))}}</small>

    <hr>
    
    @if(!Auth::guest())    
        @if(Auth::user()->iUserId == $post['iUserId'])
            <a href="/post/{{$post['iPostId']}}/edit" class="btn btn-default">Edit</a>
            {!! Form::open(['action' => ['PostController@destroy', $post['iPostId']],'method'=>'post','class'=>'pull-right']) !!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection