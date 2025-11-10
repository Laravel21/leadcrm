@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mt-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#leadStageModal">
            +
            </button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#leadSourceModal">
            Lead Source
            </button>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Lead Generation Form </h4>
        </div>

        <div class="card-body">
            <div id="alert-container"></div>

            <form id="leadForm">
                @csrf

                <div class="row g-3">
                    <h2>Personal Details</h2>
                    <div class="col-md-6">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-control" required>
                        <span class="text-danger error-text first_name_error"></span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-control" required>
                        <span class="text-danger error-text last_name_error"></span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"> Email *</label>
                        <input type="email" name="email" class="form-control" required> 
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label">Code *</label>
                        <select name="country_code" class="form-select" required>
                            <option value="">Select Country</option>
                            @foreach($phonecodes as $country)
                                <option value="+{{ $country->phoneCode }}">
                                    (+{{ $country->phoneCode }})
                                </option>
                            @endforeach
                        </select>
                </div>


                    <div class="col-md-4">
                        <label class="form-label">Mobile Number *</label>
                        <input type="text" name="mobile_number" class="form-control" required>
                        <span class="text-danger error-text mobile_number_error"></span>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Lead  Source *</label>
                       <select name="lead_source" class="form-select" id="lead_source">
                        <option value="">select</option>
                        @foreach($sources as $source)
                            <option value="{{ $source->id }}">{{$source->lead_source }}</option>
                        @endforeach
                         </select>
                        <span class="text-danger error-text source_id_error"></span>
                    </div>

                   <div class="col-md-3">
                        <label class="form-label">Lead Stage *</label>
                         <select name="stage_id" class="form-select" id="stageDropdown">
                            <option value="">select</option>
                        @foreach($stages as $stage)
                            <option value="{{ $stage->stage_id }}">{{ $stage->name }}</option>
                        @endforeach
                         </select>
                        <span class="text-danger error-text stage_id_error"></span>
                    </div>

                     <div class="col-md-3">
                        <label class="form-label">Assigned to *</label>
                        <select name="assign_to" class="form-select" id="assign_to">
                        <option value="">select</option>
                        @foreach($users as $usr)
                            <option value="{{ $usr->id }}">{{$usr->name }}</option>
                        @endforeach
                         </select>
                        <span class="text-danger error-text assign_to_error"></span>
                    </div>

                    <h2>Professional Details</h2>
                    <div class="col-md-6">
                        <label class="form-label">Job Type *</label>
                        <input type="text" name="job_type" class="form-control" required>
                        <span class="text-danger error-text job_type_error"></span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Industry *</label>
                        <input type="text" name="industry" class="form-control" required>
                        <span class="text-danger error-text industry_error"></span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Company *</label>
                        <input type="text" name="company" class="form-control" required>
                        <span class="text-danger error-text company_error"></span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Website *</label>
                        <input type="url" name="website" class="form-control" required>
                       <span class="text-danger error-text website_error"></span>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">LinkedIn</label>
                        <input type="url" name="linkedin" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="facebook" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Instagram</label>
                        <input type="url" name="instagram" class="form-control">
                   </div>

                    <div class="col-md-6">
                        <label class="form-label">Pinterest</label>
                        <input type="url" name="pinterest" class="form-control">
                    </div>

                    <h2>Address</h2>
                    <div class="col-md-6">
                        <label for="Address1" class="form label">Address1 *</label>
                        <textarea class="form-control" name="Address1" cols="20" rows="2"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="Address2" class="form label">Address2 *</label>
                        <textarea class="form-control" name="Address2" cols="20" rows="2"></textarea>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Country *</label>
                    <select class="form-select" name="country_id" id="country_id">
                         <option value="">Select</option>
                         @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{$country->name }}</option>
                        @endforeach
                         </select>
                        <span class="text-danger error-text country_error"></span>
                    </div>

                    <div class="col-md-3">
                         <label class="form-label">State</label>
                        <select id="state_id" name="state_id" class="form-select">
                            <option value="">Select State</option>
                        </select>
                        <span class="text-danger error-text state_error"></span>
                    </div>

                    <div class="col-md-3">
                         <label class="form-label">City</label>
                        <select id="city_id" name="city_id" class="form-select">
                            <option value="">Select City</option>
                        </select>
                        <span class="text-danger error-text city_error"></span>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Zip Code *</label>
                        <input type="text" name="zip_code" class="form-control" required>
                        <span class="text-danger error-text zip_code_error"></span>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-success px-4">Submit Lead</button>
                        <button type="reset" class="btn btn-secondary px-4">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
     <!-- Bootstrap Modal -->
    <div class="modal fade" id="leadStageModal" tabindex="-1" aria-labelledby="leadStageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leadStageModalLabel">Create Lead Stage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="leadStageForm">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="stage_name" class="form-label">Stage Name</label>
                            <input type="text" class="form-control" id="stage_name" name="stage_name" required>
                        </div>
                         <div id="formError" class="alert alert-danger d-none"></div>
                            <div class="mb-3">
                                <label for="color_code" class="form-label">Color</label>
                                <input type="color" class="form-control" id="color_code" name="color_code" value="#3498db" title="Choose a color">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!--Bootstrap Lead Source Modal -->
     <div class="modal fade" id="leadSourceModal" tabindex="-1" aria-labelledby="leadSourceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leadSourceModalLabel">Create Lead Source</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="leadSourceForm">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="source_name" class="form-label">Source Name</label>
                            <input type="text" class="form-control" id="source_name" name="lead_source" required>
                        </div>
                         <div id="formError" class="alert alert-danger d-none"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function() {
    $('#leadForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            url: "{{ route('leads.store') }}",
            type: "POST",
            data: formData,
            beforeSend: function() {
                form.find('button[type=submit]').prop('disabled', true).text('Submitting...');
                $('#alert-container').html('');
            },
            success: function(response) {
                if (response.success) {
                    $('#alert-container').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `);
                    form.trigger('reset');
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                let message = '<ul>';
                if (errors) {
                    $.each(errors, function(key, value) {
                        message += `<li>${value[0]}</li>`;
                    });
                    message += '</ul>';
                } else {
                    message = '<p>Something went wrong. Please try again.</p>';
                }
                $('#alert-container').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
            },
            complete: function() {
                form.find('button[type=submit]').prop('disabled', false).text('Submit Lead');
            }
        });
    });
        $("#leadStageForm").on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('stages.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $("#leadStageModal").modal('hide');
                    $("#leadStageForm")[0].reset();
                    $("#formError").addClass('d-none');

                    // Update UI
                    $("#leadStageList").append(`<div class="alert alert-info">${response.stage_name} created successfully</div>`);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + "<br>";
                    });

                    $("#formError").html(errorMessage).removeClass('d-none');
                }
            });
        });

    
    $("#leadSourceForm").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('source.store') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $("#leadSourceModal").modal('hide');
                $("#leadSourceForm")[0].reset();
                $("#formError").addClass('d-none');

                $("#leadSourceList").append(`<div class="alert alert-info">${response.lead_source} created successfully</div>`);
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += value[0] + "<br>";
                });

                $("#formError").html(errorMessage).removeClass('d-none');
            }
        });
    });
});
</script>

<script>
$('#country_id').on('change', function() {
    let countryId = $(this).val();
    $('#state_id').html('<option value="">Loading...</option>');
    $('#city_id').html('<option value="">Select City</option>');

    $.post("{{ route('getStates') }}", {
        country_id: countryId,
        _token: '{{ csrf_token() }}'
    }, function(data) {
        let options = '<option value="">Select State</option>';
        data.forEach(state => {
            options += `<option value="${state.id}">${state.name}</option>`;
        });
        $('#state_id').html(options);
    });
});

$('#state_id').on('change', function() {
    let stateId = $(this).val();
    $('#city_id').html('<option value="">Loading...</option>');

    $.post("{{ route('getCities') }}", {
        state_id: stateId,
        _token: '{{ csrf_token() }}'
    }, function(data) {
        let options = '<option value="">Select City</option>';
        data.forEach(city => {
            options += `<option value="${city.id}">${city.name}</option>`;
        });
        $('#city_id').html(options);
    });
});
</script>
@endsection
