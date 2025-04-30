@section('title')
    <title>Quick Annonce</title>
@endsection
@extends('layouts.app')
@section('content')
<div class="annonce">
                <div class='create'>
                    <h1>Annonces</h1>
                    @if (auth()->user())
                        <a href="{{route('annonces.create')}}" class="btn btn-primary mb-3">Nouvelle Annonce</a>
                                         
                    @endif                   
                    @if( $annonce==null) 
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Aucune annonce trouvée</h4>
                            
                        </div>
                     @else
                <div class='tab'>
                    <table class="table">            
                                       
                        <thead>
                            <tr>
                                <th>&nbsp;</th> 
                                <th>titre</th>  
                                <th>prix</th>
                                <th>ville</th>
                                <th>Date</th>                                                
                                <th>&nbsp;</th>
                            </tr>                        
                        </thead>
                       
                        <tbody>
                        
                            @foreach ($annonce as $an)
                                <tr>
                                <td>
                                    <ul>
                                        @foreach ($an->images as $image)
                                            <li><img src="{{asset('images/annonces/'.$image)}}" style="height: 200px; width:200px;"/></li>
                                        @endforeach
                                    </ul>
                                </td>
                                    <td>{{ $an->titre }}</td>                               
                                    <td>{{ $an->prix }}</td>
                                    <td>{{ $an->ville }}</td>                             
                                    <td>{{ $an->created_at }}</td>  
                                    <td>
                                        <a href="{{ route('annonces.show', $an->id ) }}" class="btn btn-info">Voir</a>
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
                @endif
                <script>
                    document.getElementById('sort-select').addEventListener('change', function() {
                        var selectedValue = this.value;
                        var url = "{{ route('annonces.index')}}";
                        window.location.href = url + '?sort=' + selectedValue;
                    });
                    document.getElementById('ville-select').addEventListener('change', function() {
                        var selectedValue = this.value;
                        var url = "{{ route('annonces.index')}}";
                        window.location.href = url + '?ville=' + selectedValue;
                    });    
                    document.getElementById('categorie-select').addEventListener('change', function() {
                        var selectedValue = this.value;
                        var url = "{{ route('annonces.index')}}";
                        window.location.href = url + '?categorie=' + selectedValue;
                    });
                </script>
            </div>
    
  

    @endsection