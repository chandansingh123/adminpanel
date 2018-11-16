    <div class="overlay"></div>
    <div id="carousel-default" class="carousel slide" data-ride="carousel" style="margin-top: 120px">
      <ol class="carousel-indicators" style="z-index: 2">
        @foreach($galleries as $item)
        <li data-target="#carousel-default" data-slide-to="{{ $loop->index }}" class="{{ $loop->last ? 'active': '' }}">
        </li>
        @endforeach
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- NOTE: Bootstrap v4 changes class name to carousel-item -->
        @foreach($galleries as $gallery)
        <div class="item {{ $loop->last ? 'active':'' }}">
          <img src="{{ asset('uploads/galleries/'.$gallery->file_name) }}" alt="{{ $gallery->title }}" class="width:100%"> 
          <div class="carousel-caption">
            <h3>{{ $gallery->title }}</h3>
            <p>{{ $gallery->description }}</p>
          </div>
        </div>
        @endforeach
      </div>
      <a class="left carousel-control" href="#carousel-default" role="button" data-slide="prev">
        {{-- <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span> --}}
      </a>
      <a class="right carousel-control" href="#carousel-default" role="button" data-slide="next">
        {{-- <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span> --}}
      </a>
    </div>
