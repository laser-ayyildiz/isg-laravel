<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeletedCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_companies', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('employer', 150);
            $table->string('email', 150);
            $table->string('phone');
            $table->string('address', 500);
            $table->string('city');
            $table->string('town');
            $table->integer('remi_freq')->nullable();
            $table->string('nace_kodu')->nullable();
            $table->string('mersis_no')->nullable();
            $table->string('sgk_sicil')->nullable();
            $table->string('vergi_no')->nullable();
            $table->string('vergi_dairesi')->nullable();
            $table->string('katip_is_yeri_id')->nullable();
            $table->string('katip_kurum_id')->nullable();
            $table->char('change', 2)->nullable()->default(0);
            $table->date('contract_at')->default(date('Y-m-d H:i:s'));
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
        Schema::dropIfExists('deleted_companies');
    }
}
