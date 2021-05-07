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
            $table->string('type');
            $table->string('name');
            $table->string('employer', 150);
            $table->string('email', 150);
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->string('town');
            $table->smallInteger('danger_type')->nullable();
            $table->integer('remi_freq')->nullable();
            $table->string('nace_kodu')->nullable();
            $table->string('mersis_no')->nullable();
            $table->string('sgk_sicil')->nullable();
            $table->string('vergi_no')->nullable();
            $table->string('vergi_dairesi')->nullable();
            $table->string('katip_is_yeri_id')->nullable();
            $table->string('katip_kurum_id')->nullable();
            $table->date('contract_at')->default(date('Y-m-d H:i:s'));
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coop_companies');
    }
}
