<section class="cd-timeline js-cd-timeline">
        <div class="cd-timeline__container">
            <div class="cd-timeline__block js-cd-block">
                <div class="cd-timeline__img cd-timeline__img--picture js-cd-img">
                    <img src="/frontend/img/icons/cd-icon-picture.svg" alt="Picture">
                </div> <!-- cd-timeline__img -->

                <div class="cd-timeline__content js-cd-content">
                    <h2>Title of section 1</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                    <a href="#0" class="cd-timeline__read-more">Read more</a>
                    <span class="cd-timeline__date">Jan 14</span>
                </div> <!-- cd-timeline__content -->
            </div> <!-- cd-timeline__block -->

            <div class="cd-timeline__block js-cd-block">
                <div class="cd-timeline__img cd-timeline__img--movie js-cd-img">
                    <img src="/frontend/img/icons/cd-icon-movie.svg" alt="Movie">
                </div> <!-- cd-timeline__img -->

                <div class="cd-timeline__content js-cd-content">
                    <h2>Title of section 2</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?</p>
                    <a href="#0" class="cd-timeline__read-more">Read more</a>
                    <span class="cd-timeline__date">Jan 18</span>
                </div> <!-- cd-timeline__content -->
            </div> <!-- cd-timeline__block -->

            <div class="cd-timeline__block js-cd-block">
                <div class="cd-timeline__img cd-timeline__img--picture js-cd-img">
                    <img src="/frontend/img/icons/cd-icon-picture.svg" alt="Picture">
                </div> <!-- cd-timeline__img -->

                <div class="cd-timeline__content js-cd-content">
                    <h2>Title of section 3</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur perferendis enim amet quae quasi repudiandae sed quod veniam dolore possimus rem voluptatum eveniet eligendi quis fugiat aliquam sunt similique aut adipisci.</p>
                    <a href="#0" class="cd-timeline__read-more">Read more</a>
                    <span class="cd-timeline__date">Jan 24</span>
                </div> <!-- cd-timeline__content -->
            </div> <!-- cd-timeline__block -->

            <div class="cd-timeline__block js-cd-block">
                <div class="cd-timeline__img cd-timeline__img--location js-cd-img">
                    <img src="/frontend/img/icons/cd-icon-location.svg" alt="Location">
                </div> <!-- cd-timeline__img -->

                <div class="cd-timeline__content js-cd-content">
                    <h2>Title of section 4</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                    <a href="#0" class="cd-timeline__read-more">Read more</a>
                    <span class="cd-timeline__date">Feb 14</span>
                </div> <!-- cd-timeline__content -->
            </div> <!-- cd-timeline__block -->

            <div class="cd-timeline__block js-cd-block">
                <div class="cd-timeline__img cd-timeline__img--location js-cd-img">
                    <img src="/frontend/img/icons/cd-icon-location.svg" alt="Location">
                </div> <!-- cd-timeline__img -->

                <div class="cd-timeline__content js-cd-content">
                    <h2>Title of section 5</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum.</p>
                    <a href="#0" class="cd-timeline__read-more">Read more</a>
                    <span class="cd-timeline__date">Feb 18</span>
                </div> <!-- cd-timeline__content -->
            </div> <!-- cd-timeline__block -->

            <div class="cd-timeline__block js-cd-block">
                <div class="cd-timeline__img cd-timeline__img--movie js-cd-img">
                    <img src="/frontend/img/icons/cd-icon-movie.svg" alt="Movie">
                </div> <!-- cd-timeline__img -->

                <div class="cd-timeline__content js-cd-content">
                    <h2>Final Section</h2>
                    <p>This is the content of the last section</p>
                    <span class="cd-timeline__date">Feb 26</span>
                </div> <!-- cd-timeline__content -->
            </div> <!-- cd-timeline__block -->
        </div>
    </section> <!-- cd-timeline -->

<script src="/frontend/js/main.js"></script>


    <div class="timeline timeline-line-dotted">
    @foreach($activities as $key => $val)
        <span class="timeline-label">
            <span class="label label-primary">{{date("Y-m-d", strtotime($val->activity_date))}}</span>
        </span>
        <div class="timeline-item">
            <div class="timeline-point timeline-point-success">
                <i class="fa fa-star"></i>
            </div>
            <div class="timeline-event">
                <div class="timeline-heading">
                    <h4>{{$val->name}}</h4>
                </div>
                <div class="timeline-body">
                    <div class="row">
                        <div class="col-sm-4">
                            {!! Html::image('/uploads/activities/thumbs/'.$val->file_name, 'Activity Image', array('class' => 'img-thumbnail')) !!}
                        </div>
                        <div class="col-sm-8">
                            <p>{{$val->description}}</p>
                        </div>
                    </div>
                </div>
                <div class="timeline-footer">
                    <p class="text-right">{{date("Y-m-d", strtotime($val->activity_date))}}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div style="margin: 23px auto 0px;">
    <a href="https://www.facebook.com/raksirang" target="_blank">
        <img src="{{ asset('/frontend/img/facebook.png') }}" alt="Facebook" style="height: 40px">
    </a>
</div>