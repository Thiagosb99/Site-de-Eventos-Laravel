<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();//sintaxe para criar uma chave estrangeira de outra tabela para relacionalas
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');//sintaxe para excuir essa coluna e eventos realcionados a ela
        });
    }
}
