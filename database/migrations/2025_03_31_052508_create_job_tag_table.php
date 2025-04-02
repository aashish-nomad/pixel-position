<?php

use App\Models\Tag;
use App\Models\Job;
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
        Schema::create('job_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Job::class)->constrained()->cascadeOnDelete(); // This means if a job is deleted the tags related to it is also deleted in the pivot table.
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_tag');
    }
};
