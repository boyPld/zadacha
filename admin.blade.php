@extends('layouts.default')
@section('admin')
<p>Здравей АДМИН :</p>
@foreach($x as $res)
<a href="">{{$res->name_list}}</a><br>
    @endforeach
    
<p>Чакащи за изтриване :</p>
@foreach($z as $res1)
<a href="{{$res1->id_list}}">{{$res1->name_list}}</a><br>
    @endforeach

@stop