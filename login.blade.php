<?php

use Illuminate\Support\Facades\Input;
?>
@extends('layouts.default')
@section('login')
<div>                                      
    <div>Вход за потребители :</div>
    {{Form::open(['url'=>'/login','method'=>'post'])}}
    email :<br>
    {{Form::input('email', 'strEmail')}}<br>
    Парола :<br>
    {{Form::input('password', 'pass', Input::old('pass'))}}<br>
    {{ Form::submit('Влез',['name'=>'submit_vhod'])}}
    <center>
        @if($errors->has('strEmail'))
        {{$errors->first('strEmail')}}
        @endif
        @if($errors->has('pass'))
        {{$errors->first('pass')}}
        @endif
    </center>
    {{Form::close()}}
</div>
<hr>
<div>                                      
     <div>Регистрация :</div>
    {{Form::open(['url'=>'/login','method'=>'post'])}}
    email :<br>
    {{Form::input('email', 'e')}}<br>
    Парола :<br>
    {{Form::input('password', 'p', Input::old('p'))}}<br>
    {{ Form::submit('Влез',['name'=>'submit_reg'])}}
    <center>
        @if($errors->has('e'))
        {{$errors->first('e')}}
        @endif
        @if($errors->has('p'))
        {{$errors->first('p')}}
        @endif
    </center>
    {{Form::close()}}
</div>                     
@stop