<?php

//para criar uma tabela many to many é preciso sergui a seguinte sintaxe
//php artisan make:migration create_nome da primeira tabela a ser ralcionada em ordem alfabetica_nome da segunda tabela a ser ralcionada em ordem alfabetica_table
//exemplo: php artisan make:migration create_nomeA_nomeB_table

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_user', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('event_user');
    }
}
