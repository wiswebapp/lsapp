
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                    @if(count($data['postdata']) > 0)
                        <tr>
                            <th>#</th>
                            <th>Created At</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        @foreach($data['postdata'] as $post)
                        <tr>
                            <th><?=++$i?></th>
                            <th><?=date('d M Y',strtotime($post['created_at']))?></th>
                            <th><a href="/post/{{$post['iPostId']}}/edit"><?=$post['vTitle']?></a></th>
                            <th>
                                {!! Form::open(['action' => ['PostController@destroy', $post['iPostId']],'method'=>'post','class'=>'pull-right']) !!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete', ['class'=>'btn btn-sm btn-danger'])}}
                                {!!Form::close()!!}
                            </th>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <th colspan="10">No Post Found</th>
                        </tr>
                    @endif
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <a class="pagination btn btn-lg btn-success" href="/post/create">Create Post</a>
                        </div>
                        <div class="col-md-6 pull-right">
                            {{$data['postdata']->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
