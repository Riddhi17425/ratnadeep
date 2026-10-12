<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_items', function (Blueprint $table) {
            $table->id();
            $table->string('section')->index();             // key from config/page_content.php, e.g. packaging.options
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('phone')->nullable();            // used by office/location items
            $table->string('email')->nullable();
            $table->string('image')->nullable();            // image / icon
            $table->string('alt_image_text')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_items');
    }
};
