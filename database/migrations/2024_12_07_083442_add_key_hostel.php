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
        Schema::table('hostels', function (Blueprint $table) {
            $table->char('companyId', 36)->collation('utf8mb4_bin')->change();
            $table->char('createdById', 36)->collation('utf8mb4_bin')->change();

            $table->foreign('companyId')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('createdById')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hostels', function (Blueprint $table) {
            $table->dropForeign(['companyId']);
            $table->dropForeign(['createdById']);
        });
    }
};
