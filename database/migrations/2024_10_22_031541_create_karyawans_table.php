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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->string('nuptk')->primary();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('no_hp');
            $table->string('foto')->nullable();
            $table->string('password');
            $table->string('reset_token')->nullable();
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
        Schema::table('karyawans', function (Blueprint $table) {
            $table->string('reset_token')->nullable(false)->change();
        });
    }
};
