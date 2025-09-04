@extends('admin.layouts.master')
@section('title', 'Contact')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg border-0 animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Update Contact Information</h4>
        </div>

        {{-- Success Message --}}
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show m-3 animate__animated animate__fadeInDown" role="alert">
            <strong>✅ Success!</strong> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('contact-content.update', $contact->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Phone -->
                <div class="form-group mb-4">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                           name="phone" id="phone" value="{{ old('phone', $contact->phone) }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="form-group mb-4">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" 
                              name="address" id="address" rows="3" required>{{ old('address', $contact->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" id="email" value="{{ old('email', $contact->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Map Embed Code -->
                <div class="form-group mb-4">
                    <label for="map" class="form-label">Map Embed Code</label>
                    <textarea class="form-control @error('map') is-invalid @enderror" 
                              name="map" id="map" rows="5" required>{{ old('map', $contact->map) }}</textarea>
                    <small class="text-muted">Paste the iframe code from Google Maps here</small>
                    @error('map')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-lg animate__animated animate__pulse animate__infinite">
                        Update Contact Info
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-hide alert after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        let alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show');
                alert.classList.add('fade');
            }, 3000);
        }
    });
</script>
@endsection