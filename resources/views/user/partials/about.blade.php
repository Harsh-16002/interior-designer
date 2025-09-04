 <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about__text">
                        <div class="section-title">
                            <span>{{$about->title}}</span>
                            <h2>{{$about->main_heading}}</h2>
                        </div>
                        <div class="about__para__text">
                            <p>{{$about->para1}}</p>
                            <p>{{$about->para2}}</p>
                        </div>
                        <a href="{{route('about.show')}}" class="primary-btn normal-btn">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__pic">
                        <div class="about__pic__inner">
                            <img src="{{ asset('storage/' . $about->image) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->