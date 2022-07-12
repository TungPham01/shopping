@extends('admin.layouts.admin')

@section('title')
    Sửa Admin
@endsection

@section('css')

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name' => 'Vai trò' , 'key' => 'Sửa'])

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
                        <form method="post" action="{{ route('roles.update',['id'=>$role->id]) }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label>Tên vai trò: </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên" name="name" value="{{ $role->name }}">
                            </div>
                            <div class="form-group">
                                <label>Mô tả vai trò: </label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror" placeholder="Nhập mô tả vai trò" name="display_name" value="{{ $role->display_name }}">
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
    <script src="{{ asset('admins/product/app.js') }}"></script>
@endsection