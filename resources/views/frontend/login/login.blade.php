@extends('frontend.layouts.app')

@section('content')
<section class="page-header page-header-custom-background">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1><span> Sign in to start your session</span></h1>
      </div>
      <div class="col-lg-6">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/account" title="">Account</a></li>
                <li><a href="/signup">Sign In</a></li>
            </ul>
      </div>
    </div>
  </div>
</section>
<div class="container">
    <div class="login-box">
  
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <h4 class="text-center"></h4>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{!! $error !!}</div>
                    @endforeach
                </div>
            @endif
            @if (Session::get('flash_danger'))
                <div class="alert alert-danger">
                    <div> {!! Session::get('flash_danger') !!}</div>
                </div>
            @endif
            <form action="{{ route('customer.login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                    </div>
                    <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-info btn-block btn-flat">Sign In</button>
                </div>
                </div>
                <hr>
                <p class="mb-0">
                    Not registered? <a href="/signup" class="text-center">Create an Account.</a>
                </p>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->
    </div></div>
@endsection

@section('footer')
    {!! Html::script("frontend/login/login.js") !!}
@stop