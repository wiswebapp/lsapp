@extends('layouts.app')

@section('content')
    <h1>Create Post Data</h1>
    <hr>
    {!! Form::open(['action' => 'PostController@store','method'=>'post','enctype'=>'multipart/form-data']) !!}
    
    <div class="form-group">
        <select name="categories_id[]" multiple class="form-control">
        @foreach ($data['categories'] as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
        </select>
    </div>
    <div class="form-group">
        {{Form::label('Enter Title')}}
        {{Form::text('vTitle','',['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('Enter Description')}}
        {{Form::textarea('vBody','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Description'])}}
    </div>
    <div class="form-group">
        {{Form::file('vImage')}}
    </div>
    <hr>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    <a href="{{ URL::previous() }}" class="btn btn-danger">Back</a>

    {!! Form::close() !!}
@endsection