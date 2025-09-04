<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our specialization</span>
                    <h2>What we do</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($services as $service)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}">
                    <h4>{{ $service->title }}</h4>
                    <p>{{ $service->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="counter__content">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="count">{{$counter->projects_completed}}</h2>
                        </div>
                        <div class="counter__item__text">
                            <h5>Projects<br />Completed</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="count">{{$counter->happy_clients}}</h2>
                        </div>
                        <div class="counter__item__text">
                            <h5>Happy<br />Clients</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="count">{{$counter->awards_received}}</h2>
                        </div>
                        <div class="counter__item__text">
                            <h5>Awards<br />Received</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="count">{{$counter->cup_of_coffee}}</h2>
                        </div>
                        <div class="counter__item__text">
                            <h5>Cups Of<br />Coffee</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

@push('scripts')
<script>
$(document).ready(function(){
    // Counter animation - keeps original animation
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    // Service items animation - fade in effect
    $('.services__item').each(function(i) {
        $(this).css({
            'opacity': 0,
            'position': 'relative',
            'top': '20px'
        }).delay(100 * i).animate({
            opacity: 1,
            top: 0
        }, 400);
    });
});
</script>
@endpush