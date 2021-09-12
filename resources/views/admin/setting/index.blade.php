@extends('layouts.admin')

@section('title')
    Setting
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/setting/style.css')}}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name' => 'Setting' , 'key' => 'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('status') }} text-center">{{ Session::get('message') }}</p>
                @endif
                <div class="row">
                    <div class="col-12 my-2">
                        <div class="btn-group float-right">
                            <a class="btn dropdown-toggle btn-success" data-toggle="dropdown" href="#">
                                Add Setting
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('setting.create') . '?type=text' }}">Text</a></li>
                                <li><a href="{{ route('setting.create') . '?type=textarea'}}">Textarea</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($setting as $set)
                                    <tr>
                                        <td scope="row">{{ $set->id }}</td>
                                        <td scope="row">{{ $set->config_key }}</td>
                                        <td scope="row">{!! $set->config_value !!} </td>
                                        <td scope="row">{{ $set->type }} </td>
                                        <td>
                                        <a href="{{route('setting.edit',['id'=>$set->id,'type'=>$set->type])}}" class="btn btn-warning">Edit</a>
                                        <a data-url="{{route('setting.delete',$set->id)}}" href="" class="btn btn-danger action_delete">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        @if($setting->hasPages())
                        {{ $setting->links() }}
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