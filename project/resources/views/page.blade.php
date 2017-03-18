@extends('layouts.appPage')

@section('content')

    <h1>Page</h1>{{$id}}<br/>{{$sid}}<br/>
<?php
    echo Session::get('id');
    echo "<br/>";
    echo Session::get('sid');
?>
@endsection
