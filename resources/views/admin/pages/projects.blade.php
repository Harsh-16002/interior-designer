@extends('admin.layouts.master')

@section('title', 'Projects')

@section('content')
<div class="container mt-4">
    <h2>Projects</h2>

    <!-- Add New Project Button -->
    <button type="button" class="btn btn-primary mb-3" id="addProjectBtn">Add New Project</button>

    <!-- Alert Messages -->
    <div id="alertMsg"></div>

    <!-- Project Form (Hidden by Default) -->
    <div id="projectFormContainer" class="mb-4" style="display:none;">
        <form id="projectForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="project_id">
            
            <div class="row">
                <!-- Image Upload -->
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <label class="form-label fw-bold">Project Image</label>
                            <input type="file" name="image" class="form-control mb-2" id="projectImageUpload">
                            <small class="text-muted">Recommended size: 800x600px. Leave blank to keep existing image.</small>
                            <div id="projectImagePreview" class="mt-2 text-center"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Text Fields -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Project Title</label>
                                <input type="text" name="title" id="projectTitle" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" name="category" id="projectCategory" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="mt-3">
                <button type="submit" class="btn btn-success" id="formSubmitBtn">Save</button>
                <button type="reset" class="btn btn-secondary" id="formResetBtn">Clear</button>
                <button type="button" class="btn btn-danger" id="formCancelBtn">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <table class="table table-sm table-bordered" id="projectTable">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- AJAX Data Will Be Loaded Here -->
        </tbody>
    </table>
</div>
@endsection

@push('styles')
<style>
    #projectImagePreview img {
        max-width: 100%;
        max-height: 150px;
        border-radius: 4px;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function(){

    // Load initial data
    loadProjects();

    // Show form when clicking "Add New Project"
    $("#addProjectBtn").click(function () {
        $("#projectForm")[0].reset();
        $("#project_id").val('');
        $("#projectImagePreview").empty();
        $("#formSubmitBtn").text("Save");
        $("#projectFormContainer").slideDown(); // show form
    });

    // Cancel button hides form
    $("#formCancelBtn").click(function(){
        $("#projectFormContainer").slideUp();
        $("#projectForm")[0].reset();
        $("#project_id").val('');
        $("#projectImagePreview").empty();
    });

    // Load table data
    function loadProjects(){
        $.ajax({
            url: "{{ route('projects-content.index') }}",
            type: "GET",
            dataType: "json",
            success: function(response){
                let rows = '';
                response.data.forEach(row => {
                    rows += `
                        <tr>
                            <td>${row.id}</td>
                            <td><img src="/storage/${row.image}" width="60" class="img-thumbnail"></td>
                            <td>${row.title}</td>
                            <td>${row.category}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editProjectBtn" data-id="${row.id}">Edit</button>
                                <button class="btn btn-sm btn-danger deleteProjectBtn" data-id="${row.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#projectTable tbody').html(rows);
            }
        });
    }

    // Image preview
    $('#projectImageUpload').change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#projectImagePreview').html('<img src="' + e.target.result + '" class="img-thumbnail">');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Form submit
    $("#projectForm").submit(function (e){
        e.preventDefault();
        let formData = new FormData(this);
        let id = $("#project_id").val();
        let url = id ? "{{ url('admin/projects-content') }}/" + id : "{{ route('projects-content.store') }}";
        if(id) formData.append('_method', 'PUT');

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#formSubmitBtn").prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Loading...');
            },
            complete: function() {
                $("#formSubmitBtn").prop('disabled', false).text(id ? 'Update' : 'Save');
            },
            success: function (response) {
                $("#alertMsg").html(`<div class="alert alert-success alert-dismissible fade show">${response.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`);
                $("#projectForm")[0].reset();
                $("#project_id").val('');
                $("#projectImagePreview").empty();
                $("#projectFormContainer").slideUp(); // hide form after submit
                loadProjects();
                setTimeout(() => $("#alertMsg").empty(), 3000);
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                let errorHtml = '<div class="alert alert-danger alert-dismissible fade show"><ul>';
                if(errors){
                    Object.values(errors).forEach(err => errorHtml += `<li>${err}</li>`);
                } else {
                    errorHtml += '<li>Something went wrong. Please try again.</li>';
                }
                errorHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
                $("#alertMsg").html(errorHtml);
            }
        });
    });

    // Edit button click
    $(document).on('click', '.editProjectBtn', function(){
        let id = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/projects-content') }}/" + id + "/edit",
            type: "GET",
            success: function(data){
                $("#project_id").val(data.id);
                $("#projectTitle").val(data.title);
                $("#projectCategory").val(data.category);

                if(data.image){
                    $("#projectImagePreview").html(`<img src="/storage/${data.image}" class="img-thumbnail">`);
                } else {
                    $("#projectImagePreview").empty();
                }

                $("#formSubmitBtn").text("Update");
                $("#projectFormContainer").slideDown(); // show form when editing
            }
        });
    });

    // Delete button click
    $(document).on('click', '.deleteProjectBtn', function(){
        let id = $(this).data('id');
        let $button = $(this);
        if(confirm('Are you sure you want to delete this project?')){
            $.ajax({
                url: "{{ url('admin/projects-content') }}/" + id,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                beforeSend: function() {
                    $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Deleting...');
                },
                success: function(response){
                    $("#alertMsg").html(`<div class="alert alert-success alert-dismissible fade show">${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`);
                    loadProjects();
                    setTimeout(() => $("#alertMsg").empty(), 3000);
                },
                error: function(xhr){
                    let errorMsg = xhr.responseJSON?.message || 'Failed to delete project';
                    $("#alertMsg").html(`<div class="alert alert-danger alert-dismissible fade show">${errorMsg}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`);
                    $button.prop('disabled', false).text('Delete');
                }
            });
        }
    });
});
</script>
@endpush
