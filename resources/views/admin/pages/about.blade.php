@extends('admin.layouts.master')
@section('title', 'About')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg border-0 animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Update About Section</h4>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <strong>✅ Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('about-content.update', $about->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Image Upload -->
                <div class="mb-4 text-center">
                    @if($about->image)
                        <img src="{{ asset('storage/' . $about->image) }}" alt="Current About Image" class="img-fluid mb-2 rounded shadow" style="max-height: 200px;">
                    @endif
                    <div class="form-group">
                        <label for="image" class="form-label">Change About Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <small class="text-muted">Recommended size: 800x600px</small>
                    </div>
                </div>

             
                <!-- Title -->
                <div class="form-group mb-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $about->title }}" required>
                </div>

                   <!-- Main Heading -->
                <div class="form-group mb-4">
                    <label for="main_heading" class="form-label">Main Heading</label>
                    <input type="text" class="form-control" name="main_heading" id="main_heading" value="{{ $about->main_heading }}" required>
                </div>


                <!-- Paragraph 1 -->
                <div class="form-group mb-4">
                    <label for="para1" class="form-label">Paragraph 1</label>
                    <textarea class="form-control" name="para1" id="para1" rows="3" required>{{ $about->para1 }}</textarea>
                </div>

                <!-- Paragraph 2 -->
                <div class="form-group mb-4">
                    <label for="para2" class="form-label">Paragraph 2</label>
                    <textarea class="form-control" name="para2" id="para2" rows="3">{{ $about->para2 }}</textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-lg animate__animated animate__pulse animate__infinite">Update About Section</button>
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
        const preview = document.querySelector('.card-body img');
        const file = e.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function() {
            preview.src = reader.result;
        }
        
        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection