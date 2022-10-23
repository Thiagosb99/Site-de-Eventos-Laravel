<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event; // usar o model event aqui
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{
    public function index(){

          //var em php
   
                          //sintaxe para passar paramentos pela view, nome string = nome variavel
                          //da pra passar + de 1 parametro e de varios tipos de dado 

    $search = request('search');

    if($search){//verifica se há algum dado nessa variavel

        $events = Event::where('title','like','%'.$search.'%'// buscar por titulo que contar a palavra em $search, sintaxe é: like, % variavel %
        )->orWhere('date','like','%'.$search.'%')->get();// pega o dado com o filtro aplicado acima, orwhere equivaler a um or de if

    }else{

        $events=Event::all(); //chamar todos os dados que tiver em no model Event que puxa do banco, equivalente ao * do SQL
    }

    return view('wellcome',["events" => $events, 'search'=> $search]);
    }

    public function create(){

        return view("events.create");
    }

    
    public function entrar(){

        return view("events.entrar");
    }

    public function cadastrar(){

        return view("events.cadastrar");
    }

    public function store(Request $request){//request tem todos os dados de um form que usa o metodo post 

        $event = new Event; // estacio a classe do model referente a tabela events que a gente usou (use) lá em cima
        
        $event->title = $request->title; // em event no campo title vai receber o title que foi digitado em um form e guardado em request
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        //items olhar explicacao no model EVENT pois ele tem uma caracteristica especial
        $event->items = $request->items;

        //image upload

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;//pega a image salva no request
            $extension = $requestImage->extension();//pega o tipo de extensao do aquivo

            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;
            //md5() - cria uma hash de toda essa string ae em cima parsa
            //hash é uma criptografia de dados de uma string que trasforma uma string de tamanho variavel em uma codificada de tamanho fixo
            //$requestImage->getClientOriginalName() - pega o nome original do arquivo
            //strtotime("now") - pega a data atual

            $requestImage->move(public_path('img/events'), $imageName);// vai salvar a imagem mudada na pasta img/events

            $event->image = $imageName; // joga a path da img agora alterada no banco
        }

        $user = auth()->user();//pega os dados do usuario logado

        $event->user_id = $user->id;// passa o id do usuario logado para salvar na chave estrangeira da tabelas events


        $event->save(); // salva os dados acima no banco

        return redirect('/')->with("msg","evento criado com sucesso"); // volta pra pagina principal e exibe uma mensagem com o meto with('msg','mensagem');

    }

    public function show($id, Exception $e){

        try{
        $event = Event::findOrFail($id);

        $user= auth()->user();

        $hasUserJoined = false;

        if($user){//verifica se o user ta autenticado pela 2 vez

            $userEvents= $user->eventsAsParticipant->toArray();

            foreach($userEvents as $eventosusuario){
                if($eventosusuario['id']==$id){//['id'] = id dos eventos que o usuario participa
                                               //$id = id do evento da pagina 
                    $hasUserJoined = true;                       

                }
            }
        }

        $donoEvento = User::where('id','=',$event->user_id)->first()->toArray();//o firts() é pra pegar o 1 id e parar de executar, por exemplo o banco tem
                                                                                //10 mil linha se o id tiver na 2 linha ele só procurou em 2 linhas, sem o first ele ia correr as 10 mil linhas
        

        return view('events.show',['event'=>$event, 'donoEvento'=>$donoEvento, 'hasUserJoined'=>$hasUserJoined]);
        }catch (ModelNotFoundException $e){  
            return redirect('/')->with("msg","evento nao existe");
        }
    }

    public function dashboard(){
        $user = auth()->user();

        $events = $user->events; // events que vem do user esta no model User que esta com a relacao 1 user tem varios eventos

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard',['events'=>$events,'eventsAsParticipant'=>$eventsAsParticipant]);


    }
    public function destroy($id){
        Event::findOrFail($id)->delete();//metodo de deletar do laravel

        return redirect('/dashboard')->with('msg','Evento exluído com sucesso!');
    }

    public function edit($id){
        $user=auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user->id){ //impede que um usuario que nao seja dono de um determinado evento edite esse determinado evento
            return redirect('/dashboard');
        }

        return view('events.edit', ['event'=>$event]);

    }

    public function update(Request $request){

        $data = $request->all();  

       
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;//pega a image salva no request
            $extension = $requestImage->extension();//pega o tipo de extensao do aquivo

            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;
            //md5() - cria uma hash de toda essa string ae em cima parsa
            //hash é uma criptografia de dados de uma string que trasforma uma string de tamanho variavel em uma codificada de tamanho fixo
            //$requestImage->getClientOriginalName() - pega o nome original do arquivo
            //strtotime("now") - pega a data atual

            $requestImage->move(public_path('img/events'), $imageName);// vai salvar a imagem mudada na pasta img/events

            $data['image'] = $imageName; // joga a path da img agora alterada no banco
        }

         Event::findOrFail($request->id)->update($data);//procura o id do evento e usa o metodo update na variavel $data que contem todos os dados novos 

        return redirect('/dashboard')->with('msg','Evento editado com sucesso!');
    }

    public function joinEvent($id){

        $user = auth()->user();
         
        $user->eventsAsParticipant()->attach($id);//vai pegar o id do evento e colocar no metodo eventasparticipant e de la colocar na tabela event_user

        $event=Event::findOrFail($id);

        return redirect('/dashboard')->with('msg','sua presença esta confirmada no evento '.$event->title);


    }

    public function leaveEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);//vai pegar o id do evento e colocar no metodo eventasparticipant e de la retirar da tabela event_user

        $event=Event::findOrFail($id);

        return redirect('/dashboard')->with('msg','Voc~e saiu com sucesso do evento: '.$event->title);

    }
}
