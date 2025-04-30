@extends('layouts.app')

@section('content')
    <div class="container">
       
            <div class="panel-col">
                <div class="panel-name" >
                        <h1>
                       + Ajoutez une ville</h1>
                    </div>   
                </div> 
            <div class="c">
                
                <form action="{{ route('villes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="form-group">
                        <label for="ville">Ville:</label>
                        <input type="text" name="ville" class="form-control" required>
                    </div>                  
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection