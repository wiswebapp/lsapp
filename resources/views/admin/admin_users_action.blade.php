<?php
  $action = $data['action'];
  $actionUrl = "admin\UsersController@create_admin";

  if($action == "Edit"){
    $pageData = $data['pageData'];
    $actionUrl = "admin\UsersController@edit_admin";
  }
?>

@extends('layouts.app_admin')

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
              @include('include.messages')
            <div class="card">
              {{-- Form Event start Here --}} 
            {!! Form::open(['action' => [$actionUrl,@$pageData->iAdminId],'method'=>'post','enctype'=>'multipart/form-data']) !!}
              <div class="card-body">
                       
                  <div class="col-md-8">
                      <div class="form-group">
                          <label>Full Name</label>
                          <input type="text" name="vName" value="{{old('vName',$pageData->vName)}}" class="form-control" placeholder="Enter Name">
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="form-group">
                          <label>Email address</label>
                          <input type="email" name="vEmail" value="{{old('vEmail',$pageData->vEmail)}}" class="form-control" placeholder="Enter email">
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="form-group">
                          <label>Mobile Number</label>
                          <input type="text" name="vMobile" value="{{old('vMobile',$pageData->vMobile)}}" class="form-control" placeholder="Enter Mobile">
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="vPassword" class="form-control" placeholder="Enter Password">
                      </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Status</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="eStatus" value='Active' <?=($pageData->eStatus == 'Active') ? "checked" : ""?>>
                        <label class="form-check-label">Active</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="radio" name="eStatus" value='InActive' <?=($pageData->eStatus == 'InActive') ? "checked" : ""?>>
                        <label class="form-check-label">InActive</label>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{$data['action']}} Data</button>
                <button type="reset" class="btn btn-default">Reset</button>
                <a href="{{route('admin.adminuser')}}" class="btn btn-default">Go Back</a>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
