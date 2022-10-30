<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddOparetorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oparetors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('branch');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('department');
            $table->string('password');
            $table->string('role');
            $table->string('is_active');
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
        Schema::dropIfExists('oparetors');
    }
}
