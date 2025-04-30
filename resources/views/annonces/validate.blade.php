@section('title')
    <title>Validation</title>
@endsection
@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">          
               
                @if (session('valider'))
                    <div class="alert alert-success">
                        {{ session('valider') }} 
                    </div>
                @endif
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
                                        <form action="{{ route('setVlidateTrue', ['id' => $annonce->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary ">Valider</button>
                                        </form>

                                        </td>
                                    </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
                          
                 
    @endsection
