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
        Schema::create('rooms', function (Blueprint $table) {
            $table->char('id', 36)->collation('utf8mb4_bin')->primary();
            $table->string('roomNumber');
            $table->integer('capacity');
            $table->uuid('hostelId');
            $table->boolean('isOccupied')->default(false);
            $table->uuid('created_by_id');
            $table->timestamps();

            // Foreign key constraints
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
