@extends('admin.layouts.admin')

@section('title')
    Thêm mới Setting
@endsection

@section('css')

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name' => 'Setting' , 'key' => 'Add'])

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
                        <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label>Name: </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label>Email: </label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>Password: </label>
                                <input type="password" autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập password" name="password" value="">
                            </div>
                            <div class="form-group">
                                <label>Password confirm: </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập lại password" name="password_confirmation" value="">
                            </div>
                            <div class="form-group">
                                <label>Chọn vai trò: </label>
                                <select class="form-control" name="role_id[]" id="" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
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