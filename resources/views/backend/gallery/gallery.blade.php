@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Gallery
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Gallery</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h3 class="card-title">Image List:</h3>
                </div>
                <div class="col-2">
                    <a href="/gallery/add" class="btn btn-block btn-info" role="button"><i class="fa fa-plus"></i>&nbsp;Add
                        Image</a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="galleries" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="padding-right: 5px">SN</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('backend.gallery.delete-model')

@endsection

@section('footer')
    {!! Html::script("backend/js/gallery/galleryList.js") !!}
    {!! Html::script("backend/js/gallery/gallery.js") !!}
@stop
