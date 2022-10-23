{{--@extends = adiciona uma estrututa de arquivo no arquivo atual. No caso esta adicionando o main.blade.php que esta na pasta layouts--}}

@extends('layouts.main')
<!--section linka com a yield do main.blade.php atraves do mesmo parametro passado entre ''-->
@section('title', 'HDC events')

@section('content')

<div id="search-container" class="col-md12">
    <h1>Busque um evento</h1>
    <form action="/" method="GET"><!--GET para somente pegar informações-->
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>

</div>

<div id="events-container" class="col-md-12">
    @if($search)
        <h2>Buscando por: {{$search}}</h2>
    @else
        <h2>Próximos eventos</h2>    
        <p class="subtitles">veja os eventos dos próximos dias</p>
    @endif
    
    <div id="cards-container" class="row">
        @foreach($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                <div class="card-body">
                    <!--date('d/m/y', strtotime($event->date)) - formata a data para o brasil-->
                    <p class="card-date">{{date('d/m/y', strtotime($event->date))}}</p>
                    <h5 class="card-title">{{$event->title}}</h5>
                    <p class="card-participants">{{count($event->users)}} Participantes</p>
                    <a href="/events/{{$event->id}}" class="btn btn-primary">saber mais</a>
                </div>
            </div>
        @endforeach

        @if(count($events) == 0 && $search)
            <p>não foi possivel encontrar nenhum evento com {{$search}} <a href="/">Vert todos os eventos</a></p>
        @elseif(count($events) == 0)
            <p>Não há eventos disponiveis</p>
        @endif
    </div>
</div>

@endsection