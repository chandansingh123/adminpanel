<!-- Team Members -->
<h2>Our Members</h2>
<div class="row members-list">
    @foreach($members as $member)
    <div class="col-lg-3 mb-3">
        <div class="card h-100 text-center">
            {!! Html::image('/uploads/members/'.$member->photo, 'Member Image', array('class' => 'rounded-circle', 'width'=>'100', 'height'=>'100')) !!}
            <div class="card-body">
                <h6 class="card-subtitle mb-2">{{ $member->first_name }} {{ $member->last_name }}</h6>
            </div>
        </div>
    </div>
@endforeach
</div>