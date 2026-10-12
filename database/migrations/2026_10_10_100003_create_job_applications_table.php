<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_opening_id')->nullable()->constrained('job_openings')->nullOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('position');
            $table->string('experience');
            $table->string('linkedin')->nullable();
            $table->string('resume');                       // private path on the local disk
            $table->boolean('is_read')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
