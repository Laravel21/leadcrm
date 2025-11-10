<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lead;
use Illuminate\Support\Facades\Storage;

class ExportLeadsToCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-leads-to-c-s-v';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all leads to a CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');

        $file_path = storage_path('app/ .$filename');

        $lead = Lead::leftjoin('stages','leads.stage_id','=','stages.stage_id')
        ->leftjoin('sources','leads.lead_source','=','sources.lead_source')
        ->leftjoin('users','leads.assign_to','=','users.id')
        ->select([
            'leads.id',
            'leads.first_name',
            'leads.last_name',
            'leads.email',
            'leads.company',
            'leads.website',
            'leads.job_type',
            'stages.stage_name',
            'sources.lead_source',
            'users.name as assign_to',
        ])->get();  
        $handle = fopen($file_path,'w')   ;
        fputcsv($handle,[
            'ID','firstname','lastname','COmpany','Website','Job Title','Stage','Source'
        ]) ;
        foreach($leads as $lead)
        {
            fputcsv($handle,[
                $lead->id,
                $lead->first_name,
                $lead->last_name,
                $lead->company,
                $lead->website,
                $lead->job_type,
                $lead->stage_name,
                $lead->lead_source,
                $lead->assigned_to
            ]);
        }
fclose($handle);
        $this->info("Leads exported successfully to: {$filepath}");
    }
}
