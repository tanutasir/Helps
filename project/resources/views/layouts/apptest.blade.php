<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@section('htmlheader')
    @include('layouts.partials.htmlheader1')
@show

<body>
<div class="ui-layout-center">Center
    <P><A href="http://layout.jquery-dev.net/demos.html">Go to the Demos page</A></P>
    <P>* Pane-resizing is disabled because ui.draggable.js is not linked</P>
    <P>* Pane-animation is disabled because ui.effects.js is not linked</P>
</div>
<div class="ui-layout-north">North</div>
<div class="ui-layout-south">South</div>
<div class="ui-layout-east">East</div>
<div class="ui-layout-west">West</div>

    <!-- Scripts -->
    @section('scripts')
        @include('layouts.partials.scripts1')
    @show
</body>
</html>
