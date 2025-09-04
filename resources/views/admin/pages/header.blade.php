@extends('admin.layouts.master')
@section('title', 'Header')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg border-0 animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Update Header Section</h4>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <strong>✅ Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('header-content.update', $header->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Logo Upload -->
                <div class="mb-4 text-center">
                    @if($header->logo)
                        <img src="{{ asset('storage/' . $header->logo) }}" alt="Current Logo" class="img-fluid mb-2 rounded shadow" style="max-height: 100px;">
                    @endif
                    <div class="form-group">
                        <label for="logo" class="form-label">Change Logo</label>
                        <input type="file" class="form-control" name="logo" id="logo">
                        <small class="text-muted">Recommended size: 200x50px</small>
                    </div>
                </div>

                <!-- Text -->
                <div class="form-group mb-4">
                    <label for="text" class="form-label">Header Text</label>
                    <input type="text" class="form-control" name="text" id="text" value="{{ $header->text }}" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-lg animate__animated animate__pulse animate__infinite">Update Header</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
        }
    }, 3000);
</script>
@endsection