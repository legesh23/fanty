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
        Schema::create('fants', function (Blueprint $table) {
            $table->id();

            $table->text('text');
            $table->enum('level', [
                'light',
                'medium',
                'hard',
                'extreme'
            ]);
            $table->enum('sex', [
                'male',
                'female',
                'both'
            ]);

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
        Schema::dropIfExists('fants');
    }
};
