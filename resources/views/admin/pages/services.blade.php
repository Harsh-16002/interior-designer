@extends('admin.layouts.master')

@section('title', 'Services')

@section('content')
<div class="container-fluid mt-4">
    <h5>Services</h5>

    <!-- Add New Service Button -->
    <button class="btn btn-primary mb-3" id="addServiceBtn">
        <i class="fas fa-plus me-1"></i> Add New Service
    </button>

    <!-- Alert Messages -->
    <div id="alertMsg" class="mb-3"></div>

    <!-- Service Form (Hidden by Default) -->
    <div id="serviceFormContainer" style="display:none;">
        <form id="serviceForm" enctype="multipart/form-data" class="mb-4">
            @csrf
            <input type="hidden" name="id" id="service_id">

            <div class="row g-3">
                <div class="col-md-5">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <label class="form-label fw-bold mb-3">Service Image</label>
                            <div class="border-dashed rounded-3 p-3 text-center bg-light mb-3" id="serviceImagePreview">
                                <span class="text-muted">No image selected</span>
                            </div>
                            <input type="file" name="image" class="form-control" id="serviceImageUpload" accept="image/*">
                            <small class="text-muted mt-2">Recommended size: 800x600px. Max 2MB.</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Service Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="serviceTitle" class="form-control" placeholder="Enter service title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="serviceDescription" class="form-control" rows="5" placeholder="Enter detailed description" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit & Cancel Buttons -->
            <div class="mt-3">
                <button type="submit" class="btn btn-success" id="formSubmitBtn">
                    <i class="fas fa-save me-1"></i> Save
                </button>
                <button type="reset" class="btn btn-secondary" id="clearBtn">Clear</button>
                <button type="button" class="btn btn-danger" id="formCancelBtn">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Services Table -->
    <div class="table-responsive">
        <table class="table table-hover" id="serviceTable">
            <thead class="table-light">
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Image</th>
                    <th width="20%">Title</th>
                    <th width="45%">Description</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    .border-dashed { border: 2px dashed #dee2e6; }
    #serviceImagePreview {
        min-height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #serviceImagePreview img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 4px;
    }
    .description-cell {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card { border-radius: 0.5rem; }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function(){

    // Load services data
    function loadServices(){
        $.ajax({
            url: "{{ route('services-content.index') }}",
            type: "GET",
            dataType: "json",
            success: function(response){
                let rows = '';
                response.data.forEach(row => {
                    let shortDesc = row.description.length > 100 
                        ? row.description.substring(0, 100) + '...' 
                        : row.description;
                    rows += `
                        <tr>
                            <td>${row.id}</td>
                            <td><img src="/storage/${row.image}" width="80" class="img-thumbnail"></td>
                            <td>${row.title}</td>
                            <td class="description-cell">${shortDesc}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editServiceBtn" data-id="${row.id}">Edit</button>
                                <button class="btn btn-sm btn-danger deleteServiceBtn" data-id="${row.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#serviceTable tbody').html(rows);
            }
        });
    }

    // Reset form
    function resetForm() {
        $('#serviceForm')[0].reset();
        $('#service_id').val('');
        $('#serviceImagePreview').html('<span class="text-muted">No image selected</span>');
        $('#serviceImageUpload').val('');
        $('#formSubmitBtn').html('<i class="fas fa-save me-1"></i> Save');
    }

    // Add New Service button shows form
    $('#addServiceBtn').click(function(){
        resetForm();
        $('#serviceFormContainer').slideDown();
    });

    // Cancel button hides form
    $('#formCancelBtn').click(function(){
        $('#serviceFormContainer').slideUp();
        resetForm();
    });

    // Clear button
    $('#clearBtn').click(resetForm);

    // Image preview
    $('#serviceImageUpload').change(function() {
        if (this.files && this.files[0]) {
            if (this.files[0].size > 2097152) { // 2MB
                alert('File size exceeds 2MB limit.');
                $(this).val('');
                return;
            }
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#serviceImagePreview').html(`<img src="${e.target.result}" class="img-fluid">`);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Form submission (Add / Update)
    $('#serviceForm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        let id = $('#service_id').val();
        let url = id ? "{{ url('admin/services-content') }}/" + id : "{{ route('services-content.store') }}";
        if(id) formData.append('_method', 'PUT');

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#formSubmitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');
            },
            complete: function() {
                $('#formSubmitBtn').prop('disabled', false).html(id ? '<i class="fas fa-save me-1"></i> Update' : '<i class="fas fa-save me-1"></i> Save');
            },
            success: function(response){
                resetForm();
                $('#serviceFormContainer').slideUp(); // hide after submit
                loadServices();
                $('#alertMsg').html(`<div class="alert alert-success alert-dismissible fade show">${response.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`);
                setTimeout(() => $('#alertMsg').empty(), 3000);
            },
            error: function(xhr){
                let errors = xhr.responseJSON?.errors;
                let errorHtml = '<div class="alert alert-danger alert-dismissible fade show"><ul>';
                if(errors){
                    Object.values(errors).forEach(err => errorHtml += `<li>${err}</li>`);
                } else {
                    errorHtml += '<li>Something went wrong. Please try again.</li>';
                }
                errorHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
                $('#alertMsg').html(errorHtml);
            }
        });
    });

    // Edit service
    $(document).on('click', '.editServiceBtn', function(){
        let id = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/services-content') }}/" + id + "/edit",
            type: "GET",
            success: function(data){
                resetForm();
                $('#service_id').val(data.id);
                $('#serviceTitle').val(data.title);
                $('#serviceDescription').val(data.description);
                if(data.image){
                    $('#serviceImagePreview').html(`<img src="/storage/${data.image}" class="img-fluid">`);
                }
                $('#formSubmitBtn').html('<i class="fas fa-save me-1"></i> Update');
                $('#serviceFormContainer').slideDown(); // show form when editing
            }
        });
    });

    // Delete service
    $(document).on('click', '.deleteServiceBtn', function(){
        if(confirm('Are you sure you want to delete this service?')){
            let id = $(this).data('id');
            $.ajax({
                url: "{{ url('admin/services-content') }}/" + id,
                type: "DELETE",
                data: {_token: "{{ csrf_token() }}"},
                success: function(response){
                    loadServices();
                    $('#alertMsg').html(`<div class="alert alert-success alert-dismissible fade show">${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`);
                    setTimeout(() => $('#alertMsg').empty(), 3000);
                }
            });
        }
    });

    // Initial load
    loadServices();
});
</script>
@endpush
