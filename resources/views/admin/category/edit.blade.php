@extends('admin.layouts.admin')

@section('title')
    Trang chủ
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name' => 'category' , 'key' => 'Edit'])
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

                        <form method="post" action="{{ route('categories.update',['id'=>$category->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label >Tên danh mục: </label>
                                <input type="text" class="form-control"
                                       value="{{ $category->name }}"
                                       placeholder="Nhập tên danh mục" name="name">
                            </div>

                            <div class="form-group">
                                <label >Chọn danh mục cha: </label>
                                <select class="form-control" name = 'parent_id'>
                                    <option value="0">Chọn danh mục cha</option>
                                    {!! $htmlOption !!}
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