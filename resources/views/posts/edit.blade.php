<?php
    $post = $data['post'];    
?>

@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <hr>
    {!! Form::open(['action' => ['PostController@update',$post['iPostId']],'method'=>'post','enctype'=>'multipart/form-data']) !!}

        {{Form::hidden('_method','PUT')}}

        <div class="form-group">
            {{Form::label('Enter Title')}}
            {{Form::text('vTitle',$post['vTitle'],['class'=>'form-control','placeholder'=>'Title'])}}
        </div>
        
        <div class="form-group">
            {{Form::label('Enter Description')}}
            {{Form::textarea('vBody',$post['vBody'],['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Description'])}}
        </div>

        <div class="form-group">
            {{Form::file('vImage')}}
        </div>

        {{Form::submit('Submit',['class'=>'btn btn-sm btn-primary'])}}

    {!! Form::close() !!}
@endsection