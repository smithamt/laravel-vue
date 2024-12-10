<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Ensure the columns exist and have the correct types
            $table->char('created_by_id', 36)->collation('utf8mb4_bin')->change();

            // Add foreign key constraints
            $table->foreign('created_by_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['hostelId']);
            $table->dropForeign(['created_by_id']);
        });
    }
};
