<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsgbEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('osgb_employees', function (Blueprint $table) {
            $table->id();
            $table->char('user_type', 200);
            $table->char('firstname', 100);
            $table->char('lastname', 100);
            $table->char('email', 150);
            $table->char('phone', 16);
            $table->char('tc', 11);
            $table->date('start_at');
            $table->boolean('deleted');
            $table->text('worker_text');
            $table->timestamps();
            $table->foreign('email')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('osgb_employees');
    }
}
