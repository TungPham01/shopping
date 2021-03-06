@extends('admin.layouts.admin')

@section('title')
    Thêm vai trò
@endsection

@section('css')
    <style>
        label {
            font-weight: normal !important;
        }
        .card-header {
            background-color: lightblue;
        }
    </style>
@endsection

@section('js')
    <script>
        $('.checkbox_wrapper').click(function() {
            $(this).closest('.card').find('.checkbox_childer').prop('checked', $(this).prop('checked'));
        })
    </script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name' => 'Vai trò' , 'key' => 'Thêm mới'])

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
                    <div class="col-12">
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('status') }} text-center">{{ Session::get('message') }}</p>
                        @endif
                        <form method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nhập tên: </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label>Nhập mô tả vai trò: </label>
                                    <input type="text" class="form-control @error('display_name') is-invalid @enderror" placeholder="Nhập mô tả vai trò" name="display_name" value="{{ old('display_name') }}">
                                </div>
                            </div>
                            @foreach($permissionParent as $parent)
                                <div class="col-12">
                                    <div class="card border-primary mb-3">
                                        <div class="card-header">
                                            <input id="{{ $parent->name }}" type="checkbox" value="" class="checkbox_wrapper">
                                            <label for="{{ $parent->name }}">
                                                {{ $parent->name }}
                                            </label>
                                        </div>
                                        <div class="row">
                                            @foreach($parent->permissionsChildren as $children)
                                                <div class="card-body col-3">
                                                    <h5 class="card-title">
                                                        <input id="{{ $children->name }}" type="checkbox" name="permission_id[]" value="{{ $children->id }}" class="checkbox_childer">
                                                        <label for="{{ $children->name }}">
                                                            {{ $children->name }}
                                                        </label>
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
    <script src="{{ asset('admins/product/app.js') }}"></script>
@endsection