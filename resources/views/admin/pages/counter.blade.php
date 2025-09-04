@extends('admin.layouts.master')
@section('title', 'Counters')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary mb-4">Counters</h2>

    <!-- Alert Messages -->
    <div id="alertMsg"></div>

    <!-- Counters Display -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="p-3 bg-light rounded shadow-sm">
                <h4 id="projects_val">{{ $counter->projects_completed }}</h4>
                <p>Projects Completed</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-light rounded shadow-sm">
                <h4 id="clients_val">{{ $counter->happy_clients }}</h4>
                <p>Happy Clients</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-light rounded shadow-sm">
                <h4 id="awards_val">{{ $counter->awards_received }}</h4>
                <p>Awards Received</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-light rounded shadow-sm">
                <h4 id="coffee_val">{{ $counter->cup_of_coffee }}</h4>
                <p>Cups of Coffee</p>
            </div>
        </div>
    </div>

    <button class="btn btn-primary mb-4" id="editBtn"
        data-id="{{ $counter->id }}"
        data-projects="{{ $counter->projects_completed }}"
        data-clients="{{ $counter->happy_clients }}"
        data-awards="{{ $counter->awards_received }}"
        data-coffee="{{ $counter->cup_of_coffee }}">
        Edit Counters
    </button>

    <!-- Inline Form (Hidden by default) -->
    <div id="counterFormWrapper" class="d-none mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0" id="formTitle">Edit Counters</h5>
                <button type="button" class="btn btn-sm btn-outline-danger" id="cancelBtn">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
            <div class="card-body">
                <form id="counterForm">
                    @csrf
                    <input type="hidden" id="counter_id" name="id">

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="projects" class="form-label">Projects Completed</label>
                            <input type="number" class="form-control" name="projects" id="projects">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="clients" class="form-label">Happy Clients</label>
                            <input type="number" class="form-control" name="clients" id="clients">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="awards" class="form-label">Awards Received</label>
                            <input type="number" class="form-control" name="awards" id="awards">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="coffee" class="form-label">Cups of Coffee</label>
                            <input type="number" class="form-control" name="coffee" id="coffee">
                        </div>
                    </div>

                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-success" id="formSubmitBtn">
                            Update
                        </button>
                        <button type="button" class="btn btn-danger" id="cancelBtnFooter">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

@push('scripts')
<script>
$(document).ready(function(){

    // Show form on edit button click
    $("#editBtn").click(function () {
        $("#counter_id").val($(this).data('id'));
        $("#projects").val($(this).data('projects'));
        $("#clients").val($(this).data('clients'));
        $("#awards").val($(this).data('awards'));
        $("#coffee").val($(this).data('coffee'));

        $("#formTitle").text("Edit Counters");
        $("#formSubmitBtn").text("Update");
        $("#counterFormWrapper").removeClass("d-none");
    });

    // Hide form
    $("#cancelBtn, #cancelBtnFooter").click(function(){
        $("#counterFormWrapper").addClass("d-none");
    });

    // CSRF setup
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Submit form via AJAX
    $("#counterForm").submit(function(e){
        e.preventDefault();
        let id = $("#counter_id").val();
        $.ajax({
            url: `/admin/counters-content/${id}`,
            type: 'PUT',
            data: $(this).serialize(),
            success: function(response){
                $('#projects_val').text(response.data.projects_completed);
                $('#clients_val').text(response.data.happy_clients);
                $('#awards_val').text(response.data.awards_received);
                $('#coffee_val').text(response.data.cup_of_coffee);

                $("#alertMsg").html(`<div class="alert alert-success alert-dismissible fade show">
                    Counters updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`);

                $("#counterFormWrapper").addClass("d-none");
                setTimeout(() => $("#alertMsg").empty(), 3000);
            },
            error: function(xhr){
                console.log(xhr.responseText);
                alert('Error: Something went wrong!');
            }
        });
    });

});
</script>
@endpush
@endsection
