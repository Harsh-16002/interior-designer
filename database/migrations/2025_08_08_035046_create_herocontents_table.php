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
        Schema::create('herocontents', function (Blueprint $table) {
            $table->id();
            $table->string('slide_image');
            $table->string('heading');
            $table->string('fblink');
            $table->string('instralink');
            $table->string('twitterlink');
            $table->string('linkdinlink');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herocontents');
    }
};
