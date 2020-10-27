
@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Welcome Admin</h3>
                    <h3>Name : {{Auth::user()->vName}}</h3>
                    <h3>Email : {{Auth::user()->vEmail}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
