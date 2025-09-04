@extends('user.layout')

@section('content')
@include('user.partials.header', ['values' => $values])

<!-- Breadcrumb Section -->
<section class="breadcrumb-option set-bg" data-setbg="{{ asset('img/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Our Portfolio</h2>
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}">Home</a>
                        <span>Projects</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="projects spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <div class="section-title">
                    <span>Our Works</span>
                    <h2>Latest Projects</h2>
                    <p>Explore our collection of completed projects</p>
                </div>
            </div>
        </div>

        <!-- Projects Grid - Strict 3 Columns -->
        <div class="row">
            @foreach($projects as $project)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="project__item">
                    <div class="project__image">
                        <img src="{{ asset('storage/'.$project->image) }}" 
                             alt="{{ $project->title }}" 
                             class="img-fluid w-100"
                             style="height: 280px; object-fit: cover;">
                    </div>
                    <div class="project__content text-center mt-3">
                        <h5>{{ $project->title }}</h5>
                        @if($project->category)
                        <span class="project__category">{{ $project->category }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination with Smaller Arrows -->
        @if($projects->hasPages())
        <div class="row">
            <div class="col-lg-12">
                <div class="project__pagination">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($projects->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $projects->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                            @if ($page == $projects->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($projects->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $projects->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

@include('user.partials.footer', ['values' => $values, 'footer' => $footer])

@push('styles')
<style>
    /* Project Item Styles */
    .project__item {
        transition: all 0.3s ease;
    }
    
    .project__image {
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .project__image img {
        transition: transform 0.5s ease;
    }
    
    .project__item:hover .project__image img {
        transform: scale(1.05);
    }
    
    .project__content h5 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #222;
    }
    
    .project__category {
        display: inline-block;
        font-size: 13px;
        color: #e99c2e;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    /* Pagination Styles - Smaller Arrows */
    .project__pagination {
        margin-top: 50px;
    }
    
    .project__pagination .pagination {
        justify-content: center;
    }
    
    .project__pagination .page-item.active .page-link {
        background-color: #e99c2e;
        border-color: #e99c2e;
        color: white;
    }
    
    .project__pagination .page-link {
        color: #555;
        border: 1px solid #ddd;
        padding: 6px 12px;
        margin: 0 2px;
        font-size: 14px;
        min-width: 32px;
        text-align: center;
    }
    
    .project__pagination .page-link:hover {
        background-color: #f5f5f5;
    }
    
    /* Make arrows smaller */
    .project__pagination .page-link[rel="prev"],
    .project__pagination .page-link[rel="next"] {
        font-size: 12px;
        padding: 6px 10px;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .project__image img {
            height: 240px;
        }
    }
    
    @media (max-width: 767px) {
        .project__image img {
            height: 300px;
        }
    }
</style>
@endpush
@endsection