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
                                <th>Mô tả</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td scope="row">{{ $product->id }}</td>
                                    <td scope="row">{{ $product->name }}</td>
                                    <td scope="row">{{ number_format($product->price)}}</td>
                                    <td scope="row">
                                        <img style="object-fit: cover" src="{{ $product->feature_image_path }}" width="150px" height="130px" alt="h/a">
                                    </td>
                                    {{--sử dụng orm relationship : trỏ đến hàm categories để lấy giá trị của bảng category--}}
                                    <td>{{ optional($product->categories)->name }}</td>
                                    <td>{!! $product->content !!}</td>
                                    <td>
                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning">Edit</a>
                                        <a data-url="{{route('products.delete',$product->id)}}" href="" class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        @if($products->hasPages())
                            {{ $products->links() }}
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
    <script src="{{ asset('admins/product/index.js') }}"></script>
@endsection