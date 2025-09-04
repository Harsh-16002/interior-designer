@extends('admin.layouts.master')

@section('title', 'Team Members')

@section('content')
<div class="container mt-4">
    <h2>Team Members</h2>

    <!-- Add New Team Member Button -->
    <button class="btn btn-primary mb-3" id="addTeamBtn">Add New Team Member</button>

    <!-- Alert Messages -->
    <div id="alertMsg" class="mb-3"></div>

    <!-- Team Member Form (Hidden by Default) -->
    <div id="teamFormContainer" style="display:none;">
        <form id="teamForm" enctype="multipart/form-data" class="mb-4">
            @csrf
            <input type="hidden" name="id" id="team_id">

            <div class="row g-3">
                <!-- Image Upload -->
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <label class="form-label fw-bold">Team Member Image</label>
                            <div class="border-dashed rounded-3 p-3 text-center bg-light mb-3" id="teamImagePreview">
                                <span class="text-muted">No image selected</span>
                            </div>
                            <input type="file" name="image" class="form-control" id="teamImageUpload" accept="image/*">
                            <small class="text-muted mt-2">Recommended size: 800x600px. Max 2MB. Leave blank to keep existing image.</small>
                        </div>
                    </div>
                </div>

                <!-- Text Fields -->
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" id="teamName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Position</label>
                                <input type="text" name="position" id="teamPosition" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bio</label>
                                <textarea name="bio" id="teamBio" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Facebook URL</label>
                                <input type="url" name="facebook" id="teamFacebook" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Instagram URL</label>
                                <input type="url" name="instagram" id="teamInstagram" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Twitter URL</label>
                                <input type="url" name="twitter" id="teamTwitter" class="form-control">
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
    <div class="table-responsive">
        <table class="table table-sm table-bordered" id="teamTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- AJAX Data Will Be Loaded Here -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    .border-dashed { border: 2px dashed #dee2e6; }
    #teamImagePreview { min-height: 150px; display: flex; align-items: center; justify-content: center; }
    #teamImagePreview img { max-width: 100%; max-height: 150px; border-radius: 4px; }
    .card { border-radius: 0.5rem; }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function(){

    // Load team members
    function loadTeam(){
        $.ajax({
            url: "{{ route('team-content.index') }}",
            type: "GET",
            dataType: "json",
            success: function(response){
                let rows = '';
                response.data.forEach(row => {
                    rows += `
                        <tr>
                            <td>${row.id}</td>
                            <td><img src="/storage/${row.image}" width="60" class="img-thumbnail"></td>
                            <td>${row.name}</td>
                            <td>${row.position}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editTeamBtn" data-id="${row.id}">Edit</button>
                                <button class="btn btn-sm btn-danger deleteTeamBtn" data-id="${row.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#teamTable tbody').html(rows);
            }
        });
    }

    // Reset form
    function resetForm() {
        $('#teamForm')[0].reset();
        $('#team_id').val('');
        $('#teamImagePreview').html('<span class="text-muted">No image selected</span>');
        $('#formSubmitBtn').html('<i class="fas fa-save me-1"></i> Save');
    }

    // Show form for Add
    $('#addTeamBtn').click(function(){
        resetForm();
        $('#teamFormContainer').slideDown();
    });

    // Cancel button hides form
    $('#formCancelBtn').click(function(){
        $('#teamFormContainer').slideUp();
        resetForm();
    });

    // Clear button
    $('#clearBtn').click(resetForm);

    // Image preview
    $('#teamImageUpload').change(function(){
        if (this.files && this.files[0]) {
            if (this.files[0].size > 2097152) {
                alert('File size exceeds 2MB.');
                $(this).val('');
                return;
            }
            var reader = new FileReader();
            reader.onload = function(e){
                $('#teamImagePreview').html('<img src="' + e.target.result + '" class="img-thumbnail">');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Form submit (Add / Update)
    $('#teamForm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        let id = $('#team_id').val();
        let url = id ? "{{ url('admin/team-content') }}/" + id : "{{ route('team-content.store') }}";
        if(id) formData.append('_method', 'PUT');

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $('#formSubmitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');
            },
            complete: function(){
                $('#formSubmitBtn').prop('disabled', false).html(id ? '<i class="fas fa-save me-1"></i> Update' : '<i class="fas fa-save me-1"></i> Save');
            },
            success: function(response){
                resetForm();
                $('#teamFormContainer').slideUp(); // hide after submit
                loadTeam();
                $('#alertMsg').html(`<div class="alert alert-success alert-dismissible fade show">${response.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`);
                setTimeout(() => $('#alertMsg').empty(), 3000);
            },
            error: function(xhr){
                let errors = xhr.responseJSON?.errors;
                let errorHtml = '<div class="alert alert-danger alert-dismissible fade show"><ul>';
                if(errors){ Object.values(errors).forEach(err => errorHtml += `<li>${err}</li>`); }
                else { errorHtml += '<li>Something went wrong.</li>'; }
                errorHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
                $('#alertMsg').html(errorHtml);
            }
        });
    });

    // Edit team member
    $(document).on('click', '.editTeamBtn', function(){
        let id = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/team-content') }}/" + id + "/edit",
            type: "GET",
            success: function(data){
                resetForm();
                $('#team_id').val(data.id);
                $('#teamName').val(data.name);
                $('#teamPosition').val(data.position);
                $('#teamBio').val(data.bio);
                $('#teamFacebook').val(data.facebook);
                $('#teamInstagram').val(data.instagram);
                $('#teamTwitter').val(data.twitter);
                if(data.image) $('#teamImagePreview').html('<img src="/storage/' + data.image + '" class="img-thumbnail">');
                else $('#teamImagePreview').html('<span class="text-muted">No image selected</span>');
                $('#formSubmitBtn').html('<i class="fas fa-save me-1"></i> Update');
                $('#teamFormContainer').slideDown(); // show form when editing
            }
        });
    });

    // Delete team member
    $(document).on('click', '.deleteTeamBtn', function(){
        let id = $(this).data('id');
        if(confirm('Are you sure you want to delete this team member?')){
            $.ajax({
                url: "{{ url('admin/team-content') }}/" + id,
                type: "DELETE",
                data: {_token: "{{ csrf_token() }}"},
                success: function(response){
                    loadTeam();
                    $('#alertMsg').html(`<div class="alert alert-success alert-dismissible fade show">${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`);
                    setTimeout(() => $('#alertMsg').empty(), 3000);
                }
            });
        }
    });

    // Initial load
    loadTeam();
});
</script>
@endpush
