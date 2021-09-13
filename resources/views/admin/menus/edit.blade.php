@extends('admin.layouts.admin')

@section('title')
    Sửa menu
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header',['name' => 'menus' , 'key' => 'Edit'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{  session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{route('menus.update',$menus->id)}}">
                            @csrf
                            <div class="form-group">
                                <label >Tên menus: </label>
                                <input type="text" class="form-control" value="{{ $menus->name }}"  placeholder="Nhập tên menu" name="name">
                            </div>

                            <div class="form-group">
                                <label >Chọn menus cha: </label>
                                <select class="form-control" name = 'parent_id'>
                                    <option value="0">Chọn menu cha</option>
                                    {!! $optionSelect !!}
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