<!-- Call To Action Section Begin -->
    <section class="callto spad set-bg" data-setbg="{{ asset('storage/' . $whyUs->image) }}">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="callto__text">
                        <span>{{$whyUs->title}}</span>
                        <h2>{{$whyUs->main_heading}}
                        </h2>
                        <a href="{{route('contact.show')}}" class="primary-btn">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action Section End -->