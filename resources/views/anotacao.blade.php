@extends('layouts.main')
<!--section linka com a yield do main.blade.php atraves do mesmo parametro passado entre ''-->
@section('title', 'anotacao')

@section('content')

<p>exibindo produto id {{$id}}</p>


@endsection