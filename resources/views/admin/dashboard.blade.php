@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<div id="ajax-content-area">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Stylish Centered Logo Text with Background -->
    <div class="dashboard-hero d-flex justify-content-center align-items-center mb-5" style="height: 50vh;">
        <div class="ekta-logo">
            Ekta <span>Interior</span> Studio
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .ekta-logo {
        font-family: 'Poppins', sans-serif;
        font-size: 4rem;
        font-weight: 900;
        background: linear-gradient(135deg, #ffffff, #e0e0e0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeIn 1.2s ease-in-out;
        text-align: center;
        letter-spacing: 2px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 2;
        padding: 1rem 2rem;
        border-radius: 10px;
        backdrop-filter: blur(5px);
        background-color: rgba(255, 255, 255, 0.1);
    }

    .ekta-logo span {
        background: linear-gradient(135deg, #f6c23e, #e83e8c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .ekta-logo {
            font-size: 2.5rem;
            padding: 0.8rem 1.5rem;
        }
    }
</style>
@endpush