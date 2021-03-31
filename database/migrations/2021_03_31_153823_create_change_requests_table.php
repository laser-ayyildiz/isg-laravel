<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_requests', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id')->unsigned()->index();
            $table->char('type', 255);
            $table->string('name');
            $table->char('employer', 150);
            $table->char('email', 150);
            $table->char('phone', 16);
            $table->string('address', 500);
            $table->char('city', 50);
            $table->char('town', 50);
            $table->date('contract_at');
            $table->integer('remi_freq')->nullable();
            $table->char('nace_kodu', 30);
            $table->char('mersis_no', 30);
            $table->char('sgk_sicil', 30);
            $table->char('vergi_no', 30);
            $table->string('vergi_dairesi');
            $table->char('katip_is_yeri_id');
            $table->char('katip_kurum_id');
            $table->bigInteger('changer')->unsigned()->index()->nullable();
            $table->timestamps();

            //Foreign Keys
            $table->foreign('changer')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('coop_companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('change_requests');
    }
}
