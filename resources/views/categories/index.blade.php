@section('title')
    <title>Catégories</title>
@endsection
@extends('layouts.app')
@section('content')
<div class="annonce">
                <div class='create'>
                   <h1>Categories</h1>
                    @if (auth()->user()->role=="admin")
                    <a href="{{route('categories.create')}}" class="btn btn-primary mb-3">Nouvelle Catégorie</a>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }} 
                        </div>
                         @endif                    
                    @endif
               
                </div>
                
                <div class='tab'>
                    <table class="table">                    
                        <thead>
                        <tr>
                            <th>ID</th>                          
                            <th>Libelle</th>
                            <th>Description</th>
                            @if (auth()->user()->role=="admin")
                            <th>Actions</th>
                            @endif
                        </tr>
                         </thead>
                       
                       
                        <tbody>
                        
                        @foreach ($categories as $cat)
                            <tr>
                                <td>{{ $cat ->id }}</td>                               
                                <td>{{ $cat ->libelle }}</td>
                                <td>{{ $cat ->description }}</td>
                                @if (auth()->user()->role=="admin")
                                <td>
                                    <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-primary">Editer</a>
                                    <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display: inline">
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

  

