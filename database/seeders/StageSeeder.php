<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stage;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $stages = ['New', 'Contacted', 'Qualified', 'Converted', 'Closed'];

        foreach ($stages as $index => $stage) {
            Stage::firstOrCreate(['name' => $stage], ['order' => $index]);
        }
    }
}
