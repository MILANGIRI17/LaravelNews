@extends('backend.master.master')
@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Users List</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Settings 1</a>
                                            <a class="dropdown-item" href="#">Settings 2</a>
                                        </div>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-md-12">
                                    @include('backend.layouts.message')
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>User Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @foreach ($users as $key=>$user)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{ucfirst($user->gender)}}</td>
                                            <td>
                                                <img src="{{url('uploads/users/'.$user->image)}}" width="40" alt="">
                                            </td>
                                            <td>
                                                <form action="{{route('update-user-status')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="criteria" value="{{$user->id }}">
                                                @if($user->status==1)
                                                <button name="active" class='btn btn-primary'><i class="fa fa-check"></i></button>
                                                @else
                                                <button name="inactive" class='btn btn-danger'><i class="fa fa-times"></i></button>
                                                @endif
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('update-user-type')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="criteria" value="{{$user->id }}">
                                                @if($user->user_type=='admin')
                                                <button name="admin" class='btn btn-success'><i class="fa fa-users"></i></button>
                                                @else
                                                <button name="user" class='btn btn-warning'><i class="fa fa-user"></i></button>
                                                @endif
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{route('edit-user').'/'.$user->id}}" class="btn btn-success"><i class="fa fa-edit"></i></i></a>
                                                <a href="{{route('delete-user').'/'.$user->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <hr>
                                    {{$users->links()}}    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->


@endsection
