<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Lead::select('id', 'first_name', 'last_name', 'email', 'mobile_number','website','job_type','industry', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Website','Job Type','Industry','Created At'];
    }
}
