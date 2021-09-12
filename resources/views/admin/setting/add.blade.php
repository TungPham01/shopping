@extends('layouts.admin')

@section('title')
    Thêm mới Setting
@endsection

@section('css')

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name' => 'Setting' , 'key' => 'Add'])

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
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('status') }} text-center">{{ Session::get('message') }}</p>
                        @endif
                        <form method="post" action="{{ route('setting.store',['type'=>request()->type]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Config key: </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập config key" name="config_key" value="{{ old('config_key') }}">
                                {{--@error('name')--}}
                                {{--<div class="alert alert-danger">--}}
                                {{--{{ $message }}--}}
                                {{--</div>--}}
                                {{--@enderror--}}
                            </div>
                            @if(request()->type === 'text')
                                <div class="form-group">
                                    <label>Config value: </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập config value" name="config_value" value="{{ old('config_value') }}">
                                </div>
                            @elseif(request()->type === 'textarea')
                                <div class="form-group">
                                    <label>Config value: </label>
                                    <textarea name="config_value" id="my_editor" cols="30" rows="5" class="form-control ">
                                        {{ old('config_value') }}
                                    </textarea>
                                </div>
                            @endif

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
    <script src="{{ asset('admins/product/app.js') }}"></script>
@endsection