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
            $table->foreignId('category_id')->nullable()->change();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('category')->nullable()->change();
            $table->foreignId('category_id')
                ->nullable()
                ->after('category')
                ->constrained('categories')
                ->nullOnDelete();
        });

        DB::table('blogs')->whereNotNull('category')->orderBy('id')->chunkById(100, function ($blogs) {
            foreach ($blogs as $blog) {
                $categoryId = DB::table('categories')
                    ->whereNull('deleted_at')
                    ->where('title', $blog->category)
                    ->value('id');

                if ($categoryId) {
                    DB::table('blogs')->where('id', $blog->id)->update(['category_id' => $categoryId]);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
