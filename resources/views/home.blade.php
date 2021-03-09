@extends('layouts.app')

@section('content')
<div class="container content-grids">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.error_msg')
            <div class="panel panel-default">
                    <a class="btn btn-success pull-right btn-sm" href="{{route('user')}}">My profile</a>
                    <a class="btn btn-success pull-right btn-sm" href="{{route('blog.create')}}">Add Blog</a>
                <div class="panel-heading">
                    <h2 class="text-danger">{{ __('My Dashboard') }}</h2>
                </div>
                <div class="panel-body">
                    <table class="table table-boardered">
                        <thead>
                            <tr>
                                <th>Created On</th>
                                <th>Updated On</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            @if ($data['blog']->count() > 0)
                            @foreach ($data['blog'] as $myblog)
                            <tr>
                                <td>{{date('d-m-Y (h:i a)',strtotime($myblog->created_at))}}</td>
                                <td>{{date('d-m-Y (h:i a)',strtotime($myblog->updated_at))}}</td>
                                <td>
                                    <a href="/blog/{{$myblog->blog_slug}}/edit">{{$myblog->title}}</a>
                                </td>
                                <td>
                                    @if (@Auth::user()->id == $myblog->user_id)
                                    {!! Form::open(['action' => ['BlogController@destroy', $myblog->blog_slug],'method'=>'post']) !!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete', ['class'=>'btn btn-sm btn-danger'])}}
                                    {!!Form::close()!!}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr colspan="3">
                                <td><h2>Sorry ! No blog Found</h2></td>
                            </tr>
                            @endif
                        </thead>
                    </table>
                    {{$data['blog']->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
