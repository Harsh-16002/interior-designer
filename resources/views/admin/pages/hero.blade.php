@extends('admin.layouts.master')

@section('title', 'Hero Section')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Hero Section</h2>
        <button type="button" class="btn btn-primary" id="addHeroBtn">
            <i class="fas fa-plus"></i> Add New Hero
        </button>
    </div>

    <!-- Alert Messages -->
    <div id="alertMsg"></div>

    <!-- Hero Form (Hidden by default, inside a card) -->
    <div id="heroFormWrapper" class="d-none mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0" id="formTitle">Add Hero</h5>
                <button type="button" class="btn btn-sm btn-outline-danger" id="cancelBtn">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
            <div class="card-body">
                <form id="heroForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="hero_id">

                    <div class="row">
                        <!-- Image Upload -->
                        <div class="col-md-5 mb-3">
                            <div class="border rounded p-3 h-100">
                                <label class="form-label fw-bold">Hero Image</label>
                                <input type="file" name="slide_image" class="form-control mb-2" id="imageUpload">
                                <small class="text-muted">Recommended: 1200x800px</small>
                                <div id="imagePreview" class="mt-3 text-center"></div>
                            </div>
                        </div>

                        <!-- Text Fields -->
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Heading</label>
                                <input type="text" name="heading" id="heading" class="form-control" required>
                            </div>

                            <h6 class="fw-bold mt-4 mb-3">Social Media Links</h6>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                                        <input type="url" name="fblink" id="fblink" class="form-control" placeholder="Facebook URL">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                        <input type="url" name="instralink" id="instralink" class="form-control" placeholder="Instagram URL">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                        <input type="url" name="twitterlink" id="twitterlink" class="form-control" placeholder="Twitter URL">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fab fa-linkedin-in"></i></span>
                                        <input type="url" name="linkdinlink" id="linkdinlink" class="form-control" placeholder="LinkedIn URL">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-success" id="formSubmitBtn">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Clear
                        </button>
                        <button type="button" class="btn btn-danger" id="cancelBtnFooter">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-3">Hero Entries</h5>
            <table class="table table-bordered table-hover align-middle" id="heroTable">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Heading</th>
                        <th>Image</th>
                        <th>Facebook</th>
                        <th>Instagram</th>
                        <th>Twitter</th>
                        <th>LinkedIn</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- AJAX Data Will Be Loaded Here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    #imagePreview img {
        max-width: 100%;
        max-height: 180px;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function(){

    loadData();

    // Show form for new entry
    $("#addHeroBtn").click(function () {
        $("#heroForm")[0].reset();
        $("#hero_id").val('');
        $("#imagePreview").empty();
        $("#formSubmitBtn").text("Save");
        $("#formTitle").text("Add Hero");
        $("#heroFormWrapper").removeClass("d-none");
    });

    // Hide form (cancel buttons)
    $("#cancelBtn, #cancelBtnFooter").click(function(){
        $("#heroFormWrapper").addClass("d-none");
    });

    // Load table data
    function loadData(){
        $.ajax({
            url: "{{ url('admin/hero-content') }}",
            type: "GET",
            dataType: "json",
            success: function(response){
                let rows = '';
                response.data.forEach(row => {
                    rows += `
                        <tr>
                            <td>${row.id}</td>
                            <td>${row.heading}</td>
                            <td><img src="/storage/${row.slide_image}" width="60" class="rounded shadow-sm"></td>
                            <td><a href="${row.fblink}" target="_blank" class="text-primary"><i class="fab fa-facebook-f"></i></a></td>
                            <td><a href="${row.instralink}" target="_blank" class="text-danger"><i class="fab fa-instagram"></i></a></td>
                            <td><a href="${row.twitterlink}" target="_blank" class="text-info"><i class="fab fa-twitter"></i></a></td>
                            <td><a href="${row.linkdinlink}" target="_blank" class="text-primary"><i class="fab fa-linkedin-in"></i></a></td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtn" data-id="${row.id}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-id="${row.id}"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    `;
                });
                $('#heroTable tbody').html(rows);
            }
        });
    }

    // Image preview
    $('#imageUpload').change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').html('<img src="' + e.target.result + '">');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Form submit
    $("#heroForm").submit(function (e){
        e.preventDefault();
        let formData = new FormData(this);
        let id = $("#hero_id").val();
        let url = id ? "{{ url('admin/hero-content') }}/" + id : "{{ route('hero-content.store') }}";
        if (id) formData.append('_method', 'PUT');

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#formSubmitBtn").prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');
            },
            complete: function() {
                $("#formSubmitBtn").prop('disabled', false).text(id ? 'Update' : 'Save');
            },
            success: function (response) {
                $("#alertMsg").html(`<div class="alert alert-success alert-dismissible fade show">${response.message || 'Saved successfully!'}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`);
                $("#heroForm")[0].reset();
                $("#imagePreview").empty();
                $("#hero_id").val('');
                loadData();
                $("#heroFormWrapper").addClass("d-none"); // hide form
                setTimeout(() => $("#alertMsg").empty(), 3000);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors;
                let errorHtml = '<div class="alert alert-danger alert-dismissible fade show"><ul>';
                if (errors) {
                    Object.values(errors).forEach(err => {
                        errorHtml += `<li>${err}</li>`;
                    });
                } else {
                    errorHtml += '<li>Something went wrong. Please try again.</li>';
                }
                errorHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
                $("#alertMsg").html(errorHtml);
            }
        });
    });

    // Edit button click
    $(document).on('click', '.editBtn', function(){
        let id = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/hero-content') }}/" + id + "/edit",
            type: "GET",
            success: function(data){
                $("#hero_id").val(data.id);
                $("#heading").val(data.heading);
                $("#fblink").val(data.fblink);
                $("#instralink").val(data.instralink);
                $("#twitterlink").val(data.twitterlink);
                $("#linkdinlink").val(data.linkdinlink);
                
                if(data.slide_image) {
                    $("#imagePreview").html(`<img src="/storage/${data.slide_image}">`);
                } else {
                    $("#imagePreview").empty();
                }

                $("#formSubmitBtn").text("Update");
                $("#formTitle").text("Edit Hero");
                $("#heroFormWrapper").removeClass("d-none");
            }
        });
    });

    // Delete button click
    $(document).on('click', '.deleteBtn', function(){
        let id = $(this).data('id');
        if(confirm('Are you sure you want to delete this hero section?')) {
            $.ajax({
                url: "{{ url('admin/hero-content') }}/" + id,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function(response) {
                    $("#alertMsg").html(`<div class="alert alert-success alert-dismissible fade show">${response.message || 'Deleted successfully!'}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`);
                    loadData();
                    setTimeout(() => $("#alertMsg").empty(), 3000);
                },
                error: function() {
                    $("#alertMsg").html(`<div class="alert alert-danger alert-dismissible fade show">Failed to delete hero section
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`);
                }
            });
        }
    });
});
</script>
@endpush
