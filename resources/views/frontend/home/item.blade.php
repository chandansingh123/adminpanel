<h2>Our Item(s)</h2>

<div class="row sn_items">
    @foreach($items as $item)
    <div class="col-lg-4 mb-4">
        <div class="card h-100 text-center">
            {!! Html::image('/uploads/items/'.$item->file_name, 'Item Image', array('class' => 'img-fluid rounded', 'style' => "padding-bottom: 10px;")) !!}
            <div class="card-body">
                <h4 class="card-subtitle mb-2">{{$item->name}}</h4>
                <p class="card-text">{{$item->description}}
                    <span class="fadeout"></span>
                </p>

            </div>
            <div class="card-footer">
                <a href="/bidnow/{{$item->id}}" class="btn btn-info">BID NOW</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- /.row -->