@extends('user.layout')

@section('content')
@include('user.partials.header', ['values' => $values])


<!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>About Us</h2>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>About Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- About Page Section Begin -->
    <section class="about-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="about__text about__page__text">
                        <div class="section-title">
                            <span>who are we</span>
                            <h2>About Us</h2>
                        </div>
                        <div class="about__para__text">
                            <p>As you might expect of a company that began as a high-end interiors contractor.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="about__page__services">
                        <div class="about__page__services__text">
                            <p>Metasurfaces are generally designed by placing scatterers in periodic or pseudo-periodic
                                grids. We propose and discuss design rules for functional metasurfaces with randomly
                            placed. Anisotropic elements that randomly sample. Quisque sit amet nisl ante.</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="services__item">
                                    <img src="img/services/services-5.png" alt="">
                                    <h4>Our Mission</h4>
                                    <p>As you might expect of a company that began as a high-end interiors contractor,
                                    we pay strict attention. Anisotropic elements that randomly sample.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="services__item">
                                    <img src="img/services/services-6.png" alt="">
                                    <h4>Our Vision</h4>
                                    <p>Our commitment to exceptional quality has never wavered. To day ranks as one of
                                        the most highly-regarded construction. Anisotropic elements that randomly
                                    sample.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Page Section End -->


@include('user.partials.footer', ['values' => $values, 'footer' => $footer])