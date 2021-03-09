@extends('layouts.app')

@section('content')
<div class="container content-grids">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.error_msg')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>{{ __('My Profile') }}</h5>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['user.update',Auth::user()->id],'method'=>'PUT','class'=>'form-horizontal']) !!}
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Name</label>
                          <div class="col-lg-10">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name',Auth::user()->name)}}">
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                              <input type="text" name="email" class="form-control" placeholder="Email" value="{{old('email',Auth::user()->email)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                              <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                              <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>{{ __('Change Password') }}</h5>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['user.updatePassword'],'method'=>'POST','class'=>'form-horizontal']) !!}
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Password</label>
                          <div class="col-lg-10">
                            <input type="password" name="password" class="form-control" placeholder="Create Strong Password">
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
