<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyFileTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_file_types', function (Blueprint $table) {
            $table->id();
            $table->text('file_name');
            $table->integer('validity_period_type_1')->nullable();
            $table->integer('validity_period_type_2')->nullable();
            $table->integer('validity_period_type_3')->nullable();
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
        Schema::dropIfExists('company_file_types');
    }
}
