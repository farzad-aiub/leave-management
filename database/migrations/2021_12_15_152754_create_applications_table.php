<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('department');
            $table->string('admin_id');
            $table->integer('employee_id');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->integer('total_days')->nullable();
            $table->string('reason')->nullable();
            $table->string('stay')->nullable();
            $table->integer('approve')->nullable();
            $table->string('comment')->nullable();
            $table->string('return')->nullable();
            $table->string('sent')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
