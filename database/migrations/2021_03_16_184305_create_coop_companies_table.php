<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoopCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('coop_companies', function (Blueprint $table) {
            $table->id();
            $table->char('type', 255);
            $table->string('name');
            $table->char('employer', 150);
            $table->char('email', 150);
            $table->char('phone', 16);
            $table->string('address', 500);
            $table->char('city', 50);
            $table->char('town', 50);
            $table->date('contract_at');
            $table->char('nace_kodu', 30);
            $table->char('mersis_no', 30);
            $table->char('sgk_sicil', 30);
            $table->char('vergi_no', 30);
            $table->string('vergi_dairesi');
            $table->char('katip_is_yeri_id');
            $table->char('katip_kurum_id');
            $table->bigInteger('uzman_id')->unsigned()->index()->nullable();
            $table->bigInteger('uzman_id_2')->unsigned()->index()->nullable();
            $table->bigInteger('uzman_id_3')->unsigned()->index()->nullable();
            $table->bigInteger('hekim_id')->unsigned()->index()->nullable();
            $table->bigInteger('hekim_id_2')->unsigned()->index()->nullable();
            $table->bigInteger('hekim_id_3')->unsigned()->index()->nullable();
            $table->bigInteger('saglık_p_id')->unsigned()->index()->nullable();
            $table->bigInteger('saglık_p_id_2')->unsigned()->index()->nullable();
            $table->bigInteger('ofis_p_id')->unsigned()->index()->nullable();
            $table->bigInteger('ofis_p_id_2')->unsigned()->index()->nullable();
            $table->bigInteger('muhasebe_p_id')->unsigned()->index()->nullable();
            $table->bigInteger('muhasebe_p_id_2')->unsigned()->index()->nullable();
            $table->bigInteger('yetkili_id')->unsigned()->index()->nullable();
            $table->char('change', 2)->nullable();
            $table->integer('remi_freq')->nullable();
            $table->char('changer', 100)->nullable();
            $table->boolean('deleted')->nullable();
            $table->timestamps();
            $table->foreign('uzman_id')->references('id')->on('osgb_employees');
            $table->foreign('uzman_id_2')->references('id')->on('osgb_employees');
            $table->foreign('uzman_id_3')->references('id')->on('osgb_employees');
            $table->foreign('hekim_id')->references('id')->on('osgb_employees');
            $table->foreign('hekim_id_2')->references('id')->on('osgb_employees');
            $table->foreign('hekim_id_3')->references('id')->on('osgb_employees');
            $table->foreign('saglık_p_id')->references('id')->on('osgb_employees');
            $table->foreign('saglık_p_id_2')->references('id')->on('osgb_employees');
            $table->foreign('ofis_p_id')->references('id')->on('osgb_employees');
            $table->foreign('ofis_p_id_2')->references('id')->on('osgb_employees');
            $table->foreign('muhasebe_p_id')->references('id')->on('osgb_employees');
            $table->foreign('muhasebe_p_id_2')->references('id')->on('osgb_employees');
            $table->foreign('yetkili_id')->references('id')->on('osgb_employees');
        });
    }

    public function down()
    {
        Schema::dropIfExists('coop_companies');
    }
}
/*

*/
