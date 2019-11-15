<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {

            $table->string('cell_id')->primary();
            $table->string('site_id');
            $table->foreign('site_id')->references('site_id')->on('sites');
            $table->string('cell_name');
            $table->string('mnc');
            $table->string('status');
            $table->string('technology');
            $table->string('bcch_uarfcn_earfcn');
            $table->string('bsci_psc_pci');
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
        Schema::dropIfExists('cells');
    }
}