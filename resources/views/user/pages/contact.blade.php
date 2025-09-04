@extends('user.layout')

@section('content')
@include('user.partials.header', ['values' => $values])

<!-- Breadcrumb Section -->
<section class="breadcrumb-option set-bg" data-setbg="{{ asset('img/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Contact</h2>
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}">Home</a>
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="projects spad">
    <div class="container">
        <!-- Your existing projects grid content here -->
    </div>
</section>

<!-- Contact Section -->
<section class="contact spad pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Details</h2>
                    </div>
                    <p>As you might expect of a company that began as a high-end interiors contractor, we pay strict attention to our client communication.</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Phone Number -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="contact__widget__item">
                    <div class="contact__widget__item__icon">
                        <img src="{{ asset('img/contact/ci-1.png') }}" alt="Phone icon">
                    </div>
                    <div class="contact__widget__item__text">
                        <h5>Phone Number</h5>
                        <span>{{$contact->phone}}</span>
                    </div>
                </div>
            </div>
            
            <!-- Email Address -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="contact__widget__item">
                    <div class="contact__widget__item__icon">
                        <img src="{{ asset('img/contact/ci-2.png') }}" alt="Email icon">
                    </div>
                    <div class="contact__widget__item__text">
                        <h5>Email Address</h5>
                        <span>{{$contact->email}}</span>
                    </div>
                </div>
            </div>
            
            <!-- Office Location -->
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="contact__widget__item last__item">
                    <div class="contact__widget__item__icon">
                        <img src="{{ asset('img/contact/ci-3.png') }}" alt="Location icon">
                    </div>
                    <div class="contact__widget__item__text">
                        <h5>Office Location</h5>
                        <span>{{$contact->address}}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Google Map -->
        <div class="map mb-5">
            <iframe
                src="{{$contact->map}}"
                height="460" style="border:0; width:100%;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        
   
</section>

@include('user.partials.footer', ['values' => $values, 'footer' => $footer])
@endsection

@push('styles')
<style>
    /* Contact Section Styles */
    .contact__widget__item {
        display: flex;
        align-items: center;
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .contact__widget__item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .contact__widget__item__icon {
        margin-right: 20px;
    }
    
    .contact__widget__item__icon img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }
    
    .contact__widget__item__text h5 {
        font-size: 18px;
        margin-bottom: 5px;
        color: #222;
    }
    
    .contact__widget__item__text span {
        color: #666;
        font-size: 15px;
    }
    
    .contact__form input,
    .contact__form textarea {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        border: 1px solid #eee;
        border-radius: 4px;
        font-size: 14px;
    }
    
    .contact__form textarea {
        height: 150px;
        resize: vertical;
    }
    
    .site-btn {
        background: #e99c2e;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    
    .site-btn:hover {
        background: #d18c25;
    }
</style>
@endpush