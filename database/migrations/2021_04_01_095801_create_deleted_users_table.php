<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeletedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_users', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('auth_type')->unsigned()->default(0);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('recruitment_date');
            $table->string('email')->unique();
            $table->string('tc')->unique();
            $table->string('phone');
            $table->string('profile_photo_path')->default('default.png');
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
        Schema::dropIfExists('deleted_users');
    }
}
