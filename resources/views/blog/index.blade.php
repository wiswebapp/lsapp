@extends('layouts.app')

@section('content')
@include('layouts.error_msg')
<div class="container">
    <div class="content-grids">
        <div class="row">
            <div class="content-grid">
                @if ( empty(request()->input('param')) && (empty(request()->input('page')) || request()->input('page') == 1))
                    @foreach ($data['populurblog'] as $blog)
                    <div class="col-md-6 panel" style="margin-top:20px;">
                        <div class="blogBox">
                            <div class="post-info">
                                <div class="col-md-6">
                                    <img style="width:100%;max-height: 142px" class="img-responsive" src="{{ empty(!$blog->blog_image) ? asset('storage/blog/'.$blog->blog_image) : asset('images/noblog.png')}}" alt="{{$blog->id}} Image Not found"/>
                                </div>
                                <div class="col-md-6" style="min-height:167px;">
                                    <h4>
                                        <a title="{{$blog->title}}" href="/blog/{{$blog->blog_slug}}">{{$blog->title}}</a>
                                    </h4>
                                </div>
                                <div class="clearfix"></div>
                                <div class="content-area">
                                    @if (strlen($blog->content) > 350)
                                        {{substr($blog->content,0,100)}}.....<a href="/blog/{{$blog->blog_slug}}">Read More</a>
                                    @else
                                        {!!$blog->content!!}
                                    @endif
                                </div>
                                <div class="alert" style="margin:0px;">
                                    @if ($blog->views >= $data['maxViews'])
                                    <p class="alert-danger pull-left text-danger"><b>Popular Blog [{{$blog->views}} + Views] 🔥🔥</b></p>
                                    @elseif ($blog->views > $data['avgViews'])
                                    <p class="alert-success pull-left text-warning"><i>Recommanded [{{$blog->views}} Views]</i></p>
                                    @else
                                    <small>{{$blog->views}} Views</small>
                                    @endif
                                    <a class="pull-right" href="/blog/{{$blog->blog_slug}}"><span></span>READ MORE</a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                @forelse ($data['blog'] as $blog)
                <div class="col-md-12 panel">
                    <div class="panel blogSimpleBox panel-<?= ['danger','warning','success','info','primary'][ rand(0,4) ]; ?>">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a title="{{$blog->title}}" href="/blog/{{$blog->blog_slug}}">{{$blog->title}}</a></h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-3">
                                    <img style="width:100%;max-height: 142px" class="img-responsive" src="{{ empty(!$blog->blog_image) ? asset('storage/blog/'.$blog->blog_image) : asset('images/noblog.png')}}" alt="{{$blog->id}} Image Not found"/>
                            </div>
                            <div class="col-md-9">
                                @if (strlen($blog->content) > 1000)
                                    {{substr($blog->content,0,900)}}.....<a href="/blog/{{$blog->blog_slug}}">Read More</a>
                                @else
                                    {!!$blog->content!!}
                                @endif
                            </div>
                        </div>
                        <div class="panel-footer">
                            <p><span class="text-info">Views : {{$blog->views}}</span> | <span class="text-warning">Author : {{$blog->user->name}}</span></p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="content-grid-info">
                    <div class="post-info">
                    <h3 class="alert alert-danger">We are unable to find any blogs..!</h3>
                    </div>
                </div>
                @endforelse
            </div>
            <div class="clearfix"></div>
            <hr>
            {{$data['blog']->withQueryString()->links()}}
        </div>
    </div>
</div>
@endsection