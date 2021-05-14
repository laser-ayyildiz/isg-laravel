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
            $table->foreignId('company_id')->constrained('coop_companies')->onDelete('cascade')->onUpdate('cascade');
            $table->char('name', 250);
            $table->char('email', 150)->nullable();
            $table->char('phone', 16)->nullable();
            $table->char('tc', 11)->unique();
            $table->char('position', 200)->nullable();
            $table->date('recruitment_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('coop_employees');
    }
}
