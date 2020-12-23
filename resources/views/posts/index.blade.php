@extends('layouts.app')

@section('content')
    <h1>Post Data</h1>
    <hr>
    <form action="">
        <input type="text" name="date" id="datepicker">
        <input type="submit" value="Filter">
    </form>
    <hr>
    @if ($data['postCount'] > 0)
    @foreach ($data['post'] as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-3">
                    <img src="/storage/postImage/{{$post['vImage']}}" alt="{{$post->vTitle}}" style="width: 100%">
                    </div>
                    <div class="col-md-9">
                        <h3><a href="/post/{{$post['iPostId']}}">{{$post['vTitle']}}</a></h3>
                        <small>Written on : {{$post['created_at']}} by {{$post->user->vName}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$data['post']->links()}}
    @else
        <p>No Post Available to see</p>
    @endif
@endsection