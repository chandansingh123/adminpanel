@extends('frontend.layouts.app')

@section('content')
<section class="page-header page-header-custom-background">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1><span> Register a new member</span></h1>
      </div>
      <div class="col-lg-6">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/account" title="">Account</a></li>
                <li><a href="/signup">Sign Up</a></li>
            </ul>
      </div>
    </div>
  </div>
</section>

<div class="container">
    <div class="login-box">
        <div class="login-logo">
            <h6>Welcome to our Saral Nilami!</h6>   
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
<!--                 <h4 class="text-center">Register a new membership</h4>
 -->
                <form action="{{ route('customer.store') }}" class="saral-form" method="post" id="customer-add-form">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" name="address" placeholder="Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" name="phone" placeholder="Phone" maxlength="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <div class="col-12">
                                <label>
                                    <input type="checkbox" name="terms" id="terms"> I agree to the <a href="/termsandcondition">Terms and Conditions</a>
                                </label>
                                <span id="fake-terms"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
                        </div>
                    </div>
                    <hr>
                    <p class="mb-0"><a href="/login" class="text-center">I already have a membership.</a></p>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    </div>
@endsection

@section('footer')
    {!! Html::script("frontend/js/customer/customer.js") !!}
@stop