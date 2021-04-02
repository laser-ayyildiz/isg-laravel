<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoopEmployeesTable extends Migration
{

    public function up()
    {
        Schema::create('coop_employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned()->index();
            $table->char('firstname', 100);
            $table->char('lastname', 100);
            $table->char('email', 150);
            $table->char('phone', 16);
            $table->char('tc', 11);
            $table->char('position', 200)->nullable();
            $table->date('contract_at');
            $table->boolean('deleted')->default(0);
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('coop_companies')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('coop_employees');
    }
}
