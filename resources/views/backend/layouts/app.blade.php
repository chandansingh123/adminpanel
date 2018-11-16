<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Saral Nilami | Dashboard') }}</title>
    @yield('before-styles-end')
    {!! Html::style('plugins/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}
    {!! Html::style('plugins/Ionicons/css/ionicons.min.css') !!}
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css') !!}
    {!! Html::style('plugins/datatables/dataTables.bootstrap4.min.css') !!}
    {!! HTML::style('backend/css/jquery-ui.css') !!}
    {!! Html::style('backend/css/theme/adminlte.min.css') !!}
    {!! Html::style('plugins/iCheck/all.css') !!}
    {!! Html::style('backend/css/style.css') !!}
    @yield('after-styles-end')

    @yield('head')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('backend.includes.header')

@include('backend.includes.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @yield('page-header')
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumbs')
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @yield('content')

            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('backend.includes.footer')

</div>
<!-- ./wrapper -->

{!! Html::script("plugins/jquery/jquery.min.js") !!}
{!! Html::script("plugins/bootstrap/js/bootstrap.bundle.min.js") !!}
{!! Html::script("https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js") !!}
{!! Html::script("https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js") !!}
{!! Html::script("plugins/datatables/fnPagingInfo.js") !!}
{!! Html::script("plugins/iCheck/icheck.min.js") !!}
{!! Html::script("plugins/fastclick/fastclick.js") !!}
{!! Html::script("backend/js/theme/adminlte.min.js") !!}
{!! Html::script("plugins/jvectormap/jquery-jvectormap-1.2.2.min.js") !!}
{!! Html::script("plugins/jvectormap/jquery-jvectormap-world-mill-en.js") !!}
{!! Html::script("plugins/slimScroll/jquery.slimscroll.min.js") !!}
{!! Html::script("plugins/chart.js/Chart.js") !!}
{!! Html::script("plugins/jQueryUI/jquery-ui.min.js") !!}

{!! Html::script("backend/js/vendor/jquery.validate.min.js") !!}
{!! Html::script("backend/js/vendor/additional-methods.min.js") !!}
{!! Html::script("backend/js/vendor/jquery.maskedinput.js") !!}
{!! Html::script("backend/js/vendor/jquery.blockUI.js") !!}
{!! Html::script("backend/js/utils/common.js") !!}

@yield('footer')

</body>
</html>