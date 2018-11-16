<!--product section-->
<section id="product" class="product">
   <div class="container">
      <div class="main_product roomy-80">
         <div class="head_title text-center fix">
            <h2 class="text-uppercase">Listed Bids</h2>
            <h5>......................................................................................</h5>
         </div>
         <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
               <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
               <li data-target="#carousel-example-generic" data-slide-to="1"></li>
               <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
               <div class="item active">
                  <div class="container">
                     <div class="row">
                        @foreach($items as $item)
                        @if($loop->iteration !=2)
                           <div class="col-sm-3">
                              <div class="port_item xs-m-top-30">
                                 <div class="port_img">
                                    <img src="{{ asset('/uploads/items/'.$item->file_name) }}"  alt="{{ $item->name }}" />
                                    <div class="port_overlay text-center">
                                       <a href="{{ asset('/uploads/items/'.$item->file_name) }}" class="img-fluid popup-img">+</a>

                                    </div>
                                 </div>
                                 <!-- <div class="port_caption m-top-20">
                                    <h5>Mrs Praja</h5>
                                    <h6></h6>
                                    </div> -->

                                 <center>
                                    {{-- <a href="/bidnow/{{$item->id}}" class="btn btn-primary m-top-20">BID CLOSED</a> --}}
                                    <button class="btn btn-primary m-top-20">BID CLOSED</button>
                                 </center>
                              </div>
                           </div>
                        @endif
                        @if($loop->iteration ==2)
                           <div class="col-sm-3">
                              <div class="port_item xs-m-top-30">
                                 <div class="port_img">
                                    <img src="{{ asset('/uploads/items/'.$item->file_name) }}"  alt="{{ $item->name }}" />
                                    <div class="port_overlay text-center">
                                       <a href="{{ asset('/uploads/items/'.$item->file_name) }}" class="img-fluid popup-img">+</a>

                                    </div>
                                 </div>
                                 <!-- <div class="port_caption m-top-20">
                                    <h5>Mrs Praja</h5>
                                    <h6></h6>
                                    </div> -->

                                 <center><a href="/bidnow/{{$item->id}}" class="btn btn-success m-top-20">BID OPEN</a></center>
                              </div>
                           </div>
                        @endif
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
            </a>
         </div>
      </div>
      <!-- End off row -->
   </div>
   <!-- End off container -->
</section>
<!-- End off Product section -->