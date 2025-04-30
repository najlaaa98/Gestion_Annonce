@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="panel-col">
                <div class="panel-name" >
                <h1> Editer une catégorie</h1>
                    </div>   
                </div> 
            <div class="c">
                <form action="{{ route('categories.update', $cat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                   
                    <div class="form-group">
                        <label for="libelle">Libelle:</label>
                        <input type="text" name="libelle" class="form-control" value="{{ $cat->libelle }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control">{{ $cat->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Energister</button>
                </form>
</div>
            </div>
        </div>
    </div>
@endsection

