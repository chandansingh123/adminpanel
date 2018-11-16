<h2 class="text-center text-uppercase">Our Activities</h2>
<div class="row">
    <section class="cd-timeline js-cd-timeline">
        <div class="cd-timeline__container">
            @foreach($activities as $key => $val)
            <div class="cd-timeline__block js-cd-block">
                <div class="cd-timeline__img cd-timeline__img--picture js-cd-img">
                    <img src="{{ asset('/uploads/activities/thumbs/'.$val->file_name) }}" alt="{{ $val->name}}" class="rounded-circle">
                  {{--   {!! Html::image('/uploads/activities/thumbs/'.$val->file_name, 'Activity Image', array('class' => 'rounded-circle')) !!} --}}
                </div><!-- cd-timeline__img -->

                <div class="cd-timeline__content js-cd-content">
                    <h3>{{$val->name}}</h3>
                    <div class="activity-jist">
                        <p>{{$val->description}}</p>
                        <div class="fadeout"></div>
                    </div>                            
                    <a href="#0" class="btn btn-secondary" title="{{$val->name}}">Read more</a>
                    <span class="cd-timeline__date"><i class="fa fa-calendar
                        "></i> {{date("Y-m-d", strtotime($val->activity_date))}}</span>

                    </div> <!-- cd-timeline__content -->
                </div> <!-- cd-timeline__block -->
                @endforeach
            </div>
        </section> <!-- cd-timeline -->
        <script src="/frontend/js/main.js"></script>
    </div>
