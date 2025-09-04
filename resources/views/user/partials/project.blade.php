<!-- Project Section Begin -->
<section class="project">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <span>Our works</span>
                    <h2>Latest projects</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="project__slider owl-carousel">
                @foreach($projects as $project)
                <div class="col-lg-3">
                    <div class="project__slider__item set-bg" data-setbg="{{ asset('storage/'.$project->image) }}">
                        <div class="project__slider__item__hover">
                            <span>{{ $project->category }}</span>
                            <h5>{{ $project->title }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Project Section End -->