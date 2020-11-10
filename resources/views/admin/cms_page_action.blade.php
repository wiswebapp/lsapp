<?php
  $action = $data['action'];
  $actionUrl = "admin\MasterController@create_cmspage";

  if($action == "Edit"){
    $pageData = $data['pageData'];
    $actionUrl = "admin\MasterController@edit_cmspage";
  }
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
           @include('include.messages')
            <div class="card">
              {{-- Form Event start Here --}} 
            {!! Form::open(['action' => [$actionUrl,@$pageData->iPageId],'method'=>'post','enctype'=>'multipart/form-data']) !!}
              <div class="card-body">
                       
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Page Name</label>
                            <input type="text" name="vPageName" value="{{old('vPageName',$pageData->vPageName)}}" class="form-control {{ $errors->has('vPageName') ? 'is-invalid' : '' }}" placeholder="Enter Page Name">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Page Title</label>
                            <input type="text" name="vTitle" value="{{old('vTitle',$pageData->vTitle)}}" class="form-control" placeholder="Enter Page Title">
                        </div>
                    </div>
                    {{-- <div class="col-md-8">
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="vSlug" value="{{old('vSlug',$pageData->vSlug)}}" class="form-control" placeholder="Enter Slug">
                        </div>
                    </div> --}}
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Meta Keyword</label>
                            <input type="text" name="tMetaKeyword" value="{{old('tMetaKeyword',$pageData->tMetaKeyword)}}" class="form-control" placeholder="Enter Meta Keyword">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Meta Description</label>
                            
                            <textarea name="tMetaDescription" id="" class="form-control">{{old('tMetaDescription',$pageData->tMetaDescription)}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="tDescription" id="" class="form-control summerText">{{old('tDescription',$pageData->tDescription)}}</textarea>
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
                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection