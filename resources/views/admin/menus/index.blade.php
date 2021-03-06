@extends('admin.layouts.admin')

@section('title')
    Menus
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name' => 'menus' , 'key' => 'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if(session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 my-2">
                        <a href="{{ route('menus.create') }}"
                           class="btn btn-success text-white float-right">Add</a>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên menus</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <th scope="row">{{ $menu->id }}</th>
                                    <td>{{ $menu->name }}</td>
                                    <td>
                                        <a href="{{route('menus.edit',$menu->id)}}" class="btn btn-warning">Edit</a>
                                        <a onclick="return confirm('Bạn có chắc muốn xóa')" href="{{route('menus.delete',$menu->id)}}" class="btn btn-danger ">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        @if($menus->hasPages())
                            {{ $menus->links() }}
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