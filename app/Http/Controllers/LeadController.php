<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Stage;
use App\Models\User;
use App\Models\Lead;
use App\Models\Country;
use App\Models\Source;
use Yajra\DataTables\Facades\DataTables;

class LeadController extends Controller
{
       public function index()
    {
    $leads = Lead::all();
     // the view will initialize DataTable via ajax to route('leads.list')
        return view('leads.index',compact('leads'));
    }
   
    public function create()
    {
        $stages = Stage::orderby('stage_id')->get();
        $sources = Source::all();
        $users = User::all();
        $countries = Country::all();
        $phonecodes = Country::select('name','phoneCode')->orderBy('name')->get();
        return view('leads.create',compact('stages','sources','phonecodes','countries','users'));
    }

    public function store(Request $request)
    {
           $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'country_code' => 'nullable|string|max:10',
            'mobile_number' => 'nullable|string|max:20',
            'lead_source' => 'nullable|string|max:255',
            'stage_id' => 'nullable|integer|exists:stages,stage_id',
            'job_type' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'Address1' =>  'nullable|string',
            'Address2' =>  'nullable|string',
            'country_id' => 'nullable|integer|exists:tbl_countries,id',
            'state_id' => 'nullable|integer|exists:tbl_states,id',
            'city_id' => 'nullable|integer|exists:tbl_cities,id',
            'zip_code' => 'nullable|string|max:20',
            'assign_to' => 'nullable|integer|exists:users,id',

        ]);

        Lead::create($validated);

        return response()->json([
            'success'=>true,
            'message' =>'Lead submitted successfully!',
        ]);
      
    }

   public function list(Request $request)
{
    $query = Lead::leftJoin('stages', 'leads.stage_id', '=', 'stages.stage_id')
        ->leftJoin('users', 'leads.assign_to', '=', 'users.id')
        ->leftJoin('sources', 'leads.lead_source', '=', 'sources.id') // ✅ Join sources table
        ->select([
            'leads.id',
            'leads.first_name',
            'leads.last_name',
            'leads.email',
            'leads.mobile_number',
            'leads.company',
            'leads.website',
            'leads.job_type',
            'leads.created_at',
            'stages.name as stage_name',
            'stages.color as stage_color',
            'users.name as assigned_to',
            'sources.lead_source as source_name', // ✅ Correct column from sources table
        ]);

    return DataTables::of($query)
        ->addColumn('name', function($row){
            return '<div><strong>'.e($row->first_name.' '.$row->last_name).'</strong><br><small>'.e($row->email).'</small></div>';
        })
        ->addColumn('stage', function($row){
            if ($row->stage_name) {
                $color = $row->stage_color ?: '#6c757d';
                return '<span class="badge" style="background:'.e($color).';color:#fff;padding:6px 10px;border-radius:8px;">'.e($row->stage_name).'</span>';
            }
            return '<span class="badge bg-secondary">No Stage</span>';
        })
        ->addColumn('assigned_to', function($row){
            return $row->assigned_to
                ? '<span>'.e($row->assigned_to).'</span>'
                : '<span class="text-muted">Unassigned</span>';
        })
        ->addColumn('lead_source', function ($row) {
            return e($row->source_name ?? 'N/A'); // ✅ Use the joined source name
        })
        ->addColumn('action', function($row){
            return '
                <button class="btn btn-sm btn-primary createFollowUp" data-id="'.e($row->id).'">Follow Up</button>
            ';
        })
        ->rawColumns(['name','stage','assigned_to','lead_source','action'])
        ->make(true);
}

     

}
