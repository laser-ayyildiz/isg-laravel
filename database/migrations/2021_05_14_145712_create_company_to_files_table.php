<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_to_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_type')->constrained('company_file_types')->onUpdate('cascade');
            $table->foreignId('company_id')->constrained('coop_companies')->onUpdate('cascade');
            $table->foreignId('file_id')->constrained('files')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('assigned_at')->nullable();
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
        Schema::dropIfExists('company_to_files');
    }
}
