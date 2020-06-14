<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGivingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giving', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date')->nullable(); // date
            $table->integer('giving');  // giving amount
            $table->string('purpose')->nullable();  // purpose
            $table->string('user_id');
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
        Schema::dropIfExists('giving');
    }
}
