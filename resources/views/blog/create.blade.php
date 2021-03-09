@extends('layouts.app')

@section('content')

<div class="content-grids">
    @include('layouts.error_msg')

    {!! Form::open(['route' => 'blog.store','enctype'=>'multipart/form-data']) !!}
    
    <div class="form-group">
      <label class="col-lg-2 control-label">Blog Title</label>
      <div class="col-lg-10">
        <input type="text" name="title" class="form-control" placeholder="Enter Blog Title" value="{{ old('title') }}">
      </div>
    </div>
    <br><br>
    <div class="form-group">
      <label class="col-lg-2 control-label">Blog Image <small>(Optional)</small></label>
      <div class="col-lg-10">
        <input type="file" name="blog_image" class="form-control" placeholder="Enter Blog Title" value="{{ old('title') }}">
      </div>
    </div>
    <br><br>
    <div class="form-group">
      <label class="col-lg-2 control-label">Blog Description</label>
      <div class="col-lg-10">
        <textarea id="nextGenEditor" class="form-control" name="content" cols="30" rows="10" placeholder="Enter Blog Description">{{ old('content') }}</textarea>
      </div>
    </div>
    <br><br>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
@endsection