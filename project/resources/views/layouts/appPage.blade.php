<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@section('htmlheader')
    @include('layouts.partials.htmlHeader')
@show


<body>
@if (!Auth::guest())
    <button id="menuEditBtn" style="left:300px;position: absolute;">Edit menu</button>
@endif
    <div id="app">
        <!-- Right Side Of Navbar -->
        @if (!Auth::guest())
            <div id="header">
                <div id="headerText" onclick="javascript:window.location.href = '{{ url('/') }}'">helps.16mb.com</div>
        @else
            <div id="loginHeader"></div>
        @endif
            <div style="padding-right: 20px;">
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

        @if (!Auth::guest())
            @section('mastermenu')
                @include('layouts.partials.masterMenu')
            @show
        @endif
        <div id="cc" class="easyui-layout" data-options="fit:true"style="width:100%;height:auto;min-height: 500px">
{{--            <div data-options="region:'north',title:'North Title',split:true" style="height:100px;"></div>--}}
            <div data-options="region:'south',title:'Footer',split:true,hideCollapsedContent:false" style="height:100px;"></div>
            <div data-options="region:'east',title:'Bookmarks',split:true,collapsed:true,hideCollapsedContent:false" style="width:200px;"></div>
            <?php
                use App\Structs;
            ?>
            @if(Structs::where('id', $id)->first()->children()->count() > 0)
                <div data-options="region:'west',title:'Menu',split:true,hideCollapsedContent:false" style="width: 200px; padding: 5px 10px;height:auto">

                    <?php
                    $roots = Structs::roots()->get();
                    $arr = array();
                    if($id != null && Structs::where('id', $id)->first()){
                        $obj = Structs::where('id', $id)->first()->ancestorsAndSelf()->get();


                        foreach($obj as $o){
                            array_push($arr, $o->id);;
                        }


                        $nodes = Structs::where('id', $id)->first()->children()->get();

                        foreach($nodes as $node):
                            $href = '/'.$node->id;
                            echo "<a href='".$href."' style='cursor:pointer'>".$node->text."</a><br/>";
                        endforeach;
                    }
                    ?>

                </div>
            @elseif(Structs::where('id', $id)->first()->isLeaf())
                <div data-options="region:'west',title:'Menu',split:true,hideCollapsedContent:false" style="width: 200px; height:auto ;padding: 5px 10px;">
                    <div>
                        <button id="slaveNewBtn">New</button>
                    </div>
                    <div id="slave-tree"></div>
                </div>
            @endif
            <div data-options="region:'center',title:'Body'" style="padding:5px;background:#eee;">
                @yield('content')
           </div>
        </div>




    </div>
    @section('modalDialog')
        @include('layouts.partials.modalDialog')
    @show

    <!-- Scripts -->
    @section('scripts')
        @include('layouts.partials.scripts')
    @show
</body>
</html>
