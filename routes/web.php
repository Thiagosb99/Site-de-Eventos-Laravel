<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//para poder usar um determinado controle precisa importar primeiro
use App\Http\Controllers\Eventcontroller;

                // essa é a sintaxe para passar um função especifica de um controller em uma rota, no caso a rota home vai ter os codigos da funcao index do controleer eventcontroler
Route::get('/', [Eventcontroller::class, 'index']);
                                                            //middleware - é uma ação que acontece entre clicar no link e enviar a rota create, 
                                                            //nesse caso ele ta testando se apos eu clicar na rota create ele verifica se eu to logado 'auth'
                                                            //se nao tiver eu vou ter que logar para poder acessar essa rota caso o contrario eu nao acesso
Route::get("/events/create",[Eventcontroller::class, "create"])->middleware('auth');
Route::get("/events/{id}",[Eventcontroller::class, "show"]);
Route::post("/events",[Eventcontroller::class,'store']); // events é referente a action do form, quando action="/events" significa que quando aquele form com essa action for ativado ele vira pra essa rota
Route::delete('/events/{id}',[Eventcontroller::class, 'destroy'])->middleware('auth');//sintaxe deletar dados no banco
Route::get('/events/edit/{id}',[Eventcontroller::class, 'edit'])->middleware('auth');
Route::put('events/update/{id}',[Eventcontroller::class,'update'])->middleware('auth');

/*
Route::get("/events/entrar",[Eventcontroller::class , "entrar"]);

Route::get("/events/cadastrar", [Eventcontroller::class, "cadastrar"]);


Route::get('/anotacoes/{id}',function($id){

    return view('anotacao',['id' =>$id ]);
});
*/

Route::get('/dashboard',[Eventcontroller::class, 'dashboard'])->middleware('auth');

Route::post('/events/join/{id}',[Eventcontroller::class, 'joinEvent'])->middleware('auth');

Route::delete('/events/leave/{id}',[Eventcontroller::class,'leaveEvent'])->middleware('auth');
