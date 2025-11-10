<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('leads')) {
            Schema::create('leads', function (Blueprint $table) {
                $table->id(); // Primary Key (Auto Increment)

                $table->string('first_name');
                $table->string('last_name')->nullable();
                $table->string('email')->nullable();
                $table->string('country_code')->nullable();
                $table->string('mobile_number')->nullable();
                $table->string('lead_source')->nullable();

                   $table->unsignedBigInteger('stage_id')->nullable();
                $table->foreign('stage_id')
                    ->references('stage_id')
                    ->on('stages')
                    ->onDelete('set null');

                $table->unsignedBigInteger('assign_to')->nullable();
                $table->foreign('assign_to')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');


                $table->string('job_type')->nullable();
                $table->string('industry')->nullable();
                $table->string('company')->nullable();
                $table->string('website')->nullable();
                $table->string('linkedin')->nullable();
                $table->string('facebook')->nullable();
                $table->string('instagram')->nullable();
                $table->string('pinterest')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('country')->nullable();
                $table->string('zip_code')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
