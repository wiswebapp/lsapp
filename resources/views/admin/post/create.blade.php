@extends('admin.layouts.app')

@section('title', 'View Posts')
@section('content')
@include('layouts.error_msg')
<div class="container-fluid">
    <h1 class="mt-4">Add Post</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Post</li>
    </ol>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="">
                <div class="form-group">
                    <label>Post Title :</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label>Post Image :</label>
                    <input type="file" class="form-control" name="blog_image" required>
                </div>
                <div class="form-group">
                    <label>Post Content :</label>
                    <textarea class="form-control" name="content" id="" cols="30" rows="10" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
</div>
@endsection