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
    Schema::create('options', function (Blueprint $table) {
        $table->id();

        $table->string('name');

        $table->boolean('is_required')
              ->default(false);

        $table->integer('min_selection')
              ->default(0);

        $table->integer('max_selection')
              ->default(1);

        $table->boolean('is_active')
              ->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
