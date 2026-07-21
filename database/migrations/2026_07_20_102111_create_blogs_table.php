<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('category');   // simple text input, Category module se koi relation nahi
            $table->string('title');
            $table->string('url')->unique();
            $table->date('date');
            $table->text('short_description');
            $table->longText('long_description');
            $table->longText('conclusion')->nullable();
            $table->string('front_image')->nullable();
            $table->string('front_image_alt')->nullable();
            $table->string('detail_image')->nullable();
            $table->string('detail_image_alt')->nullable();
            $table->string('cta_image')->nullable();
            $table->string('cta_image_alt')->nullable();
            $table->string('cta_link_url')->nullable();
            $table->longText('schema_json')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->json('faqs')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};