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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->enum('breed', 
                ['turkish_angora', 'siamese', 'scottish_fold', 'russian_blue', 'munchkin', 
                'korean_short_hair', 'snowshoe']);
            $table->enum('hair', ['white', 'grey', 'black', 'tricolor', 'tuxedo', 'mackerel_tabby', 'ginger']);
            $table->enum('role', ['mentor','mentee']);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
