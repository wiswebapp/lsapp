@extends('layouts.app')

@section('content')
    <h1>Create Post Data</h1>
    <hr>
    {!! Form::open(['action' => 'PostController@store','method'=>'post']) !!}
    
    <div class="form-group">
        {{Form::label('Enter Title')}}
        {{Form::text('vTitle','',['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('Enter Description')}}
        {{Form::textarea('vBody','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Description'])}}
    </div>
    {{Form::submit('Submit',['class'=>'btn btn-sm btn-primary'])}}

    {!! Form::close() !!}
@endsection