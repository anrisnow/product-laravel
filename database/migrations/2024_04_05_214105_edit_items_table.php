<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('author',200)->nullable()->after('title');
            $table->string('owner',200)->index()->after('reading_status');
        });
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('author');
            $table->dropColumn('owner');
        });
    }
};
