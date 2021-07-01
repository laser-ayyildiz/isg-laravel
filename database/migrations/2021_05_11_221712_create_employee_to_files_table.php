<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_to_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_type')->constrained('employee_education_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('employee_id')->constrained('coop_employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('file_id')->constrained('files')->onUpdate('cascade')->onDelete('cascade');
            $table->date('assigned_at')->nullable();
            $table->date('valid_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('employee_to_file');
    }
}
