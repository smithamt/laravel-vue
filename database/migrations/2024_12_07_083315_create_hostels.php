<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('address');
            $table->integer('capacity');
            $table->uuid('companyId',);
            $table->uuid('createdById',);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hostels');
    }
}
