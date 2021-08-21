@extends('layouts.admin')

@section('title')
    Products
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name' => 'products' , 'key' => 'List'])
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
                        <a href="{{ route('products.create') }}"
                           class="btn btn-success text-white float-right">Add</a>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@foreach($menus as $menu)--}}
                                <tr>
                                    <td scope="row">1</td>
                                    <td scope="row">iphone 5</td>
                                    <td scope="row">3000</td>
                                    <td scope="row">
                                        <img src="" alt="h/a">
                                    </td>
                                    <td>Điện thoại</td>
                                    <td>
                                        {{--<a href="{{route('products.edit',$menu->id)}}" class="btn btn-warning">Edit</a>--}}
                                        {{--<a onclick="return confirm('Bạn có chắc muốn xóa')" href="{{route('products.delete',$menu->id)}}" class="btn btn-danger ">Delete</a>--}}
                                    </td>
                                </tr>
                            {{--@endforeach--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        {{--@if($menus->hasPages())--}}
                            {{--{{ $menus->links() }}--}}
                        {{--@endif--}}
                    </div>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection