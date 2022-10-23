<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts googles -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        <!-- css da aplicação -->
        <link rel="stylesheet" href="/css/styles.css">

        <!-- css bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <!-- javascript -->
        <script src="/js/scripts.js"></script>
    </head>
    <body>
        <!--yield linka com a sections do anotacoes.blade.php atraves do mesmo parametro passado entre ''-->
        <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                    <img src="/img/hdcevents_logo.svg" alt="logo">
                </a>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a href="/events/create" class="nav-link">Criar Eventos</a>
                    </li>

                    @guest<!-- Diretiva do proprio blade que identifica que tudo que esta dentro de guest é para usuario convidado(não logado)-->
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link">Cadastrar</a>
                    </li>
                    @endguest

                    @auth<!-- Diretiva do proprio blade que identifica que tudo que esta dentro de auth é para o usuario autemticado (que possui login no site)-->
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link"> Meus Eventos</a>
                    </li>
                    <li class="nav-item">
                        
                        <form action="/logout" method="POST">
                        @csrf
                        <!-- event.preventDefault(); this.closest('form').submit(); - forma de fazer logout dentro de uma tag a no LARAVEL -->
                        <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                        </form>
                    </li>
                    @endauth
                </ul>

            </div>
          
        </nav>
             </header>

            <main>
                <div class="container-fluid">
                    <div class="row">
                        @if(session('msg'))<!--verifica se há alguma mensagem no metodo with que esta sendo passada -->
                            <p class="msg">{{session("msg")}}</p><!--passa a mensagem com a mesma sintaxe-->
                        @endif
                         @yield('content')
                    </div>
                </div>
            </main>
    <footer>
        <p>HDC Events &copy; 2020</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"><ion-icon name="left-arrow"></ion-icon></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>