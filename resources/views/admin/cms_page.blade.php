<?php
    $routeUrl = route('admin.cmspage');
    $routeCreateUrl = route('admin.createcmspage');
    $routeEditUrl = url('/admin/cmspage/edit/');
    $routeDeleteurl = url('admin/cmspage/delete/');
?>
@extends('admin.layouts.app_admin')

@section('title',$data['pageTitle'])

@section('content_admin')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$data['pageTitle']}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                <li class="breadcrumb-item active">{{$data['pageTitle']}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              @include('include.messages')
              <div class="card-header">
                <!-- Filter Area -->
                <form method="GET" action="">                
                    <div class="row">
                        <div class="col-1"><p style="margin-top: 7px;">Filter Data</p></div>
                        <div class="col-2">
                        <input type="text" name="name" class="form-control" placeholder="Filter by Name" value="{{isset($_GET['name']) ? $_GET['name'] : ""}}">
                        </div>
                        <div class="col-2">
                            <select name="status" class="form-control">
                                <option value="">Filter By Status</option>
                                <option <?=($_GET['status'] == "Active") ? "selected" : ""?> value="Active">Active</option>
                                <option <?=($_GET['status'] == "InActive") ? "selected" : ""?> value="InActive">InActive</option>
                            </select>
                        </div>
                        <div class="col-2">
                          <button type="submit" class="btn btn-default">Filter</button>
                          <a href="{{$routeUrl}}" class="btn btn-default">Reset</a>
                        </div>
                        <div class="col-5">
                        {{-- <a href="{{$routeCreateUrl}}" class="btn btn-default" style="float: right">Create Page</a> --}}
                      </div>
                    </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered text-nowrap">
                  <thead>
                    <tr>
                      <th><input type="checkbox"></th>
                      <th>Page Name</th>
                      <th>Page Title</th>
                      <th>Page Slug</th>
                      <th>Status</th>
                      <th style="width: 15%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($data['pageData']) > 0)
                        @foreach($data['pageData'] as $pageData)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><?=$pageData->vPageName?></td>
                                <td><?=$pageData->vTitle?></td>
                                <td><?=$pageData->vSlug?></td>
                                <td><?=$pageData->eStatus?></td>
                                <td>
                                  <a href="{{$routeEditUrl.'/'.$pageData->iPageId}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                  {{-- <span onclick="removeUser('{{$routeDeleteurl}}',{{$pageData->iPageId}})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</span> --}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr class="text-danger">
                      <td colspan="10">Sorry No Data Found</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
              <div class="pull-right">
                {{$data['pageData']->links('pagination::bootstrap-4')}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>   
@endsection