<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('update_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('coop_companies')->onUpdate('cascade')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('employer', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone')->nullable();
            $table->string('address', 500)->nullable();
            $table->string('city')->nullable();
            $table->string('town')->nullable();
            $table->smallInteger('danger_type')->nullable();
            $table->integer('remi_freq')->nullable();
            $table->string('nace_kodu')->nullable();
            $table->string('mersis_no')->nullable();
            $table->string('sgk_sicil')->nullable();
            $table->string('vergi_no')->nullable();
            $table->string('vergi_dairesi')->nullable();
            $table->string('katip_is_yeri_id')->nullable();
            $table->string('katip_kurum_id')->nullable();
            $table->date('contract_at')->nullable();
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
        Schema::dropIfExists('table_update_requests');
    }
}
