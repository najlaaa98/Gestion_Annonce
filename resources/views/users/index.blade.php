@extends('layouts.app')
@section('content')
    <div class="container">
        @if($message=Session::get('success'))
        <div class="alert alert-danger">{{$message}}</div>
        @endif
        <div class='tab'>
                    <table class="table">            
                                         
                        <thead>
                            <tr>
                                <th>Id</th> 
                                <th>Email</th>  
                                <th>Sexe</th>
                                <th>Telephone</th>
                                <th>Nom d'utilisateur</th>                                                
                                <th>Prenom</th>
                                <th>Nom</th>
                            </tr>                       
                        </thead>
                      
                        <tbody>
                      
                @foreach($users as $user)
                @if(auth()->user()->id!="$user->id")  
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->sexe}}</td>
                    <td>{{$user->telephone}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->prenom}}</td>
                    <td>{{$user->nom}}</td>
                    <td>
                        <form action="{{route('users.destroy',$user->id)}}"  method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
         
                        </tbody>
                    </table>
                </div>
    </div>
@endsection