<?php

use Illuminate\Support\Facades\Input;
?>
@extends('layouts.default')
@section('userZone')
<div>
    <p>Вашите списъци от задачи са :</p>
    <table>
        <tr>
            <th>Име</th>
            <th>Разглеждане</th>
            <th>Архивиране</th>
            <th>Премахване</th>
            <th>Дата на добавяне</th>
             <th>Забележка</th>
        </tr>
        @foreach($result as $res)
        <th>{{$res->name_list}}</th>
        <td><a href="userZone_{{Auth::user()->id_user}}/listTasks_{{$res->id_list}}">Виж задачите</a></td>
        <td><a href="arhiv/listTasks_{{$res->id_list}}">Архивирай</a></td>
        <td><a href="del_{{$res->id_list}}">Изтрий</a></td>
        <th>{{gmdate("Y-m-d",$res->date_added)}}</th>
         <th>{{$res->zabelejka}}</th>
        </tr>
        @endforeach
    </table>
</div>
<hr>
<div>
    <p>Добавяне на нов списък :</p>
    {{Form::open(['url'=>'/userZone_'.Auth::user()->id_user.''])}}
    Име :{{Form::input('text','tema')}}
    Забележка :{{Form::input('text','z')}}
    {{ Form::submit('Запиши',['class'=>'submit','name'=>'submit_t'])}}
    <center>
        @if($errors->has('tema'))
        {{$errors->first('tema')}}
        @endif
    </center>
    {{Form::close()}}
    <hr><br>
    <h2>Архиви от списъци...</h2>
    <div>
        @foreach($arhiv as $r)
        <a href="">{{$r->name_list}}</a><br>
        @endforeach
    </div>
</div>
@stop