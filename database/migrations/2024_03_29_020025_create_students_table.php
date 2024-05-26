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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id_student')->primary();
            $table->string('id_parent')->nullable();
            $table->string('id_origin_school')->nullable();
            $table->string('id_school_class')->nullable();
            $table->unsignedBigInteger('id_province')->nullable();
            $table->unsignedBigInteger('id_city')->nullable();
            $table->unsignedBigInteger('id_district')->nullable();
            $table->unsignedBigInteger('id_village')->nullable();
            $table->string('nis')->nullable();
            $table->string('nik');
            $table->date('date_birth');
            $table->string('place_birth');
            $table->string('gender');
            $table->string('photo')->nullable();
            $table->string('identity')->nullable();
            $table->longText('address');
            $table->string('pos_code')->nullable();
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
        Schema::dropIfExists('students');
    }
};
