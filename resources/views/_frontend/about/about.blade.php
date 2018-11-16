@extends('_frontend.layouts.app')

@section('content')

<!-- Page Heading/Breadcrumbs -->

<section class="page-header page-header-custom-background" style="margin-top: 100px">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1><span> {{$about->name}}</span></h1>
      </div>
      <div class="col-lg-6">
        <ul class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li><a href="/aboutus">{{$about->name}}</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <!-- Intro Content -->
  <div class="row lead">
    <div class="col-lg-9">
      <p>{{$about->description}}</p>
    </div>
    <div class="col-lg-3">
      <div class="widget clearfix" style="margin-top:5px;">

        <a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="#" title="Check Mail" target="_blank" style="width:100%;">
          <button type="button" class="btn btn-success mb-2" style="width:100%; text-align:left;"><i class="fa fa-arrow-circle-right"></i>&nbsp;<span>Check Mail</span></button></a>

          <a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="grievance_suggestion" title=" Suggestions &amp; Feedbacks" target="_self" style="width:100%;"><button type="button" class="btn btn-success mb-2" style="width:100%; text-align:left;"><i class="fa fa-arrow-circle-right"></i>&nbsp;<span> Suggestions &amp; Feedbacks</span></button></a>
        </div>
        <div class="widget clearfix" style="margin-top:5px;">
          <a class="button butt on-rounded button-reveal button-small button-dirtygreen tleft" href="downloads" target="_self" style="width:100%; margin-top:5px;"><button type="button" class="btn btn-tertiary mb-2" style="width:100%; text-align:left;"><i class="fa fa-download"></i>&nbsp;<span>Downloads</span></button></a>
          <a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="career" target="_self" style="width:100%; margin-top:5px;"><button type="button" class="btn btn-tertiary mb-2" style="width:100%; text-align:left;"><i class="fa fa-info-circle"></i>&nbsp;<span>Career</span></button></a>

          <a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="links" target="_self" style="width:100%; margin-top:5px;"><button type="button" class="btn btn-tertiary mb-2" style="width:100%; text-align:left;"><i class="fa fa-bookmark-o"></i>&nbsp;<span>Useful Links</span></button></a>
          <a class="button button-rounded button-reveal button-small button-dirtygreen tleft" href="contact_us" target="_self" style="width:100%; margin-top:5px;"><button type="button" class="btn btn-tertiary mb-2" style="width:100%; text-align:left;"><i class="fa fa-address-card-o"></i>&nbsp;<span>Networks and Contacts</span></button></a>
          <!-- </div> -->        

        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  @endsection