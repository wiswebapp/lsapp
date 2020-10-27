@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Login</div>

                <div class="panel-body">

                    <form method="POST" action="{{ route('admin.login') }}">
                        
                        {{ csrf_field() }}
                       
                        <div class="form-group{{ $errors->has('vEmail') ? ' has-error' : '' }}">
                            <label for="vEmail" class="col-md-4 control-label">E-Mail Address</label>
                            <input id="vEmail" type="email" class="form-control" name="vEmail" value="{{ old('vEmail') }}" required autofocus>
                            @if ($errors->has('vEmail'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('vEmail') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Login</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
