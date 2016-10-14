@extends('layouts.default')
@section('listTasks')
<div>
    <a href="http://localhost/laravel/public/userZone_{{Auth::user()->id_user}}">Назад към списъците</a><p>Добави задача в списъка :</p>
    @foreach($zad as $res)
    @endforeach
    {{Form::open(['url'=>'/userZone_'.Auth::user()->id_user.'/listTasks_'.$res->id_list.''])}}
    Име :{{Form::input('text','zadacha')}}
    Статус :{{Form::input('text','status')}}
    Бележка :{{Form::input('text','b')}}
    {{ Form::submit('Запиши',['class'=>'submit','name'=>'submit_w'])}}
    <center>
        @if($errors->has('zadacha'))
        {{$errors->first('zadacha')}}
        @endif
        @if($errors->has('status'))
        {{$errors->first('status')}}
        @endif
    </center>
    {{Form::close()}}
</div>
<table>
    <tr>
        <th>Име</th>
        <th>Дата на добавяне</th>
        <th>Статус</th>
        <th>Премахване</th>
        <th>Промени статуса</th>
        <th>Бележка</th>
    </tr>
    @foreach($zad as $res)
    @endforeach
    <h3>{{$res->name_list}}</h3>
    @foreach($zad as $res)
    <th>{{$res->name_task}}</th>
    <td>{{gmdate("Y-m-d", $res->date_added)}}</td>
    <td>{{$res->status}}</td>
    <td>     
        <a href="listTasks_{{$res->id_list}}/id_task_{{$res->id_tasks}}">Изтрий</a></td>
    <td>
        {{Form::open(['url'=>'/userZone_'.Auth::user()->id_user.'/listTasks_'.$res->id_list.''])}}
        {{Form::input('text','novstatus')}}<a name="newstatus" href="">нов статус</a>
        @if($errors->has('novstatus'))
        {{$errors->first('novstatus')}}
        @endif
        {{Form::close()}}
    </td>
    <td>{{$res->belejka}}</td>
</tr>
@endforeach
</table>
<hr>
@stop