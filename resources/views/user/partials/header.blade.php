<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('storage/' . $values->logo) }}" alt="Logo" style="height: 150px;">
                    </a>
                </div>

            </div>
            <div class="col-lg-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{route('projects.show')}}">Projects</a></li>
                        <li><a href="{{route('about.show')}}">About</a></li>
                        <li><a href="{{route('contact.show')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__widget">
                    <span>{{$values->text}}</span>
                    <h4>{{$values->phone}}</h4>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
