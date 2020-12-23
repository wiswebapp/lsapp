@extends('layouts.app')


@section('content')
    
    <h1>{{isset($data['data']->vPageName) ? $data['data']->vPageName : "About Us"}}</h1>
    <hr>
    <div>
        {!!isset($data['data']->tDescription) ? $data['data']->tDescription : "Coming Soon"!!}
    </div>

@endsection