@extends('admin.layouts.master')

@section('title', 'Testimonials')

@section('content')
<div class="container mt-4">
    <h2>Testimonials</h2>

    <!-- Add New Testimonial Button -->
    <button class="btn btn-primary mb-3" id="addTestimonialBtn">Add New Testimonial</button>

    <!-- Alert Messages -->
    <div id="alertMsg" class="mb-3"></div>

    <!-- Testimonial Form (Hidden by Default) -->
    <div id="testimonialFormContainer" style="display:none;">
        <form id="testimonialForm" enctype="multipart/form-data" class="mb-4">
            @csrf
            <input type="hidden" name="id" id="testimonial_id">

            <div class="row g-3">
                <!-- Image Upload -->
                <div class="col-md-4">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <label class="form-label fw-bold">Image</label>
                            <div class="border-dashed rounded-3 p-3 mb-2" id="testimonialImagePreview">
                                <span class="text-muted">No image selected</span>
                            </div>
                            <input type="file" name="image" id="testimonialImage" class="form-control" accept="image/*">
                            <small class="text-muted">Recommended size: 200x200px. Max 2MB.</small>
                        </div>
                    </div>
                </div>

                <!-- Text Fields -->
                <div class="col-md-8">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" id="testimonialName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Position</label>
                                <input type="text" name="position" id="testimonialPosition" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Review</label>
                                <textarea name="review" id="testimonialReview" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="mt-3">
                <button type="submit" class="btn btn-success" id="formSubmitBtn"><i class="fas fa-save me-1"></i> Save</button>
                <button type="reset" class="btn btn-secondary" id="clearBtn">Clear</button>
                <button type="button" class="btn btn-danger" id="formCancelBtn">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="table-responsive mt-3">
        <table class="table table-sm table-bordered" id="testimonialTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th style="width: 30%">Review</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Full Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Full Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="reviewModalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .border-dashed { border: 2px dashed #dee2e6; min-height: 150px; display: flex; align-items: center; justify-content: center; }
    #testimonialImagePreview img { max-width: 100%; max-height: 150px; border-radius: 4px; }
</style>
@endpush

@push('scripts')
<script>
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

function escapeHtml(unsafe) {
    return unsafe.replace(/&/g, "&amp;")
                 .replace(/</g, "&lt;")
                 .replace(/>/g, "&gt;")
                 .replace(/"/g, "&quot;")
                 .replace(/'/g, "&#039;");
}

$(document).ready(function(){

    // Load testimonials
    function loadTestimonials(){
        $.get("{{ route('testimonials-content.index') }}", function(response){
            let rows = '';
            response.data.forEach(row => {
                rows += `
                    <tr>
                        <td>${row.id}</td>
                        <td><img src="/storage/${row.image}" width="60" class="img-thumbnail"></td>
                        <td>${escapeHtml(row.name)}</td>
                        <td>${escapeHtml(row.position)}</td>
                        <td>
                            <div class="review-content" data-full-review="${escapeHtml(row.review)}">
                                ${escapeHtml(row.review)}
                            </div>
                            ${row.review.length > 150 ? '<button class="btn btn-sm btn-link p-0 read-more-btn">Read more</button>' : ''}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning editTestimonialBtn" data-id="${row.id}">Edit</button>
                            <button class="btn btn-sm btn-danger deleteTestimonialBtn" data-id="${row.id}">Delete</button>
                        </td>
                    </tr>
                `;
            });
            $('#testimonialTable tbody').html(rows);

            $('.read-more-btn').click(function() {
                const reviewContent = $(this).siblings('.review-content').data('full-review');
                $("#reviewModalBody").text(reviewContent);
                $('#reviewModal').modal('show');
            });
        });
    }

    // Reset form
    function resetForm() {
        $('#testimonialForm')[0].reset();
        $('#testimonial_id').val('');
        $('#testimonialImagePreview').html('<span class="text-muted">No image selected</span>');
        $('#formSubmitBtn').html('<i class="fas fa-save me-1"></i> Save');
    }

    // Show form on Add
    $('#addTestimonialBtn').click(function(){
        resetForm();
        $('#testimonialFormContainer').slideDown();
    });

    // Cancel button hides form
    $('#formCancelBtn').click(function(){
        $('#testimonialFormContainer').slideUp();
        resetForm();
    });

    $('#clearBtn').click(resetForm);

    // Image preview
    $('#testimonialImage').change(function(){
        if (this.files && this.files[0]) {
            if(this.files[0].size > 2097152) { alert('File size exceeds 2MB'); $(this).val(''); return; }
            var reader = new FileReader();
            reader.onload = function(e){ $('#testimonialImagePreview').html('<img src="' + e.target.result + '" class="img-thumbnail">'); }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Submit form (Add/Update)
    $('#testimonialForm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        let id = $('#testimonial_id').val();
        let url = id ? "{{ url('admin/testimonials-content') }}/" + id : "{{ route('testimonials-content.store') }}";
        if(id) formData.append('_method','PUT');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(){ $('#formSubmitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...'); },
            complete: function(){ $('#formSubmitBtn').prop('disabled', false).html(id ? '<i class="fas fa-save me-1"></i> Update' : '<i class="fas fa-save me-1"></i> Save'); },
            success: function(res){
                resetForm();
                $('#testimonialFormContainer').slideUp();
                loadTestimonials();
            },
            error: function(){ alert('Error saving testimonial'); }
        });
    });

    // Edit testimonial
    $(document).on('click','.editTestimonialBtn', function(){
        let id = $(this).data('id');
        $.get("{{ url('admin/testimonials-content') }}/" + id + "/edit", function(data){
            $('#testimonial_id').val(data.id);
            $('#testimonialName').val(data.name);
            $('#testimonialPosition').val(data.position);
            $('#testimonialReview').val(data.review);
            if(data.image) $('#testimonialImagePreview').html('<img src="/storage/'+data.image+'" class="img-thumbnail">');
            else $('#testimonialImagePreview').html('<span class="text-muted">No image selected</span>');
            $('#formSubmitBtn').html('<i class="fas fa-save me-1"></i> Update');
            $('#testimonialFormContainer').slideDown();
        });
    });

    // Delete testimonial
    $(document).on('click','.deleteTestimonialBtn', function(){
        if(confirm('Are you sure you want to delete this testimonial?')){
            let id = $(this).data('id');
            $.ajax({
                url: "{{ url('admin/testimonials-content') }}/" + id,
                type: "POST",
                data: {_method: 'DELETE'},
                success: function(){ loadTestimonials(); },
                error: function(){ alert('Error deleting testimonial'); }
            });
        }
    });

    // Initial load
    loadTestimonials();
});
</script>
@endpush
