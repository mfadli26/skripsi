<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('archive');
        Schema::create('archive', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('archive_number');
            $table->string('serial_number');
            $table->string('type');
            $table->timestamp('archive_date');
            $table->string('title');
            $table->string('owner_address');
            $table->string('building_address');
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
        Schema::dropIfExists('archive');
    }
}
