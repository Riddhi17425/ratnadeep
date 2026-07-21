<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('upcoming_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('video')->nullable();
            $table->string('alt_video_text')->nullable();
            $table->string('icon')->nullable();
            $table->string('alt_icon_text')->nullable();
            $table->text('short_description')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('upcoming_events');
    }
};