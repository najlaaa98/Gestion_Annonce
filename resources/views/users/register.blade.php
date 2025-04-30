@section('title')
    <title>Quick Annonce</title>
@endsection
@extends('layouts.app')
@section('register')
    <div class="register">
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf             
            <input type="text" id="username" placeholder="Nom d'utilisateur" name="username"  required>
                @error('Username')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            <input type="text" id="nom" placeholder="Nom" name="nom" required autofocus>
                @error('nom')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror       
            <input type="text" id="prenom" placeholder="Prénom" name="prenom" required autofocus>
                @error('prenom')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            <input type="password" id="password" placeholder="Mot de passe" name="password" required>
                @error('password')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            <input type="password" id="c_password" placeholder="Confirmer le mot de passe" name="c_password" required>
                @error('c_password')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            <input type="email" id="name" name="email" placeholder="Email" required autofocus>
                @error('email')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            <input type="text" id="telephone" name="telephone" placeholder="Telephone" required autofocus>
                @error('telephone')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror 
            <select   name="sexe">
                <option >Sexe</option> 
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
            </select>
            <input type="file" id="profile" name="profile" required>
                @error('profile')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror       
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
@endsection
@section('login')
<div class='login'>
    <h1>
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M18.75 9H18V6c0-3.309-2.691-6-6-6S6 2.691 6 6v3h-.75A2.253 2.253 0 0 0 3 11.25v10.5C3 22.991 4.01 24 5.25 24h13.5c1.24 0 2.25-1.009 2.25-2.25v-10.5C21 10.009 19.99 9 18.75 9zM8 6c0-2.206 1.794-4 4-4s4 1.794 4 4v3H8zm5 10.722V19a1 1 0 1 1-2 0v-2.278c-.595-.347-1-.985-1-1.722 0-1.103.897-2 2-2s2 .897 2 2c0 .737-.405 1.375-1 1.722z" fill="#f2f9ec" data-original="#000000" class=""></path></g></svg>                   
        SE CONNECTER 
    </h1>
    @if($message=Session::get('success'))
        <div class="alert alert-info"> {{$message}}</div>        
    @endif    
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input placeholder="Nom d'utilisateur" type="text" name="username"/>
        <input placeholder="Mot de passe" type="password" name="password"/>
        <button type="submit">Connexion</button>
    </form>
    @if($message=Session::get('failed'))
        <div class="alert alert-danger"> {{$message}}</div>
    @endif
</div>
@endsection