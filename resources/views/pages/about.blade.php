@extends('layouts.app')


@section('content')
    
    <h1>{{$data['data']->vPageName}}</h1>
    <hr>
    <div>
        {!!$data['data']->tDescription!!}
    </div>

@endsection