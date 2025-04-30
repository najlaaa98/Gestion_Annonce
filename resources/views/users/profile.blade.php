@section('title')
    <title>{{$user->nom}} {{$user->prenom}}</title>
@endsection
@extends('layouts.app')
@section('content')
<div class="panel-col">
    <div class="panel-name" >
        <h1>
            VOIR VOTRE PROFILE </h1>
    </div> 
</div>
<div class="create">
    <h1 >&nbsp;</h1>
<a href="{{route('users.edit', auth()->user()->id) }}" class="btn btn-primary mb-3">Modifier</a>
</div>
    <div class="card">       
    <h1 class="card-title"> {{$user->nom}} {{$user->prenom}} </h1>
    <img class="card-img-top img-center" src="{{ asset('images/profile/'.$user->profile)}}"style="height: 200px; width:200px;"/></li>

    <table class="table">       
        <tr><th style="width:200px">Nom d'utilisateur :</th><td>{{$user->username}}</td></tr>                 
        <tr><th>Email :</th><td>{{$user->email}}</td></tr>        
        </table>
    </div>
@endsection