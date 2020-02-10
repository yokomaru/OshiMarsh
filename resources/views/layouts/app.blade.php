<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/utility.css') }}" rel="stylesheet"> 
    
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class='navbar-logo' src="{{ asset('images/LOVE.png') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          推し
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ url('/') }}">推し一覧</a>
                          <a class="dropdown-item" href="{{ route('create') }}" >押しを登録</a>
                          <!--<div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Something else here</a>-->
                        </div>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          カレンダー
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ url('/schedule') }}" >スケジュール</a>
                          <!--<div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Something else here</a>-->
                        </div>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('create') }}" class='nav-link'>
                            <i class="fas fa-plus"></i>推しを登録
                        </a>
                      </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main container main-top">
            @if (session('flash_message'))
                <div class="flash_message bg-success text-center py-3 my-0 mb30">
                    {{ session('flash_message') }}
                </div>
            @endif
            @yield('content')
        </main>
        <footer class='footer p20'>
          <small class='copyright'>OshiMarsh 2020 copyright</small>
        </footer>
    </div>
</body>
    <script>
    window.onload = function(){
    $('#modal-example').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
          var recipient = button.data('whatever') //data-whatever の値を取得

          console.log(recipient.title);
          //Ajaxの処理はここに
        if(typeof recipient.title == "undefined"){
            console.log("ss");
        }
        
        var modal = $(this);  //モーダルを取得
        console.log(modal);
        if(typeof recipient.title == "undefined"){
          console.log(recipient.substring(0, 4));
          console.log(recipient.substring(5, 7));
         modal.find('.modal-title').val('');
         modal.find('.modal-memo').val('');
         modal.find('.modal-name').val('');
         modal.find('.modal-starttimeat').val(''); 
         modal.find('.modal-endtimeat').val(''); 
         modal.find('.modal-day').val(recipient); 
         modal.find('.modal-starttimeat').val('');
         modal.find('.modal-endtimeat').val(''); 
         modal.find('.modal-year').val(recipient.substring(0, 4)); 
         modal.find('.modal-month').val(recipient.substring(5, 7)); 
         modal.find('.mordal-form').attr('action',  "/schedule/create/");
         modal.find('#schedule_submit').val('登録');
         modal.find('#schedule_delete').hide();
        }
        else{
          console.log(recipient.id);
         //modal.find('.modal-title').value('New message to ' + recipient) //モーダルのタイトルに値を表示
         modal.find('.modal-title').val(recipient.title);
         modal.find('.modal-memo').val(recipient.memo); 
         modal.find('.modal-day').val(recipient.day); 
         modal.find('.modal-starttimeat').val(recipient.start_time_at); 
         modal.find('.modal-endtimeat').val(recipient.end_time_at); 
         modal.find('.modal-id').val(recipient.id); 
         modal.find('.modal-oshi').val(recipient.oshi_id); 
         modal.find('.modal-year').val(recipient.day.substring(0, 4)); 
         modal.find('.modal-month').val(recipient.day.substring(5, 7)); 
         modal.find('.mordal-form').attr('action',  "/schedule/update/");
         modal.find('#schedule_submit').val('更新');
         modal.find('#schedule_delete').attr('href', '/schedule/delete/'+recipient.id);
         modal.find('#schedule_edit').attr('href', '/schedule/delete/'+recipient.id);
         modal.find('#schedule_delete').show();
        }
        })
    };

    </script>
</html>
