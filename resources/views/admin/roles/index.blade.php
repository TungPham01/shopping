@extends('admin.layouts.admin')

@section('title')
    Admin
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/setting/style.css')}}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name' => 'Vai trò' , 'key' => 'Danh sách'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('status') }} text-center">{{ Session::get('message') }}</p>
                @endif
                <div class="row">
                    <div class="col-12 my-2">
                        <div class="btn-group float-right">
                            <a href="{{ route('roles.create') }}" class="btn btn-success text-white float-right">Add</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên vai trò</th>
                                <th scope="col">Mô tả vài trò</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = (($page - 1) * 5) + 1;
                            @endphp
                                @foreach($roles as $role)
                                    <tr>
                                        <td scope="row">{{ $i++ }}</td>
                                        <td scope="row">{!! $role->name !!} </td>
                                        <td scope="row">{{ $role->display_name }}</td>
                                        <td>
                                            <a href="{{route('roles.edit',['id'=>$role->id])}}" class="btn btn-warning">Edit</a>
                                            <a data-url="{{route('roles.delete',$role->id)}}" href="" class="btn btn-danger action_delete">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        @if($roles->hasPages())
                        {{ $roles->links() }}
                        @endif
                    </div>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('admins/main.js') }}"></script>
@endsection