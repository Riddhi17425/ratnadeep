<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_logos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('alt_image_text')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        $logos = [
            ['ISO 9001: 2015', 'cert-iso9001.png', 'ISO 9001:2015 certification'],
            ['ISO 45001: 2018', 'cert-iso45001.png', 'ISO 45001:2018 certification'],
            ['PED & ADWO', 'cert-ped-adwo.png', 'PED and ADWO certification'],
            ['ISO 14001: 2015', 'cert-iso14001.png', 'ISO 14001:2015 certification'],
            ['NORSOK', 'cert-norsok.png', 'NORSOK certification'],
            ['Marine', 'cert-marine.png', 'Marine certification'],
            ['"Well Known Pipe/Tube Maker" by Central Boilers Board, India', 'cert-cbb.png', 'Central Boilers Board certification'],
        ];

        foreach ($logos as [$title, $filename, $altText]) {
            DB::table('about_logos')->insert([
                'title' => $title,
                'image' => 'frontend/assets/images/About/' . $filename,
                'alt_image_text' => $altText,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('about_logos');
    }
};
