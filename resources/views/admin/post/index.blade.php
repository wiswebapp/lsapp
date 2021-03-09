@extends('admin.layouts.app')

@section('title', 'View Posts')
@section('content')
@include('layouts.error_msg')
<div class="container-fluid">
    <h1 class="mt-4">List Post</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Post</li>
    </ol>
</div>
<div class="container">
    <div class="row " id="dataTable_wrapper">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered">
                <thead>
                <tr>
                    <th>Added</th>
                    <th>Title</th>
                    <th>User</th>
                    <th>Views</th>
                    <th>Earnings</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($data['post'] as $item)
                <tr>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->views}}</td>
                    <td>{{$item->earning}}</td>
                </tr>
                @empty
                <tr>
                    <td>Sorry !</td>
                    <td>No Blogs Found</td>
                    <td>.</td>
                </tr>
                @endforelse
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection