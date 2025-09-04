<!-- Team Section Begin -->
<section class="team spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-6">
                <div class="section-title">
                    <span>Our Team</span>
                    <h2>Meet our team</h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="team__btn">
                    <a href="#" class="primary-btn normal-btn">View All</a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($team as $member)
            <div class="col-lg-4 col-md-6">
                <div class="team__item set-bg" data-setbg="{{ asset('storage/'.$member->image) }}">
                    <div class="team__text">
                        <div class="team__title">
                            <h5>{{ $member->name }}</h5>
                            <span>{{ $member->position }}</span>
                        </div>
                        <p>{{ $member->bio }}</p>
                        <div class="team__social">
                            @if($member->facebook)
                            <a href="{{ $member->facebook }}"><i class="fa fa-facebook"></i></a>
                            @endif
                            @if($member->twitter)
                            <a href="{{ $member->twitter }}"><i class="fa fa-twitter"></i></a>
                            @endif
                            @if($member->instagram)
                            <a href="{{ $member->instagram }}"><i class="fa fa-instagram"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Team Section End -->