@section('title')
    <title>Coordonnées Personnelles</title>
@endsection
@extends('layouts.app')
@section('content')

<div class="panel-col">
                <div class="panel-name" >
                        <h1>Coordonnées Personnelles</h1>
                    </div>   
                </div> 
            <div class="c">
                <form action="{{ route('users.update',auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nom">Nom</label>                        
                        <input type="text" id="nom" value="{{auth()->user()->nom}}" name="nom" class="form-control" required autofocus>
                        @error('nom')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" value="{{auth()->user()->prenom}}"  name="prenom" class="form-control" required autofocus>
                        @error('prenom')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prenom">Sexe</label>
                        <select class="form-control"  name="sexe"> 
                             <option value="homme">Homme</option>
                             <option value="femme">Femme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="name" value="{{auth()->user()->email}}"  name="email" class="form-control" required autofocus>
                        @error('email')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telephone">Telephone</label>
                        <input type="text" id="telephone" name="telephone" value="{{auth()->user()->telephone}}"  class="form-control" required autofocus>
                        @error('telephone')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="profile">Photo </label>
                        <input type="file" id="profile" name="profile" value="{{auth()->user()->profile}}" class="form-control" required>
                        @error('profile')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Nom d'utilisateur </label>
                        <input type="text" id="username" value="{{auth()->user()->username}}" name="username" class="form-control" required>
                        @error('Username')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="password" id="password"  name="password" class="form-control" required>
                        @error('password')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="old_password">Ancien mot de passe</label>
                        <input type="password" id="old_password" name="old_password" class="form-control" required>
                        @error('old_password')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
      
@endsection