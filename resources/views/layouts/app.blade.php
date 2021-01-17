<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    @yield('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="shadow position-fixed d-flex align-items-center bg-white" style="width:100%;height:55px;z-index:100000;">
            <div class="container-fluid d-flex justify-content-between align-items-center ">
                <div class="">
                    <a class="navbar-brand text-dark" href="{{ route('forum') }}" style="font-weight: 600;font-size: 25px;">
                        {{ config('app.name', 'LaraForums') }}
                    </a>
                </div>
                <div class="d-none d-md-flex align-items-center">
                    @guest
                        @if (Route::has('login'))
                            <div class="mr-3">
                                <a class=" text-secondary text-decoration-none" href="{{ route('login') }}">Login</a>
                            </div>
                        @endif
                        
                        @if (Route::has('register'))
                            <div class="">
                                <a class="text-secondary text-decoration-none" href="{{ route('register') }}">Register</a>
                            </div>
                        @endif
                    @else
                        <?php $noti_count=auth()->user()->unreadNotifications()->count()?>
                        <div class=" dropdown">
                            <a id="navbarDropdown" class="text-decoration-none text-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-decoration-none text-secondary" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
                <div class="f-flex align-items-center d-md-none hamberger">
                    <svg class="icon icon-menu" onclick="open_sidebar()" viewBox="0 0 32 32"><path d="M2 6h28v6h-28zM2 14h28v6h-28zM2 22h28v6h-28z"></path></svg>
                    <svg class="icon icon-cross icon-cross-sidebar d-none" viewBox="0 0 32 32" onclick="close_sidebar()">
                        <path d="M31.708 25.708c-0-0-0-0-0-0l-9.708-9.708 9.708-9.708c0-0 0-0 0-0 0.105-0.105 0.18-0.227 0.229-0.357 0.133-0.356 0.057-0.771-0.229-1.057l-4.586-4.586c-0.286-0.286-0.702-0.361-1.057-0.229-0.13 0.048-0.252 0.124-0.357 0.228 0 0-0 0-0 0l-9.708 9.708-9.708-9.708c-0-0-0-0-0-0-0.105-0.104-0.227-0.18-0.357-0.228-0.356-0.133-0.771-0.057-1.057 0.229l-4.586 4.586c-0.286 0.286-0.361 0.702-0.229 1.057 0.049 0.13 0.124 0.252 0.229 0.357 0 0 0 0 0 0l9.708 9.708-9.708 9.708c-0 0-0 0-0 0-0.104 0.105-0.18 0.227-0.229 0.357-0.133 0.355-0.057 0.771 0.229 1.057l4.586 4.586c0.286 0.286 0.702 0.361 1.057 0.229 0.13-0.049 0.252-0.124 0.357-0.229 0-0 0-0 0-0l9.708-9.708 9.708 9.708c0 0 0 0 0 0 0.105 0.105 0.227 0.18 0.357 0.229 0.356 0.133 0.771 0.057 1.057-0.229l4.586-4.586c0.286-0.286 0.362-0.702 0.229-1.057-0.049-0.13-0.124-0.252-0.229-0.357z"></path>
                    </svg>
                </div>
            </div>
        </nav>





        <div class="sidebar-small position-fixed overflow-auto mt-1 d-md-none d-block shadow">
            <div class="">
                <div class="container pt-4 py-5">
                    @auth
                        @if(Auth::user()->is_user_admin())
                            <a href="{{route('channel.create')}}" class="btn btn-primary d-block mb-4">Add a new channel</a>
                        @endif
                            <a href="{{route('discussion.create')}}" class=" text-white btn d-block mb-4" style="background:#6f42c1;">Add a new discussion</a>
                    @else
                            <a href="{{route('login')}}" class=" btn-success btn d-block mb-4">Sign in to add a new discussion</a>
                    @endauth
                    <div class="list-group  mb-5">
                        <a class="line_1 list-group-item list-group-item-action d-flex justify-content-between {{request()->is('/') && !request()->query('mydiscussions') && !request()->query('channel')?'bg-secondary text-white':''}}" href="{{route('forum')}}">Home</a>
                        @auth
                            <a class="line_1 list-group-item list-group-item-action d-flex justify-content-between {{request()->is('notifications')?'bg-secondary text-white':''}}" href="{{route('notificaion.show')}}">
                                <span>Notifications</span>
                                @if($noti_count>0)
                                    <span class="badge bg-primary  text-white d-flex align-items-center justify-content-between">{{$noti_count}}</span>
                                @endif
                            </a>
                            <a class="line_1 list-group-item list-group-item-action d-flex justify-content-between {{request()->query('mydiscussions') && request()->query('mydiscussions')=='yes'?'bg-secondary text-white':''}}" href="{{route('forum').'?mydiscussions=yes'}}"><span>My Discussions</span></a>
                        @endauth
                    </div>
                    <div class="d-inline pt-3">
                        <span ><h4 class="d-inline">Channels</h4></span>
                        <a class="float-right pr-2" href="{{route('channel.index')}}">Manage</a>
                    </div>
                    
                    <div class="list-group  list-group-flush">
                        @foreach($channels as $channel)
                            <a href="{{route('forum').'?channel='.$channel->slug}}" class="line_1 text-break list-group-item list-group-item-action d-flex justify-content-between {{request()->query('channel') && request()->query('channel')==$channel->slug?'bg-secondary text-white':''}}">
                                <span>{{ucFirst($channel->name)}}</span>
                                <span class="badge bg-primary  text-white d-flex align-items-center justify-content-between" style="max-height:20px;">{{$channel->discussions->count()}}</span>
                            </a>
                        @endforeach
                    </div>
                    @auth
                        <form  action="{{ route('logout') }}" method="POST"  class="my-4">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="width:100%;">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>







        <main  style="background-color:#f1f2f7;">
            <div class=" pt-5">
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
                    <div class=" position-relative d-md-flex" style="padding-top:56px;">
                        <div class="d-none d-md-block sidebar_cont">
                            <div class=" sidebar bg-white py-5 px-3">
                                @auth
                                    @if(Auth::user()->is_user_admin())
                                        <a href="{{route('channel.create')}}" class="btn btn-primary d-block mb-4">Add a new channal</a>
                                    @endif
                                        <a href="{{route('discussion.create')}}" class=" text-white btn d-block mb-4" style="background:#6f42c1;">Add a new discussion</a>
                                @else
                                        <a href="{{route('login')}}" class=" btn-success btn d-block mb-4">Sign in to add a new discussion</a>
                                @endauth
                                <div class="list-group  mb-5">
                                    <a class="line_1 list-group-item list-group-item-action d-flex justify-content-between {{request()->is('/') && !request()->query('mydiscussions') && !request()->query('channel')?'bg-secondary text-white':''}}" href="{{route('forum')}}">Home</a>
                                    @auth
                                        <a class=" line_1 list-group-item list-group-item-action d-flex justify-content-between {{request()->is('notifications')?'bg-secondary text-white':''}}" href="{{route('notificaion.show')}}">
                                            <span>Notifications</span>
                                            @if($noti_count>0)
                                                <span class="badge bg-primary  text-white d-flex align-items-center justify-content-between">{{$noti_count}}</span>
                                            @endif
                                        </a>
                                        <a class="line_1 list-group-item list-group-item-action d-flex justify-content-between {{request()->query('mydiscussions') && request()->query('mydiscussions')=='yes'?'bg-secondary text-white':''}}" href="{{route('forum').'?mydiscussions=yes'}}"><span>My Discussions</span></a>
                                    @endauth
                                </div>
                                <div class="d-inline pt-3">
                                    <span ><h4 class="d-inline">Channels</h4></span>
                                    <a class="float-right pr-2" href="{{route('channel.index')}}">Manage</a>
                                </div>
                                
                                <div class="list-group">
                                    @foreach($channels as $channel)
                                        <a href="{{route('forum').'?channel='.$channel->slug}}" class="line_1 text-break list-group-item list-group-item-action d-flex justify-content-between {{request()->query('channel') && request()->query('channel')==$channel->slug?'bg-secondary text-white':''}}">
                                            <span >{{ucFirst($channel->name)}}</span>
                                            <span class="badge bg-primary  text-white d-flex align-items-center justify-content-between" style="max-height:20px;">{{$channel->discussions->count()}}</span>
                                        </a>
                                    @endforeach
                                </div>
                                    
                            </div>
                        </div>
                        
                        <div class="mx-3 mx-md-5 main_container" style="min-width:0;">
                            @yield('content')
                        </div>
                    </div>

                    <footer class="d-md-flex">
                        <div class="d-none d-md-block footer_side"></div>
                        <div class="mt-5 py-3 border-top border-top-secondary" style="flex-grow:1;">
                            <div class="text-center text-secondary">Copyright © {{\Carbon\Carbon::parse(now())->format('Y')}} <a href="{{route('forum')}}"class="text-primary"> {{ config('app.name', 'LaraForums') }}</a>. All rights reserved.</div>
                        </div>
                    </footer>
                    @else
                        <div class="row no-gutters px-3 justify-content-center" style="padding-top:56px;min-height:calc(100vh - 48px);">
                            @yield('content')
                        </div>
                    @endif
            </div>
        </main>
    </div>
    {{--<script src="{{asset('js/svg4everybody.min.js')}}"></script>
    <script>svg4everybody();</script>--}}
    <script defer src="{{asset('node_modules/svgxuse/svgxuse.js')}}"></script>
    <script>
        function noti_hide(){
            $('.notification').css('opacity','0');
            $('.notification').css('transform','translateX(120%)');

        }
        setTimeout(function(){
            $('.notification').slideUp(100).fadeOut(100);
        },6000)
        function open_sidebar(){
            $('.sidebar-small').css('transform','translateX(0%)');
            $('body').css('overflow','hidden');
            $('.icon-cross-sidebar').toggleClass('d-none');
            $('.icon-menu').addClass('d-none');
        }

        function close_sidebar(){
            $('body').css('overflow','auto');
            $('.icon-menu').toggleClass('d-none');
            $('.icon-cross-sidebar').addClass('d-none');
            $('.sidebar-small').css('transform','translateX(110%)');
        }
    </script>
    @yield('script')
</body>
</html>
