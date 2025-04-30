@section('title')
    <title>Objects Personnels</title>
@endsection
@extends('layouts.app')
@section('content')
<div class="annonce">              
                <div class='tab'>
                    <table class="table">             
                        @if(!$annonces->isEmpty())                    
                        <thead>
                            <tr>
                                <th>&nbsp;</th> 
                                <th>Titre</th>  
                                <th>Prix</th>
                                <th>Ville</th>
                                <th>Date</th>                                                
                                <th>&nbsp;</th>
                            </tr>                        
                        </thead>
                        @else
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Acune annonce trouvée!</h4>
                            
                            <p class="mb-0">Veuillez insérer une annonce.</p>
                            </div>
                        @endif
                        <tbody>
                        
                            @foreach ($annonces as $annonce)
                                <tr>
                                <td>
                                    <ul>
                                        @foreach ($annonce->images as $image)
                                            <li><img src="{{asset('images/annonces/'.$image)}}" style="height: 200px; width:200px;"/></li>
                                        @endforeach
                                    </ul>
                                </td>
                                    <td>{{ $annonce->titre }}</td>                               
                                    <td>{{ $annonce->prix }}</td>
                                    <td>{{ $annonce->ville }}</td>                             
                                    <td>{{ $annonce->created_at }}</td>  
                                    <td>
                                        <a href="{{ route('annonces.show', $annonce->id ) }}" class="btn btn-info">Voir</a>
                                        @if(auth()->user())
                                            @if( $annonce->user==auth()->user()->id)
                                                <a href="{{ route('annonces.edit', $annonce->id) }}" class="btn btn-primary">Editer</a>
                                                <br/>
                                            @endif
                                            @if (auth()->user()->role=="admin" or $annonce->user==auth()->user()->id)
                                                <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce')">Supprimer</button>
                                                </form>
                                            @endif
                                        @endif
                                        
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
@endsection