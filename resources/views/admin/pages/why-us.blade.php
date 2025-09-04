@extends('admin.layouts.master')
@section('title', 'Why_Us')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg border-0 animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Update Why Us Section</h4>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <strong>✅ Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('whyus-content.update', $whyUs->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Image Upload -->
                <div class="mb-4 text-center">
                    @if($whyUs->image)
                        <img src="{{ asset('storage/' . $whyUs->image) }}" alt="Current Why Us Image" class="img-fluid mb-2 rounded shadow" style="max-height: 200px;" id="imagePreview">
                    @else
                        <img src="https://via.placeholder.com/800x600" alt="Placeholder" class="img-fluid mb-2 rounded shadow" style="max-height: 200px;" id="imagePreview">
                    @endif
                    <div class="form-group">
                        <label for="image" class="form-label">Change Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <small class="text-muted">Recommended size: 800x600px</small>
                    </div>
                </div>

                <!-- Title -->
                <div class="form-group mb-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $whyUs->title }}" required>
                </div>

                <!-- Heading -->
                <div class="form-group mb-4">
                    <label for="heading" class="form-label">Heading</label>
                    <input type="text" class="form-control" name="heading" id="heading" value="{{ $whyUs->main_heading }}" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-lg animate__animated animate__pulse animate__infinite">Update Why Us Section</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-hide alert after 3 seconds
    setTimeout(() => {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
        }
    }, 3000);

    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
        }
        
        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection