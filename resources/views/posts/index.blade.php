@extends('layouts.app')

@section('content')
    <h1>Post Data</h1>
    @if (count($data['post']) > 0)
        @foreach ($data['post'] as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-3">
                    <img src="/storage/postImage/{{$post['vImage']}}" alt="{{$post['vTitle']}}" style="width: 100%">
                    </div>
                    <div class="col-md-9">
                        <h3><a href="/post/{{$post['iPostId']}}">{{$post['vTitle']}}</a></h3>
                <small>Written on : {{$post['created_at']}}</small>
                <small>Written by : {{$post['iUserId']}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$data['post']->links()}}
    @else
        <p>No Post Available to see</p>
    @endif
@endsection