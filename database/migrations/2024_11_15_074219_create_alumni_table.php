<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id(); // ID Alumni, tipe integer dan auto-increment
            $table->string('name'); // Nama Alumni, tipe string
            $table->string('phone'); // No HP Alumni, tipe string
            $table->text('address'); // Alamat Alumni, tipe text
            $table->integer('graduation_year'); // Tahun Lulus, tipe integer
            $table->string('status'); // Status Alumni, tipe string
            $table->string('company_name'); // Nama Perusahaan, tipe string
            $table->string('position'); // Pekerjaan, tipe string
            $table->timestamps(); // Timestamp, tipe timestamp (created_at dan updated_at otomatis)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
