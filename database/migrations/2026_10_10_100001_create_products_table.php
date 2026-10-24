<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->nullable();             // e.g. "Seamless Pipes" (hero badge)
            $table->text('summary')->nullable();            // listing card text
            $table->string('image')->nullable();            // listing card image
            $table->string('alt_image_text')->nullable();
            $table->boolean('is_wide')->default(false);     // wide card on the listing grid
            // detail page
            $table->text('hero_text')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('overview_title')->nullable();
            $table->json('overview')->nullable();           // list of paragraphs
            $table->string('overview_image')->nullable();
            $table->string('datasheet')->nullable();        // downloadable datasheet (pdf)
            $table->json('features')->nullable();           // [{title, text}]
            $table->json('specs')->nullable();              // [{parameter, value, notes}]
            $table->json('grades')->nullable();             // [grade, ...]
            $table->json('industry_ids')->nullable();       // selected application card IDs from page_items
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
