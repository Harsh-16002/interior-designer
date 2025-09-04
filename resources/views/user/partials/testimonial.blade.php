<!-- Testimonial Section Begin -->
<section class="testimonial spad set-bg" data-setbg="img/testimonial/testimonial-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <span>Testimonials</span>
                    <h2>What your clients say</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial__carousel">
                    @foreach($testimonials as $index => $item)
                    <div class="testimonial__item">
                        <div class="row d-flex justify-content-center">
                            <div class="@if($loop->last) col-lg-9 @else col-xl-9 col-lg-10 @endif">
                                <p>"{!! $loop->iteration . '. ' . $item->review !!}"</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-10">
                <div class="testimonial__client">
                    @foreach($testimonials as $index => $item)
                    <div class="testimonial__client__item @if($loop->first) add @endif">
                        <div class="testimonial__client__pic">
                          <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">


                        </div>
                        <div class="testimonial__client__text">
                            <h5>{{ $item->name }}</h5>
                            <span>{{ $item->position }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="logo__carousel owl-carousel">
                    <div class="logo__carousel__item">
                        <a href="#"><img src="img/logo/logo-1.png" alt=""></a>
                    </div>
                    <div class="logo__carousel__item">
                        <a href="#"><img src="img/logo/logo-2.png" alt=""></a>
                    </div>
                    <div class="logo__carousel__item">
                        <a href="#"><img src="img/logo/logo-3.png" alt=""></a>
                    </div>
                    <div class="logo__carousel__item">
                        <a href="#"><img src="img/logo/logo-4.png" alt=""></a>
                    </div>
                    <div class="logo__carousel__item">
                        <a href="#"><img src="img/logo/logo-5.png" alt=""></a>
                    </div>
                    <div class="logo__carousel__item">
                        <a href="#"><img src="img/logo/logo-3.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Section End -->