@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="text-center mb-4">   Follow-Ups for {{ $lead->first_name }} {{ $lead->last_name }}
</h4>
<div class="card mb-4">
    <div class="col-4">
        <a href="{{ route('leads.index') }}" class="btn btn-secondary btn-sm">← Back to Leads</a>
    </div>
</div>
<div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Follow-Up Date</th>
                <th>Follow-up Type</th>
                <th>Status</th>
                <th>Remark</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse($followups as $followup)
                <tr>
                    <td>{{ $followup->followup_date }}</td>
                    <td>{{ $followup->followup_type  }}</td>
                    <td>{{ $followup->status == 1 ? 'Completed' : 'Pending' }}</td>
                    <td>{{ $followup->remark }}</td>
                    <td>{{ $followup->created_at->format('Y-m-d H:i') }}</td>
                    <td><button class="btn btn-warning editFollowupBtn" data-id="{{ $followup->id }}">Edit</button></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No follow-ups yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>

<!-- 🔹 Bootstrap Modal -->
<div class="modal fade" id="editFollowupModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Follow-Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="editFollowupBody">
        <!-- AJAX-loaded form will appear here -->
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
$(document).ready(function() {

    // 🔹 Open modal and load form via AJAX
    $(document).on('click', '.editFollowupBtn', function() {
        let id = $(this).data('id');
        $.get('/followup/' + id + '/edit', function(data) {
            $('#editFollowupBody').html(data);
            $('#editFollowupModal').modal('show');
        });
    });

    // 🔹 Submit edit form via AJAX
    $(document).on('submit', '#editFollowupForm', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let formData = $(this).serialize();

        $.ajax({
            url: '/followup/' + id + '/update',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#editFollowupModal').modal('hide');
                    // ✅ Update row dynamically
                    $('#row_' + id + ' td:nth-child(1)').text(response.data.followup_date);
                    $('#row_' + id + ' td:nth-child(2)').text(response.data.followup_type);
                    $('#row_' + id + ' td:nth-child(3)').text(response.data.status_text);
                    $('#row_' + id + ' td:nth-child(4)').text(response.data.remark);
                }
            },
            error: function() {
                alert('Something went wrong!');
            }
        });
    });

});
</script>
@endsection

