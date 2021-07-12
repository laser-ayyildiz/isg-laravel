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
            $table->text('bill_address')->nullable();
            $table->text('address')->nullable();
            $table->string('city');
            $table->string('town');
            $table->enum('danger_type', [1, 2, 3])
                ->nullable();
            $table->string('nace_kodu')
                ->nullable();
            $table->string('mersis_no')
                ->nullable()
                ->unique();
            $table->string('sgk_sicil')
                ->nullable()
                ->unique();
            $table->string('vergi_no')
                ->nullable();
            $table->string('vergi_dairesi')
                ->nullable();
            $table->string('katip_is_yeri_id')
                ->nullable();
            $table->string('katip_kurum_id')
                ->nullable();
            $table->date('contract_at')
                ->default(date('Y-m-d H:i:s'));
            $table->boolean('is_group')
                ->default(false);
            $table->enum('group_status', ['member', 'leader'])
                ->nullable();
            $table->foreignId('leader_company_id')
                ->nullable()
                ->constrained('coop_companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coop_companies');
    }
}
