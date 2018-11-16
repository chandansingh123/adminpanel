<!--Business Section-->
<section id="business" class="business bg-grey roomy-70">
    <div class="container">
        <div class="row">
            <div class="main_business">
                <div class="col-md-6">
                    <!-- Item Images -->
                    <div id="image-item">
                        <img src="{{ asset('uploads/galleries/'.$galleries[0]->file_name) }}" alt="{{ $galleries[0]->title }}" class="img-responsive">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="business_item">
                        <h2 class="text-uppercase"> {{ $galleries[0]->title }}</h2>
                        <ul>
                            <li><i class="fa fa-arrow-circle-right"></i> Fiery akabare khursani</li>
                        </ul>
                        <p class="m-top-20">
                            {{ $galleries[0]->description }}
                       </p>

                        <div class="business_btn">

                            <a href="" class="btn btn-default m-top-20">Read More</a>
                           {{--  <a href="" class="btn btn-primary m-top-20"> <p class="blink"> <b><font color="white">BID NOW</font></b></p></a> --}}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End off Business section -->
