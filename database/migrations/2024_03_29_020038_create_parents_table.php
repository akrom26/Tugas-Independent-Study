<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->uuid('id_parent')->primary();
            $table->string('father_nik');
            $table->string('father_name');
            $table->date('father_birth_date');
            $table->string('father_birth_place');
            $table->string('father_job');
            $table->string('father_education');
            $table->string('father_income')->nullable();
            $table->string('father_phone');
            $table->string('mother_nik');
            $table->string('mother_name');
            $table->date('mother_birth_date');
            $table->string('mother_birth_place');
            $table->string('mother_job');
            $table->string('mother_education');
            $table->string('mother_income')->nullable();
            $table->string('mother_phone');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents');
    }
};
