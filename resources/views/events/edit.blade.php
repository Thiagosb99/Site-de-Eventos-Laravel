@extends("layouts.main")

@section("title","Editando: ". $event->title)

@section("content")

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{$event->title}}</h1>
    <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data"> <!--enctype="multipart/form-data" é a 
                                                                        configuração pra poder enviar/ subir arquivo em um formulario em html -->

        @csrf <!-- <--- segurança com relação a formularios do proprio laravel, sempre bom colcoar quando estamos fazendo um form em laravel-->
        @method('PUT'){{--para usar o metodo update do laravel é necesario um form com post e só depois informar dentro do form o @method('PUT') para o laravel entender--}}
        <div class="form-group">
            <label for="image">Imagem Evento:</label>
           <input type="file" id="image" name="image" class="form-control-file">
           <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-preview">
        </div>
        
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{$event->title}}">
        </div>
        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{$event->date->format('Y-m-d')}}">
        </div>
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="local do evento" value="{{$event->city}}">
        </div>
        <div class="form-group">
            <label for="title">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">não</option>
                <option value="1" {{$event->private == 1 ? "selected='selected'" : ""}}>sim</option>

            </select>
        </div>
        <div class="form-group">
            <label for="title">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="o que vai acontecer no evento">{{$event->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="title">adicione itens de infraestrutura:</label>
            <div class="form-group">
                <!-- para enviar um array de items tem que colocar no name couchetes []-->
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
            </div>

            <div class="form-group">
                <!-- para enviar um array de items tem que colocar no name couchetes []-->
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>

            <div class="form-group">
                <!-- para enviar um array de items tem que colocar no name couchetes []-->
                <input type="checkbox" name="items[]" value="Cerveja grátis"> Cerveja grátis
            </div>
           
            <div class="form-group">
                <!-- para enviar um array de items tem que colocar no name couchetes []-->
                <input type="checkbox" name="items[]" value="Open food"> Open food
            </div>

            <div class="form-group">
                <!-- para enviar um array de items tem que colocar no name couchetes []-->
                <input type="checkbox" name="items[]" value="Brindes"> Brindes
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="criar evento">
    </form>

</div>

@endsection