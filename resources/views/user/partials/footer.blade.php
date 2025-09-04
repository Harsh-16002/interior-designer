<!-- Footer Section Begin -->
<footer class="footer set-bg" data-setbg="img/footer-bg.jpg">
    <div class="container">
        <div class="footer__top">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="footer__top__text">
                        <h2>Ready To Work With Us?</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer__top__newslatter">
                        <form id="subscriptionForm">
                            @csrf
                            <input type="email" name="email" id="subscribe_email" placeholder="Enter your email..." required>
                            <button type="submit"><i class="fa fa-send"></i></button>
                        </form>
                        <div id="subscriptionMessage" class="mt-2 text-white" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <img src="{{ asset('storage/' . $values->logo) }}" alt="Logo" style="height: 150px;">
                    </div>
                    <p>{!! nl2br(e($contact->address)) !!}</p>
                    <ul>
                        <li>{{ $contact->email }}</li>
                        <li>{{ $contact->phone }}</li>
                    </ul>
                    <div class="footer__social">
                        <a href="{{ $footer->fblink }}"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $footer->twitterlink }}"><i class="fa fa-twitter"></i></a>
                        <a href="{{ $footer->instralink }}"><i class="fa fa-instagram"></i></a>
                        <a href="{{ $footer->linkdinlink }}"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Company</h6>
                    <ul>
                        <li><a href="{{route('about.show')}}">About Us</a></li>
                        <li><a href="{{route('projects.show')}}">Our Works</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Services</h6>
                    <ul>
                        <li><a href="#">Architecture</a></li>
                        <li><a href="#">Interior Design</a></li>
                        <li><a href="#">Exterior Design</a></li>
                        <li><a href="#">Planning</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="footer__address">
                    <h6>Get In Touch</h6>
                    <p>{!! nl2br(e($contact->address)) !!}</p>
                    <ul>
                        <li>{{ $contact->email }}</li>
                        <li>{{ $contact->phone }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="copyright__text">
                        <p>Copyright © <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | By Harsh</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="copyright__widget">
                        <a href="#">Terms of use</a>
                        <a href="#">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Add this script section at the bottom of your layout file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#subscriptionForm').on('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        $('#subscriptionMessage').text('Processing...').show();
        
        $.ajax({
            url: "{{ route('subscribe') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    $('#subscriptionForm')[0].reset();
                    $('#subscriptionMessage').removeClass('text-danger').addClass('text-success').text(response.message).show().delay(3000).fadeOut();
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                if(errors && errors.email) {
                    $('#subscriptionMessage').removeClass('text-success').addClass('text-danger').text(errors.email[0]).show().delay(3000).fadeOut();
                } else {
                    $('#subscriptionMessage').removeClass('text-success').addClass('text-danger').text('An error occurred. Please try again.').show().delay(3000).fadeOut();
                }
            }
        });
    });
});
</script>

<style>
    #subscriptionMessage {
        padding: 5px 10px;
        border-radius: 4px;
        background-color: rgba(0,0,0,0.5);
        font-size: 14px;
    }
    .text-success {
        color: #28a745;
    }
    .text-danger {
        color: #dc3545;
    }
</style>