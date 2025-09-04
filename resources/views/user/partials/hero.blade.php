<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        @foreach($hero as $hero)
        <div class="hero__items set-bg" data-setbg="{{ asset('storage/'.$hero->slide_image) }}">
            <div class="hero__text">
                <h2>{{ $hero->heading }}</h2>
                <a href="{{route('projects.show')}}" class="primary-btn">See Project</a>
                <a href="#" class="more_btn">Discover more</a>
                <div class="hero__social">
                    <a href="{{ $hero->fblink }}"><i class="fa fa-facebook"></i></a>
                    <a href="{{ $hero->twitterlink }}"><i class="fa fa-twitter"></i></a>
                    <a href="{{ $hero->instralink }}"><i class="fa fa-instagram"></i></a>
                    <a href="{{ $hero->linkdinlink }}"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="slide-num" id="snh-1"></div>
    <div class="slider__progress"><span></span></div>
</section>
<!-- Hero Section End -->

<script>
$(document).ready(function(){
    // Initialize Owl Carousel
    $('.hero__slider').owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        dots: false,
        autoplay: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1000
    });

    // If you're loading content via AJAX later, reinitialize like this:
    /*
    function loadNewHeroContent() {
        $.get('/get-hero-content', function(data) {
            $('.hero__slider').html(data).owlCarousel().trigger('refresh.owl.carousel');
        });
    }
    */
});
</script>