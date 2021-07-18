<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('coop_companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('employee_id')->nullable()->constrained('coop_employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('assignment_file_id')->nullable()->constrained('files')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('osgb_employee_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('isveren')->nullable();
            $table->string('group')->nullable();
            $table->string('sub_group')->nullable();
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
        Schema::dropIfExists('employee_groups');
    }
}
