<!DOCTYPE HTML>
<div class="modal-header">
    <h5 class="modal-title" id="followUpModalLabel">Add Follow-Up for {{ $lead->first_name }} {{ $lead->last_name }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form id="ajaxFollowUpForm" action="{{ route('followup.store') }}" method="POST">
    @csrf
    <input type="hidden" name="lead_id" value="{{ $lead->id }}">

    <div class="modal-body">

        <div class="mb-3">
            <label for="assign_to" class="form-label">Assign To</label>
           <select class="form-select" id="user_id" name="user_id">
            <option value="">Select</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{$user->name }}</option>
            @endforeach
            </select>
        </div>


        <div class="mb-2">
            <label for="followup_date" class="form-label">Follow-Up Date & Time</label>
            <input type="datetime-local" name="followup_date" id="followup_date" class="form-control" required>
        </div>

         <div class="mb-1">
            <label for="followup_type" class="form-label">Follow-Up Type</label>
        <select class="form-select" name="followup_type" id="followup_type">
            @foreach($followupTypes as $type)
            <option value="{{ $type->id }}">{{ $type->lead_source }}</option>
        @endforeach 
            </select>
        </div>

         <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                 <option value="">Select</option>
                <option value="0">Pending</option>
                <option value="1">Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="remark" class="form-label">Remark</label>
            <textarea name="remark" id="remark" rows="3" class="form-control" placeholder="Enter follow-up remark" required></textarea>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Follow-Up</button>
    </div>
</form>

<script>
    // Submit the follow-up form using AJAX
    $('#ajaxFollowUpForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#followUpModal').modal('hide');
                $('#leadTable').DataTable().ajax.reload();
                alert('Follow-up added successfully!');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Something went wrong while saving follow-up!');
            }
        });
    });
</script>
