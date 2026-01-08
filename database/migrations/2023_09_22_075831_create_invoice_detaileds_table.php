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
        Schema::create('invoice_detaileds', function (Blueprint $table) {
            $table->id();
            $table->double('price');
            $table->integer('total');
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('invoice_id')->constrained('invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_detaileds');
    }
};
