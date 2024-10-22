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
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->string('nuptk')->nullable();
            $table->date('tgl_izin')->nullable();
            $table->char('status', 10)->nullable();
            $table->text('keterangan')->nullable();
            $table->char('status_approved', 10)->nullable();
            $table->foreign('nuptk')->references('nuptk')->on('karyawans')->onDelete('cascade');
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
        Schema::dropIfExists('izins');
    }
};
