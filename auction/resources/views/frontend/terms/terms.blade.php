@extends('frontend.layouts.app')

@section('content')
<section class="page-header page-header-custom-background">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1><span> {{$terms->name}}</span></h1>
      </div>
          <!-- Page Heading/Breadcrumbs -->

      <div class="col-lg-6">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/termsandcondition">{{$terms->name}}</a></li>
            </ul>
      </div>
    </div>
  </div>
</section>
    <!-- Intro Content -->
    <div class="container">
    <div class="row">
        <div class="col-lg-9">
           <p>{{$terms->description}}</p>
        </div>
<div class="col-lg-3">
<div class="widget clearfix" style="margin-top:5px;">
    
  <a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="#" title="Check Mail" target="_blank" style="width:100%;">
  <button type="button" class="btn btn-success mb-2" style="width:100%; text-align:left;"><i class="fa fa-arrow-circle-right"></i>&nbsp;<span>Check Mail</span></button></a>
    
  <a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="#" title=" Suggestions &amp; Feedbacks" target="_self" style="width:100%;"><button type="button" class="btn btn-success mb-2" style="width:100%; text-align:left;"><i class="fa fa-arrow-circle-right"></i>&nbsp;<span> Suggestions &amp; Feedbacks</span></button></a>
  </div>
           <div class="widget clearfix" style="margin-top:5px;">
<a class="button butt on-rounded button-reveal button-small button-dirtygreen tleft" href="#" target="_self" style="width:100%; margin-top:5px;"><button type="button" class="btn btn-tertiary mb-2" style="width:100%; text-align:left;"><i class="fa fa-download"></i>&nbsp;<span>Downloads</span></button></a>
<a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="#" style="width:100%; margin-top:5px;"><button type="button" class="btn btn-tertiary mb-2" style="width:100%; text-align:left;"><i class="fa fa-info-circle"></i>&nbsp;<span>Career</span></button></a>

<a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="#" target="_self" style="width:100%; margin-top:5px;"><button type="button" class="btn btn-tertiary mb-2" style="width:100%; text-align:left;"><i class="fa fa-bookmark-o"></i>&nbsp;<span>Useful Links</span></button></a>
<a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="#" target="_self" style="width:100%; margin-top:5px;"><button type="button" class="btn btn-tertiary mb-2" style="width:100%; text-align:left;"><i class="fa fa-address-card-o"></i>&nbsp;<span>Networks and Contacts</span></button></a>
<!-- </div> -->        

        </div>
    </div>
    </div>
    <!-- /.row -->
@endsection