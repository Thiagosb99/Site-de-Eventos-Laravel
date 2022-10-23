<?php

/*
######### comandos migrate importantes #################

php artisan migrate - executa as migrates todas do laravel e cria as tabelas
php artisan make:migration create_products_table - cria uma migration nova com  o nome products
php artisan make:migration add_category_to_products_table - adiciona uma coluna nova na tabela (no caso category) products a parte (usado qundo é necessario criar uma coluna nova porem com dados já existentes antes na tabela)
php artisan migrate:rollback - apaga essa coluna nova ^ sem apagar os outros dados das outras colunas
php artisan migrate:reset - apaga tudo do banco
php artisan migrate:refresh - faz o rollback de tudo e faz a migrate novamente (mas nesse caso é melhor usar o fresh)
php artisan migrate:rollback - apaga essa coluna nova ^ sem apagar os outros dados das outras colunas
php artisan migrate:status - mostra os status das migrations que foram ou n foram executadas
php artisan migrate:fresh - apaga a tabela e cria denovo com atualizacoes caso feitas		*/ 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('city');
            $table->boolean('private');
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
        Schema::dropIfExists('events');
    }
}
