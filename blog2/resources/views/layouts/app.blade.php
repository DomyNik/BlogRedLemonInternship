<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    {{--  <link rel="stylesheet" type="text/css" href="semantic-ui.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="/dropdown.css">


    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>


  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
--}}


</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Weirdpress
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/write') }}">Write</a></li>
                </ul>
                
                <!-- Not so left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('user/myPosts')}}" value="published">My Blog</a></li>
                    <li class="dropdown">
                      
                       </ul>
                       <ul id="main-nav">
                        <li class="main-nav-item">
                            <a href="#" class="main-nav-tab">Filter Posts</a>

                            <div class="main-nav-dd">
                                <div class="main-nav-dd-column">
                                    <h3>
                                        Categories
                                    </h3>

                                    <ul>
                                        <li><a href="{{ url('/category/'.'Love')}}">Love</a></li>
                                        <li><a href="{{ url('/category/'.'Technology')}}">Technology</a></li>
                                        <li><a href="{{ url('/category/'.'Travel')}}">Travel</a></li>
                                    </ul>

                                    <hr />

                                    <h3>
                                        Extras
                                    </h3>

                                    <ul>
                                        <li><a href="{{ url('/authorToExpertise')}}">Expertise</a></li>
                                        <li><a href="{{ url('/terminator')}}">Terminator</a></li>
                                        <li><a href="{{ url('/expertiseToAuthor')}}">Groups</a></li>
                                    </ul>
                                </div>

                                <div class="main-nav-dd-column">
                                    <h3>
                                        Authors
                                    </h3>

                                    <ul>
                                        <li><a href="{{ url('/user/'.'1'.'/posts')}}">Dominique</a></li>
                                        <li><a href="{{ url('/user/'.'2'.'/posts')}}">Jannete</a></li>
                                        <li><a href="{{ url('/user/'.'3'.'/posts')}}">Kevin</a></li>
                                        {{-- <li><a href="#">Link 4</a></li>
                                        <li><a href="#">Link 5</a></li>
                                        <li><a href="#">Link 6</a></li> --}}
                                    </ul>
                                </div>

                                {{-- <div class="main-nav-dd-column">
                                    <h3>
                                        About Us 4
                                    </h3>

                                    <ul>
                                        <li><a href="#">Link 1</a></li>
                                        <li><a href="#">Link 2</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </li>


    <li class="main-nav-item">
        <a href="#" class="main-nav-tab">Unpublished</a>
    
        <div class="main-nav-dd">
            <div class="main-nav-dd-column">
                <h3>
                Unpublished
                </h3>

                <ul>
                   
                    <li><a href="{{ url('user/drafts')}}">Drafts</a></li>
                     @if(!Auth::guest() && !Auth::user()->is_editor())
                    <li><a href="{{ url('user/myPendingPosts')}}">Pending</a></li>
                    @endif
                    {{-- <li><a href="#">Link 3</a></li> --}}
                </ul>
                
                <hr />
                
                <h3>
                Editing
                </h3>
                
                <ul>
                    @if(!Auth::guest() && Auth::user()->is_editor())
                    <li><a href="{{ url('user/pendingPosts')}}">Pending</a></li>
                    @endif
                    {{-- <li><a href="#">Link 2</a></li>
                    <li><a href="#">Link 3</a></li> --}}
                </ul>
           </div>
           
           
    </li>
                    </ul>   

                    
                



                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js
                    "></script>
                    <script type="text/javascript">
                        $(function() {
                            var $mainNav = $('#main-nav'),
                            navWidth = $mainNav.width();

                            $mainNav.children('.main-nav-item').hover(function(ev) {
                                var $this = $(this),
                                $dd = $this.find('.main-nav-dd');

        // get the left position of this tab
        var leftPos = $this.find('.main-nav-tab').position().left;
        
        // get  the width of the dropdown
        var ddWidth = $dd.width(),
        leftMax = navWidth - ddWidth;
        
        // position the dropdown
        $dd.css('left', Math.min(leftPos, leftMax) );
        
        // show the dropdown
        $this.addClass('main-nav-item-active');
    }, function(ev) {
        // hide the dropdown
        $(this).removeClass('main-nav-item-active');
    });
                        });
                    </script>




                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>

                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->firstname }} ({{ Auth::user()->position}}) <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>


        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
        {{--     <script type="text/javascript" src="sematic-ui.min.js"></script> --}}
        <div class="panel-heading">
            <h2>@yield('title')</h2>
            @yield('title-meta')
        </div>
        <div class="panel-body">
            @yield('content')
            </div>
        </body>
        </html>
