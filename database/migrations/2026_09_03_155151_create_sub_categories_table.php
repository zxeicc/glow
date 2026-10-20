<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();

            // Parent Category
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // SubCategory information
            $table->string('name');
            $table->string('slug')->unique();

            // Status
            $table->boolean('status')->default(true);

            // Soft delete flag
            $table->boolean('is_delete')->default(false);

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();

            // User who created the subcategory
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('is_delete');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
