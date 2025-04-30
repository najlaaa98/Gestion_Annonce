@section('title')
    <title>Créez une Annonce</title>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel-col">
                <div class="panel-name" >
                    <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M402.351 381.058h-203.32l-11.806-47.224h266.587L512 101.085H129.038L108.882 20.46H0v33.4h82.804l82.208 328.827c-24.053 5.971-41.938 27.737-41.938 53.611 0 30.461 24.781 55.242 55.241 55.242 30.459 0 55.241-24.781 55.241-55.242a54.903 54.903 0 0 0-4.511-21.841h122.577a54.92 54.92 0 0 0-4.511 21.841c0 30.461 24.781 55.242 55.241 55.242 30.459 0 55.241-24.781 55.241-55.242-.001-30.458-24.782-55.24-55.242-55.24zm-115.322-80.624h-37.08l-8.284-66.275h45.365v66.275zm124.883-165.95h57.31l-16.568 66.275h-49.026l8.284-66.275zm-12.459 99.676h44.85l-16.568 66.275h-36.566l8.284-66.275zm-79.025-99.676h57.824l-8.284 66.275h-49.539v-66.275zm0 99.675h45.365l-8.284 66.275h-37.08v-66.275zm-33.399-99.675v66.275H237.49l-8.284-66.275h57.823zm-149.641 0h58.158l8.284 66.275h-49.873l-16.569-66.275zm24.919 99.675h45.699l8.284 66.275h-37.414l-16.569-66.275zm16.008 223.982c-12.043 0-21.841-9.798-21.841-21.842 0-12.043 9.798-21.841 21.841-21.841s21.841 9.798 21.841 21.841c0 12.044-9.798 21.842-21.841 21.842zm224.036 0c-12.043 0-21.841-9.798-21.841-21.842 0-12.043 9.798-21.841 21.841-21.841 12.043 0 21.841 9.798 21.841 21.841 0 12.044-9.798 21.842-21.841 21.842z" fill="#ffff" data-original="#000000" class=""></path></g></svg>
                        CRÉEZ VOTRE ANNONCE</h1>
                </div>               
                <div class="c">
              
                <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Votre Nom :</label>
                        <input type="text" value="{{auth()->user()->nom}}" name="nom" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nom">E-mail :</label>
                        <input type="text" value="{{auth()->user()->email}}" name="email" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Tel :</label>
                        <input type="text" value="{{auth()->user()->telephone}}" name="telephone" class="form-control" disabled>
                    </div>
                   
                    <div class="form-group">
                        <label for="titre">titre:</label>
                        <input type="text" name="titre" class="form-control" required>
                    </div>
                   
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control" rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="prix">prix:</label>
                        <input type="text" name="prix" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ville">ville:</label>
                        <select name="ville" class="form-control" required>
                            @foreach($villes as $ville)
                                <option value="{{$ville->id}}">{{$ville->ville}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categorie">categorie:</label>
                        <select name="categorie" class="form-control" required>
                            @foreach($categories as $categorie)
                                <option value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                   <div class="form-group">
                        <label for="libelle">images:</label>
                        <div class='files'>
                            <input type="file" name="image1" class="form-control" required>
                            <input type="file" name="image2" class="form-control" >
                            <input type="file" name="image3" class="form-control" >
                            <input type="file" name="image4" class="form-control" >
                            <input type="file" name="image5" class="form-control" >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
    </div>
            </div>
        </div>
    </div>
@endsection