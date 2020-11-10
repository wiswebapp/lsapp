@extends('admin.layouts.app_admin')

@section('title','Admin Login')

@section('content_admin')
<div class="container">
    <div class="login-box">
        <div class="login-logo">
          <a><b>Admin</b>LTE</a>
        </div>
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            
            @include('include.messages')

            <form method="POST" action="{{ route('admin.login') }}">

                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('vEmail') ? ' has-error' : '' }}">
                    <label>E-Mail Address</label>
                    <input id="vEmail" type="email" class="form-control" name="vEmail" value="{{ old('vEmail') }}" required autofocus>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Login</button>
                </div>
            </form> 
          </div>
        </div>
      </div>
</div>
@endsection
