<?php
    $post = $data['post'];
    // echo "<pre>";dd($data['post']->categories);exit;
    //dd($post->categories);
?>

@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <hr>
    {!! Form::open(['action' => ['PostController@update',$post['iPostId']],'method'=>'post','enctype'=>'multipart/form-data']) !!}

        {{Form::hidden('_method','PUT')}}
        
        <div class="form-group">
            <select name="categories_id[]" multiple class="form-control">
            @foreach ($data['categories'] as $category)
                <option value="{{ $category->id }}"
                    <?php foreach ($post->categories as $item) {
                        echo ($item->id == $category->id) ? "selected" : "";
                    } ?>
                >{{ $category->name }}</option>
            @endforeach
            </select>
        </div>
        
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

        {{Form::submit('Submit',['class'=>'btn btn-success'])}}
        <a href="{{ URL::previous() }}" class="btn btn-danger">Back</a>

    {!! Form::close() !!}
@endsection