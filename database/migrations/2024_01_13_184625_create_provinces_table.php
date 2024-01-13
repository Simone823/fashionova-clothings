<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('sigle', 2)->unique();
            $table->unsignedBigInteger('nation_id');
            $table->foreign('nation_id')->references('id')->on('nations')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('provinces');
    }
}