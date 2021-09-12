@extends('layouts.admin')

@section('title')
    Sliders
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name' => 'sliders' , 'key' => 'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('status') }} text-center">{{ Session::get('message') }}</p>
                @endif
                <div class="row">
                    <div class="col-12 my-2">
                        <a href="{{ route('sliders.create') }}"
                           class="btn btn-success text-white float-right">Add</a>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên slider</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td scope="row">{{ $slider->id }}</td>
                                    <td scope="row">{{ $slider->name }}</td>
                                    <td scope="row">{!! $slider->description !!} </td>
                                    <td scope="row">
                                        <img style="object-fit: cover" src="{{ $slider->image_path }}" width="150px" height="130px" alt="h/a">
                                    </td>
                                    <td>
                                        <a href="{{route('sliders.edit',$slider->id)}}" class="btn btn-warning">Edit</a>
                                        <a data-url="{{route('sliders.delete',$slider->id)}}" href="" class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        @if($sliders->hasPages())
                            {{ $sliders->links() }}
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
    <script src="{{ asset('admins/main.js') }}"></script>
@endsection