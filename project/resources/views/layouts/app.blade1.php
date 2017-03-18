<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show


<body>
<button id="menuEditBtn" style="position: absolute;z-index: 2000">Edit menu</button>

    <div id="app">
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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->






                        @if (Auth::guest())
                            @if (\Request::segment(1)!="login")
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @endif
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif




                    </ul>
                </div>
            </div>
        </nav>
        @if (!Auth::guest())
            <h1>MENU</h1>
            @section('mastermenu')
                @include('layouts.partials.mastermenu')
            @show
        @endif


        @yield('content')
    </div>
<div id="kuku" style="display:none; position: absolute; top: 0px;left: 0px;right: 0px;bottom: 0px;background-image: url('http://helps/plugins/fancybox/source/fancybox_overlay.png') ;background-repeat: repeat;z-index: 0">
    <div id="bodyy" style="padding: 10px 10px 30px 10px;display: block;position: relative;top: 0px;left: 300px;background: white;z-index: 0">

    </div>
</div>
    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    {<h4 class="modal-title">Edit menu</h4>
                </div>
                <div style="text-align: left; padding-left: 10px;">
                    <button id="newMaster">New</button>
                </div>
                <div class="modal-body" id="bodyyy" style="text-align: left">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Scripts -->
    @section('scripts')
        @include('layouts.partials.scripts')
    @show
</body>
</html>
