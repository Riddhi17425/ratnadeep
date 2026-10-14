<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_areas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('status')->default(1);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        $seen = [];
        $sortOrder = 0;
        $now = now();

        foreach (DB::table('job_openings')->whereNotNull('area')->orderBy('area')->pluck('area') as $area) {
            $name = trim($area);
            $key = mb_strtolower($name);

            if ($name === '' || isset($seen[$key])) {
                continue;
            }

            $seen[$key] = true;
            DB::table('job_areas')->insert([
                'name' => $name,
                'status' => 1,
                'sort_order' => $sortOrder++,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('job_areas');
    }
};
