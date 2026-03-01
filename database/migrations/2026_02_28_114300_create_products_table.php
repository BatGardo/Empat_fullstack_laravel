<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // add description and category_id if they don't exist
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('price');
            }
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['description', 'category_id']);
        });
    }
};
