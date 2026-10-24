<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->unsignedInteger('sequence')->default(0);
        });

        DB::table('banners')->orderByDesc('id')->pluck('id')->each(function ($id, $index) {
            DB::table('banners')->where('id', $id)->update(['sequence' => $index + 1]);
        });
    }

    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('sequence');
        });
    }
};