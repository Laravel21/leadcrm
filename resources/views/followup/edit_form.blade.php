
<!DOCTYPE HTML>
<form id="editFollowupForm" data-id="{{ $followup->id }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Follow-Up Date</label>
        <input type="datetime-local" name="followup_date" value="{{ \Carbon\Carbon::parse($followup->followup_date)->format('Y-m-d\TH:i') }}"  class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Follow-Up Type</label>
        <select name="followup_type" class="form-select" required>
            <option value="">Select Type</option>
            @foreach($followupTypes as $type)
                <option value="{{ $type->lead_source }}" 
                    {{ $followup->followup_type == $type->lead_source ? 'selected' : '' }}>
                    {{ $type->lead_source }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="0" {{ $followup->status == 0 ? 'selected' : '' }}>Pending</option>
            <option value="1" {{ $followup->status == 1 ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Remark</label>
        <textarea name="remark" class="form-control">{{ $followup->remark }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>
