@section('title')
    <title>{{$annonce->titre}}</title>
@endsection
@extends('layouts.app')
@section('content')
    <div class="card">
        <h1 class="card-title"> {{$annonce->titre}} </h1>
        @foreach ($annonce->images as $image)
            <img class="card-img-top img-center" src="{{asset('images/annonces/'.$image)}} " style="height: 200px; width:200px;"/></li>
        @endforeach
        <table class="table">
            <tr><th style="width:200px">description</th><td>{{$annonce->description}}</td></tr>
            <tr><th>Prix</th><td>{{$annonce->prix}} DH</td></tr>
            <tr><th>Ville</th><td>{{$annonces[0]->ville}}</td></tr>                 
            <tr><th>Categorie</th><td>{{$annonces[0]->libelle}}</td></tr>
        </table>
    </div>
@endsection
