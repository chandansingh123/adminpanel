<hr>
    <h2>Gallery</h2>
    <div class="row" style="margin: 0 15px 30px 15px;">
<div class="col-md-12">
    <div class="slider autoplay">
        @foreach($galleries as $key => $val)
            <div class="multiple">{!! Html::image('/uploads/galleries/thumbs/'.$val->file_name, 'Gallery Image', array('width'=> 255, 'class' => 'img-thumbnail')) !!}</div>
        @endforeach
        </div>
    </div>
</div>