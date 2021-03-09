@extends('layouts.app')

@section('content')

    @include('layouts.error_msg')

    {!! Form::open(['route' => ['blog.update',$blog->id],'method' => 'put','enctype'=>'multipart/form-data']) !!}
    
    <div class="form-group">
      <label class="col-lg-2 control-label">Blog Title</label>
      <div class="col-lg-10">
        <input type="text" name="title" class="form-control" placeholder="Enter Blog Title" value="{{ old('title',$blog->title) }}">
      </div>
    </div>
    <br><br>
    <div class="form-group">
        <label class="col-lg-2 control-label">Blog Image <small>(Optional)</small></label>
        <div class="col-lg-10">
          <input type="file" name="blog_image" class="form-control" placeholder="Enter Blog Title" value="{{ old('title') }}">
          @if (!empty($blog->blog_image))
            <img class="img-thumbnail" style="max-width:200px;max-height:200px;" src="{{asset('storage/blog/'.$blog->blog_image)}}" alt="blog image">
            <br><br>
          @endif
        </div>
      </div>
    <br><br>
    <div class="form-group">
      <label class="col-lg-2 control-label">Blog Description</label>
      <div class="col-lg-10">
        <textarea id="nextGenEditor" class="form-control" name="content">{{ old('content',$blog->content) }}</textarea>
      </div>
    </div>

    <br><br>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>  
    {!! Form::close() !!}
@endsection