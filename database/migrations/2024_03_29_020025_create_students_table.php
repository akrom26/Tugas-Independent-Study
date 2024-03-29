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
            $table->string('id_parent');
            $table->string('id_origin_school');
            $table->string('id_school_class');
            $table->unsignedBigInteger('id_province');
            $table->unsignedBigInteger('id_city');
            $table->unsignedBigInteger('id_district');
            $table->unsignedBigInteger('id_village');
            $table->string('nis')->nullable();
            $table->string('nik');
            $table->date('date_birth');
            $table->string('place_birth');
            $table->string('gender');
            $table->string('photo');
            $table->string('identity');
            $table->longText('address');
            $table->string('pos_code');
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
