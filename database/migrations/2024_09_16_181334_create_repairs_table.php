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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 50);
            $table->string('dni', 100);
            $table->integer('phone')->unsigned();
            $table->string('location', 150);
            $table->string('vehicle', 150);
            $table->string('image_path', 255)->nullable();
            $table->string('type_repair', 150);
            $table->integer('price')->unsigned();
            $table->string('details', 255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
