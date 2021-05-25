<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_to_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leader_id')->constrained('coop_companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('member_id')->constrained('coop_companies')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('company_to_groups');
    }
}
