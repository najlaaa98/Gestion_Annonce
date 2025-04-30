@section('title')
    <title>Villes</title>
@endsection
@extends('layouts.app')
@section('content')
<div class="annonce">
                <div class='create'>
                <h1>villes :</h1>
                @if (auth()->user())
                <a href="{{route('villes.create')}}" class="btn btn-primary mb-3"> +Nouvelle ville</a>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }} 
                    </div>
                @endif
               
                </div>
                
                <div class='tab'>
                    <table class="table">             
                    @if(!$villes->isEmpty())                
                    <thead>
                       
                       <tr>
                           <th>Ville</th>  
                          
                           @if (auth()->user()->role=="admin" )
                           <th>Actions</th>
                           @endif
                       </tr>
                       
                   </thead>
                       
                       
                   @else
                    <div class="alert alert-danger">
                       Aucune ville publiée.
                      </div>
                    @endif
                    <tbody>
                        
                    @foreach ($villes as $ville)
                            <tr>
                                <td>{{ $ville->ville }}</td>                               
                           
                                @if (auth()->user()->role=="admin")
                                <td>
                                    <a href="{{ route('villes.edit', $ville->id) }}" class="btn btn-primary">Editer</a>
                                    <form action="{{ route('villes.destroy', $ville->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie')">Supprimer</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            
            </div>
@endsection