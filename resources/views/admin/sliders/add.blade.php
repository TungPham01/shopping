@extends('admin.layouts.admin')

@section('title')
    Thêm mới slider
@endsection

@section('css')

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name' => 'Slider' , 'key' => 'Add'])

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

                        <form method="post" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên slider: </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên sldier" name="name" value="{{ old('name') }}">
                                {{--@error('name')--}}
                                {{--<div class="alert alert-danger">--}}
                                {{--{{ $message }}--}}
                                {{--</div>--}}
                                {{--@enderror--}}
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh: </label>
                                <input type="file" class="form-control-file " name="image_path" >
                            </div>

                            <div class="form-group">
                                <label>Mô tả sản phẩm: </label>
                                <textarea name="description" id="my_editor" cols="30" rows="5" class="form-control ">
                                    {{ old('description') }}
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