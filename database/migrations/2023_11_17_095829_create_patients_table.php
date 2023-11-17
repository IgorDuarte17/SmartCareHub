<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('mother_full_name');
            $table->date('birthday');
            $table->string('cpf', 14);
            $table->string('cns');
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('address_id');
            $table->timestamps();
        });

        Schema::table('patients', function(Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
