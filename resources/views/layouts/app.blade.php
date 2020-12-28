<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        {{--93.22px--}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm position-fixed " style="width:100%;height:55px;z-index:100000;">
            <div class="container">
                <a class="navbar-brand" href="{{ route('forum') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pb-4 pt-5">
            <div class="container pt-4">
                @if (session('success'))
                    <div class="notification">
                        <span>{{ session('success') }}</span>
                        <a href="javascript:void(0)" onclick="noti_hide()" class="text-white text-decoration-none ml-4 float-right">
                            <strong>X</strong>
                         </a>
                    </div>
                @endif
                @if (session('error'))
                    <div class="notification danger">
                        <span>{{ session('error') }}</span>
                        <a href="javascript:void(0)" onclick="noti_hide()" class="text-white text-decoration-none ml-4 float-right">
                           <strong>X</strong>
                        </a>
                    </div>
                @endif
                @if(!Request::is('login') && !Request::is('register'))
                    <div class="row justify-content-center">
                        <div class="col-md-4 position-relative sidebar_cont">
                            <div class="position-fixed sidebar">
                                @auth
                                    @if(Auth::user()->is_user_admin())
                                        <a href="{{route('channel.create')}}" class="btn btn-primary d-block mb-4">Add a new channal</a>
                                    @endif
                                        <a href="{{route('discussion.create')}}" class=" text-white btn d-block mb-4" style="background:#6f42c1;">Add a new discussion</a>
                                @else
                                        <a href="{{route('login')}}" class=" btn-success text-white btn d-block mb-4">Sign in to add a new discussion</a>
                                @endauth
                                <div class="list-group  mb-5">
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between" href="{{route('forum')}}">Home</a>
                                    @auth
                                        <a class="list-group-item list-group-item-action d-flex justify-content-between" href="{{route('notificaion.show')}}">
                                            <span>Notifications</span>
                                            <?php $noti_count=auth()->user()->unreadNotifications()->count()?>
                                            @if($noti_count>0)
                                                <span class="badge bg-primary  text-white d-flex align-items-center justify-content-between">{{$noti_count}}</span>
                                            @endif
                                        </a>
                                        <a class="list-group-item list-group-item-action d-flex justify-content-between" href="{{route('forum')}}"><span>My Discussions</span></a>
                                    @endauth
                                </div>
                                <div class="d-inline pt-3">
                                    <span ><h4 class="d-inline">Channels</h4></span>
                                    <a class="float-right pr-2" href="{{route('channel.index')}}">Manage</a>
                                </div>
                                
                                <div class="list-group  ">
                                    @foreach($channels as $channel)
                                        <a href="{{route('forum').'?channel='.$channel->slug}}" class="list-group-item list-group-item-action d-flex justify-content-between">
                                            <span>{{ucFirst($channel->name)}}</span>
                                            <span class="badge bg-primary  text-white d-flex align-items-center justify-content-between">{{$channel->discussions->count()}}</span>
                                        </a>
                                    @endforeach
                                </div>
                                    
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            @yield('content')
                        </div>
                    </div>
                    @else
                        <div class="row justify-content-center">
                            @yield('content')
                        </div>
                    @endif
            </div>
        </main>
    </div>
    <script>
        function noti_hide(){
            $('.notification').css('opacity','0');
            $('.notification').css('transform','translateX(120%)');

        }
    </script>
</body>
</html>
