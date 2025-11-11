@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Lead List</h4>
                    <a href="{{ route('leads.export') }}" class="btn btn-success">Export to Excel</a>
                    <a href="{{ route('leads.create') }}" class="btn btn-primary btn-sm">Add New Lead</a>
                </div>

                <div class="card-body">
                    <table id="leadTable" class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Website</th>
                                <th>Job Title</th>
                                <th>Stage</th>
                                <th>Source</th>
                                <th>Assigned To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables populates automatically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Follow Up Modal -->
<div class="modal fade" id="followUpModal" tabindex="-1" role="dialog" aria-labelledby="followUpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- AJAX-loaded content -->
    </div>
  </div>
</div>
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>

<script>
$(document).ready(function() {
    // ✅ Initialize DataTable
    $('#leadTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('leads.list') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'company', name: 'company' },
            { data: 'website', name: 'website' },
            { data: 'job_type', name: 'job_type' },
            {
                data: 'stage_name',
                name: 'stage_name',
                render: function(data, type, row) {
                    return `<span class="badge" style="background-color:${row.stage_color}">${data}</span>`;
                }
            },
            { data: 'lead_source', name: 'lead_source' },
            { data: 'assigned_to', name: 'assigned_to' },

            // 👇 Action Buttons
            {
                data: 'id',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-success createFollowUp mb-2" data-id="${data}">
                                <i class="bi bi-plus-circle"></i> Add </button>
                            <a href="/leads/${data}/followups" class="btn btn-sm btn-info" target="_blank">
                                <i class="bi bi-eye"></i> View Follow-Ups
                            </a>
                        </div>
                    `;
                }
            }
        ]
    });

    // ✅ Add Follow-Up Modal (AJAX)
    $('body').on('click', '.createFollowUp', function() {
        let leadId = $(this).data('id');
        $.get(`/leads/${leadId}/follow-up-form`, function(data) {
            $('#followUpModal .modal-content').html(data);
            $('#followUpModal').modal('show');
        });
    });
});
</script>
@endsection
