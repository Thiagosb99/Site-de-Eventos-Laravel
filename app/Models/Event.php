<?php


/* ##comandos model artisan

php artisan make:model Nomedomodel (sempre com letra maiuscula)

o model padrao consegue acessar uma table no banco se quando criado o nome do model seja EXATAMENTE dessa maneira
- o nome da tabela tem que estar em plural com tudo minusculo
- o nome do model tem que ser o nome da tabela em singular com a 1 letra maiuscula

nesse caso: nome tabela = events 
            nome model = Event

com isso já é possivel puxar infos do banco referente a essa tabela

*/


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
//esses casts informa que a coluna items ira receber no banco de dados dados em array e nao em string (string é o padrao entao aqui mudamo o padrao com relação a coluna nova items)
    protected $casts=[
        'items'=>'array'
    ];
//mesma coisa do casts, pois foram campos criados depois que não sao strings (que é o tipo de dado padrao)
    protected $dates=['date'];

    protected $guarded=[]; //$guarded - é uma var do proprio blade para corrigir esse erro = corrigi o erro Add [_token] to fillable property to allow mass assignment on
                           // basicamente isso permite alterar todos os dados pelo update()

//metodo relacao 1 pra muitos, nesse caso desse model varios eventos para um usuario
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

//metodo relacao muitos pra muitos chamando varios eventos para varios users
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
