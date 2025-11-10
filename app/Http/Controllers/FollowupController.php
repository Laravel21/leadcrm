<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Source;
use App\Models\Lead;
use Carbon\Carbon;
use App\Models\FollowUp;

class FollowupController extends Controller
{

public function index(Lead $lead)
{
    $followups = Followup::with('user')
        ->leftJoin('sources', 'followups.followup_type', '=', 'sources.id')
        ->where('followups.lead_id', $lead->id)
        ->select(
            'followups.*',
            'sources.lead_source as followup_type_name'
        )
        ->orderBy('followups.followup_date', 'desc')
        ->get();

    return view('leads.followups', compact('lead', 'followups'));
}
   
   
       public function followUpForm($id)
        {
            $lead = Lead::findOrFail($id);
            $followupTypes = Source::select('id','lead_source')->get();
            $users = User::all();
            return view('leads.follow_up_form', compact('lead','users','followupTypes'));
        }


    public function store(Request $request)
    {
            $request->validate([
                'lead_id' => 'required|exists:leads,id',
                'user_id' => 'required|integer',
                'followup_date' => 'required|date',
                'followup_type' => 'required|string',
                'status' => 'required|in:0,1',
                'remark' => 'nullable|string',
            ]);

     $followUp = new FollowUp();
        $followUp->lead_id = $request->lead_id;
        $followUp->user_id = $request->user_id;
        $followUp->followup_date = $request->followup_date;
        $followUp->followup_type = $request->followup_type;
        $followUp->status = $request->status;
        $followUp->remark = $request->remark;
        $followUp->save();

        return response()->json(['success' => true, 'message' => 'Follow-up saved successfully']);

    }

    public function edit($id)
{
    $followup = FollowUp::findOrFail($id);

    // if you're using Source model as types (same as in create)
    $followupTypes = Source::select('id', 'lead_source')->get();

    // load users if needed (optional)
    $users = User::select('id', 'name')->get();

    // ✅ pass all variables to the view
    return view('followup.edit_form', compact('followup', 'followupTypes', 'users'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'followup_date' => 'required|date',
        'followup_type' => 'required|string',
        'status' => 'required|boolean',
        'remark' => 'nullable|string',
    ]);

    $followup = Followup::findOrFail($id);

    $followup->followup_date = Carbon::parse($request->followup_date);
    $followup->followup_type = $request->followup_type;
    $followup->status = $request->status;
    $followup->remark = $request->remark;
    $followup->save();

    return response()->json([
        'success' => true,
        'message' => 'Follow-up updated successfully!',
        'data' => [
            'followup_date' => $followup->followup_date->format('Y-m-d H:i'),
            'followup_type' => $followup->followup_type,
            'status_text' => $followup->status == 1 ? 'Completed' : 'Pending',
            'remark' => $followup->remark,
        ]
    ]);
}
}
