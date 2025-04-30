
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
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }} 
                        </div>
                         @endif                    
                    @endif
                    @if (session('failed'))
                        <div class="alert alert-danger"> 
                            {{ session('failed') }} 
                        </div>
                    @endif
                </div>
                <div class='trier'>
                    <label>Trier par :</label>
                    <select name="sort" id="sort-select">
                    <option value="{{$sort}}">{{ucfirst($sort)}}</option>                                                    
                        <option value="ville">Ville</option>
                        <option value="categorie">Categorie</option>
                        <option value="prix">Prix</option>
                        <option value="date">Date</option>
                    </select>
                    <label>Ville :</label>
                    <select class="form-control" name="ville" id="ville-select">
                    <option value="{{$ville}}">{{ucfirst($ville)}}</option>   
                        @foreach($villes as $ville)                         
                        <option value="{{$ville->ville}}">{{$ville->ville}}</option>
                        @endforeach
                    </select>
                    <label>Categorie :</label>
                    <select class="form-control" name="categorie" id="categorie-select">
                   <option value="{{$categorie}}">{{ucfirst($categorie)}}</option>   

                        @foreach($categories as $cat)                         
                        <option value="{{$cat->libelle}}">{{$cat->libelle}}</option>
                        @endforeach
                    </select>
                </div>
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