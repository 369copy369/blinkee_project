<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazineAndPublisherColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazine', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('publisher_id')->unsigned()->index()->foreign()->references("id")->on("publishers");
            $table->timestamps();
        });

        Schema::create('publisher', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
        Schema::dropIfExists('magazine');
        Schema::dropIfExists('publisher');
    }
}
