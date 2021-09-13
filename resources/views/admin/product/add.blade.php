@extends('admin.layouts.admin')

@section('title')
    Thêm mới sản phẩm
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admins/product/style.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name' => 'products' , 'key' => 'Add'])

    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-8">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{  session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm: </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên sản phẩm" name="name" value="{{ old('name') }}">
                                {{--@error('name')--}}
                                {{--<div class="alert alert-danger">--}}
                                    {{--{{ $message }}--}}
                                {{--</div>--}}
                                {{--@enderror--}}
                            </div>

                            <div class="form-group">
                                <label>Giá tiền: </label>
                                <input type="text" class="form-control" placeholder="Nhập giá tiền" name="price" value="{{ old('price') }}">
                            </div>

                            <div class="form-group">
                                <label>Ảnh đại diện: </label>
                                <input type="file" class="form-control-file" name="feature_image_path" >
                            </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết: </label>
                                <input type="file" multiple class="form-control-file" name="image_path[]" >
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục: </label>
                                <select class="form-control  category_select2" name='category_id'>
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm: </label>
                                <select class="form-control tags_select2" multiple="multiple" name="tags[]">

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Mô tả sản phẩm: </label>
                                <textarea name="contents" id="my_editor" cols="30" rows="5" class="form-control">

                                </textarea>
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
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
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    {{--<script>--}}
    {{--var options = {--}}
    {{--filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',--}}
    {{--filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',--}}
    {{--filebrowserBrowseUrl: '/laravel-filemanager?type=Files',--}}
    {{--filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='--}}
    {{--};--}}
    {{--</script>--}}
    {{--<script>--}}
    {{--CKEDITOR.replace('my_editor', options);--}}
    {{--</script>--}}
    <script src="{{ asset('admins/product/app.js') }}"></script>

@endsection