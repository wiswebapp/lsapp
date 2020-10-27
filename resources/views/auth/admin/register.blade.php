@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('vName') ? ' has-error' : '' }}">
                            <label for="vName" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="vName" type="text" class="form-control" name="vName" value="{{ old('vName') }}" required autofocus>

                                @if ($errors->has('vName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('vEmail') ? ' has-error' : '' }}">
                            <label for="vEmail" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="vEmail" type="email" class="form-control" name="vEmail" value="{{ old('vEmail') }}" required>

                                @if ($errors->has('vEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('vPassword') ? ' has-error' : '' }}">
                            <label for="vPassword" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="vPassword" type="password" class="form-control" name="vPassword" required>

                                @if ($errors->has('vPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vPassword_confirmation" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="vPassword_confirmation" type="password" class="form-control" name="vPassword_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
