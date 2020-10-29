@extends('layouts.app_admin')

@section('title',$data['pageTitle'])

@section('content_admin')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$data['pageTitle']}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                <li class="breadcrumb-item active">{{$data['pageTitle']}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- Filter Area -->
                <form action="">                
                    <div class="row">
                        <div class="col-1"><p style="margin-top: 7px;">Filter Data</p></div>
                        <div class="col-2">
                        <input type="text" class="form-control" placeholder="Filter by Name">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" placeholder="Filter by Email">
                        </div>
                        <div class="col-2">
                            <select name="" class="form-control">
                                <option value="">Filter By Status</option>
                                <option value="Active">Active</option>
                                <option value="InActive">InActive</option>
                            </select>
                        </div>
                    </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($data['pageData']) > 0)
                        @for ($i = 0; $i < count($data['pageData']); $i++)
                            <tr>
                                <td><?=$i+1?></td>
                                <td><?=$data['pageData'][$i]['vName']?></td>
                                <td><?=$data['pageData'][$i]['vEmail']?></td>
                                <td><?=$data['pageData'][$i]['vEmail']?></td>
                            </tr>
                        @endfor
                    @else
                    <tr>
                      <td rowspan="10">Sorry. No Data Found</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>   
@endsection