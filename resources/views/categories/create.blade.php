@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="panel-col">
                <div class="panel-name" >
                <h1>Ajoutez Catégorie</h1>
                    </div>   
                </div> 
            <div class="c">
                
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="form-group">
                        <label for="libelle">Libelle:</label>
                        <input type="text" name="libelle" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
</div>
            </div>
        </div>
    </div>
@endsection
