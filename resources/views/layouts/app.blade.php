<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')    
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">
</head>
<body>
    @php
    $lettre=""
    @endphp
    @if(!auth()->check())
    <div class="panel">
        <p class="p1">Nouveau! Créez un compte aujourd'hui pour placer votre annonce gratuitement! </p>
        <div class="panel-child" >
            <a class="account1" href="{{route('register')}}" >
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M18.75 9H18V6c0-3.309-2.691-6-6-6S6 2.691 6 6v3h-.75A2.253 2.253 0 0 0 3 11.25v10.5C3 22.991 4.01 24 5.25 24h13.5c1.24 0 2.25-1.009 2.25-2.25v-10.5C21 10.009 19.99 9 18.75 9zM8 6c0-2.206 1.794-4 4-4s4 1.794 4 4v3H8zm5 10.722V19a1 1 0 1 1-2 0v-2.278c-.595-.347-1-.985-1-1.722 0-1.103.897-2 2-2s2 .897 2 2c0 .737-.405 1.375-1 1.722z" fill="#f2f9ec" data-original="#000000" class=""></path></g></svg>
                <span>Créer compte</span>
            </a>
            <a class="account2" href="{{route('register')}}">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M256 0c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135S330.439 0 256 0zM423.966 358.195C387.006 320.667 338.009 300 286 300h-60c-52.008 0-101.006 20.667-137.966 58.195C51.255 395.539 31 444.833 31 497c0 8.284 6.716 15 15 15h420c8.284 0 15-6.716 15-15 0-52.167-20.255-101.461-57.034-138.805z" fill="#f2f9ec" data-original="#000000"></path></g>
                </svg>
                <span>Se connecter</span>
            </a>
        </div>
    </div>
    @else
    <div class="panel">
        <p class="p1">Panel @if(auth()->user()->role=="admin") d'administrateur @else Membre @endif </p>
        <div class="panel-child" >
            <a class="account1" href="{{route('annonces.index')}}" >
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M256 0c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135S330.439 0 256 0zM423.966 358.195C387.006 320.667 338.009 300 286 300h-60c-52.008 0-101.006 20.667-137.966 58.195C51.255 395.539 31 444.833 31 497c0 8.284 6.716 15 15 15h420c8.284 0 15-6.716 15-15 0-52.167-20.255-101.461-57.034-138.805z" fill="#f2f9ec" data-original="#000000"></path></g></svg>
                <span>Bienvenue</span>
            </a>
            {{auth()->user()->prenom}} {{auth()->user()->nom}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                @csrf 
            <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
            </a>
        </form>
        </div>
    </div>
    @endif

    <header>
        <img src="{{asset('images/logos/QuickAnnonce.png')}}" />
        <div class="items">
            <form action="{{route('annonces.index')}}" method="get" class="search-form">
                @csrf
                <input placeholder="Que recherchez-vous ?" name="lettre" type="text"/>
                <button type="submit">Chercher</button>
            </form>
            <a href="{{route('annonces.create')}}">
            <div class='shop'>                
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M402.351 381.058h-203.32l-11.806-47.224h266.587L512 101.085H129.038L108.882 20.46H0v33.4h82.804l82.208 328.827c-24.053 5.971-41.938 27.737-41.938 53.611 0 30.461 24.781 55.242 55.241 55.242 30.459 0 55.241-24.781 55.241-55.242a54.903 54.903 0 0 0-4.511-21.841h122.577a54.92 54.92 0 0 0-4.511 21.841c0 30.461 24.781 55.242 55.241 55.242 30.459 0 55.241-24.781 55.241-55.242-.001-30.458-24.782-55.24-55.242-55.24zm-115.322-80.624h-37.08l-8.284-66.275h45.365v66.275zm124.883-165.95h57.31l-16.568 66.275h-49.026l8.284-66.275zm-12.459 99.676h44.85l-16.568 66.275h-36.566l8.284-66.275zm-79.025-99.676h57.824l-8.284 66.275h-49.539v-66.275zm0 99.675h45.365l-8.284 66.275h-37.08v-66.275zm-33.399-99.675v66.275H237.49l-8.284-66.275h57.823zm-149.641 0h58.158l8.284 66.275h-49.873l-16.569-66.275zm24.919 99.675h45.699l8.284 66.275h-37.414l-16.569-66.275zm16.008 223.982c-12.043 0-21.841-9.798-21.841-21.842 0-12.043 9.798-21.841 21.841-21.841s21.841 9.798 21.841 21.841c0 12.044-9.798 21.842-21.841 21.842zm224.036 0c-12.043 0-21.841-9.798-21.841-21.842 0-12.043 9.798-21.841 21.841-21.841 12.043 0 21.841 9.798 21.841 21.841 0 12.044-9.798 21.842-21.841 21.842z" fill="#ffff" data-original="#000000" class=""></path></g></svg>
                <div >
                    DEPOSER VOTRE <span>ANNONCE</span>
                </div>
            </div>
            </a>
        </div>
    </header>
    <div class="div ">
                <ul class="ul1">
                    <a class="li1" href="{{route('annonces.index')}}">Accueil</a>
                    <a href="{{route('immobilier')}}"><li class="li1">Immobilier</li></a>
                    <a href="{{route('multimedia')}}"><li class="li1">Multimedia</li></a>
                    <a href="{{route('maison')}}"><li class="li1">Maison</li></a>
                    <a href="{{route('vehicule')}}"><li class="li1">Véhicules</li></a>
                    <a href="{{route('emploi')}}"><li class="li1">Emploi & Services</li></a>
                    <a href="{{route('objet')}}"><li class="li1">Objects Personnels</li></a>                   
                </ul>
    </div>
    @if(!auth()->check())
    <section>
        <div class="pub">
            <div class="img-section">
                <img src="{{asset('images/logos/bonne2.png')}}"/>
            </div>
            <div class="p-section">
                <span>1</span>
                <h3>Trouvez la bonne affaire</h3>
                <p>Pour voir les offres prés de chez 
                 vous, selectionnez votre ville ou la catégorie qui vous intéresse</p>
            </div>
        </div>
        <div class="pub">
            <div class="img-section">
                <img src="{{asset('images/logos/contacter2.png')}}"/>
            </div>
            <div class="p-section">
                <span>2</span>
                <h3>Contactez le vendeur</h3>
                <p>Quand vous avez trouvé l'objet que vous recherchez,contactez le vendeur par email ou par téléphone </p>
            </div>
        </div>
        <div class="pub">
            <div class="img-section">
                <img src="{{asset('images/logos/saluer.png')}}"/>
            </div>
            <div class="p-section">
                <span>3</span>
                <h3>Faites la bonne affaire</h3>
                <p>Rencontrez le vendeur et faites la bonne affaire</p>
            </div>
        </div>
        
    </section>
    @endif
    <div class="main">
        <div class="side">
            @yield('login')
            <div class='bar'>
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M402.351 381.058h-203.32l-11.806-47.224h266.587L512 101.085H129.038L108.882 20.46H0v33.4h82.804l82.208 328.827c-24.053 5.971-41.938 27.737-41.938 53.611 0 30.461 24.781 55.242 55.241 55.242 30.459 0 55.241-24.781 55.241-55.242a54.903 54.903 0 0 0-4.511-21.841h122.577a54.92 54.92 0 0 0-4.511 21.841c0 30.461 24.781 55.242 55.241 55.242 30.459 0 55.241-24.781 55.241-55.242-.001-30.458-24.782-55.24-55.242-55.24zm-115.322-80.624h-37.08l-8.284-66.275h45.365v66.275zm124.883-165.95h57.31l-16.568 66.275h-49.026l8.284-66.275zm-12.459 99.676h44.85l-16.568 66.275h-36.566l8.284-66.275zm-79.025-99.676h57.824l-8.284 66.275h-49.539v-66.275zm0 99.675h45.365l-8.284 66.275h-37.08v-66.275zm-33.399-99.675v66.275H237.49l-8.284-66.275h57.823zm-149.641 0h58.158l8.284 66.275h-49.873l-16.569-66.275zm24.919 99.675h45.699l8.284 66.275h-37.414l-16.569-66.275zm16.008 223.982c-12.043 0-21.841-9.798-21.841-21.842 0-12.043 9.798-21.841 21.841-21.841s21.841 9.798 21.841 21.841c0 12.044-9.798 21.842-21.841 21.842zm224.036 0c-12.043 0-21.841-9.798-21.841-21.842 0-12.043 9.798-21.841 21.841-21.841 12.043 0 21.841 9.798 21.841 21.841 0 12.044-9.798 21.842-21.841 21.842z" fill="#ffff" data-original="#000000" class=""></path></g></svg>
                    MENU
                </h1>
                @if(auth()->check())
                    @if(auth()->user()->role=="admin")
                    <div class='menu'>
                    <ul>
                    <li> <a href="{{route('annonces.index')}}">Accueil </a></li>
                        <li><a href="{{route('getvalidateFalse')}}">Validation des annonces</a></li>
                        <li><a href="{{route('users.index')}}">Supprimer un membre</a></li>
                        <li><a href="{{route('categories.index')}}">Gestion des catégories</a></li>
                        <li><a href="{{route('villes.index')}}">Gestion des villes</a></li>
                        <li><a href="{{route('annonces.index')}}">Supprimer une annonce</a></li> 
                        @if(auth()->check())
                        <li><a href="{{route('profile')}}">Voir Votre Profile</a></li> 
                        @endif                      
                    </ul>
                </div>
                @endif
                @endif
                @if(!auth()->check() or auth()->user()->role=="user" )
                <div class='menu'>
                    <ul>
                     <li><a href="{{route('annonces.index')}}">Accueil </a></li>
                        <li><a href="{{route('immobilier')}}">Immobilier</a></li>
                        <li><a href="{{route('multimedia')}}">Multimedia</a></li>
                        <li><a href="{{route('maison')}}">Maison</a></li>
                        <li><a href="{{route('vehicule')}}">Véhicules</a></li>
                        <li><a href="{{route('emploi')}}">Emploi & Services</a></li>
                        <li><a href="{{route('objet')}}">Objects Personnels</a></li>
                        @if(auth()->check())
                        <li><a href="{{route('profile')}}">Voir Votre Profile</a></li> 
                        @endif
                    </ul>
                </div>                   
                @endif
            </div>
        </div>
        

        <div class='content'>
            @yield('register')          
            @if(auth()->check())
            @if(auth()->user()->role=="admin")
            <div class="admin-panel">
        <div class="panel-name" >
            <h1>
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M402.351 381.058h-203.32l-11.806-47.224h266.587L512 101.085H129.038L108.882 20.46H0v33.4h82.804l82.208 328.827c-24.053 5.971-41.938 27.737-41.938 53.611 0 30.461 24.781 55.242 55.241 55.242 30.459 0 55.241-24.781 55.241-55.242a54.903 54.903 0 0 0-4.511-21.841h122.577a54.92 54.92 0 0 0-4.511 21.841c0 30.461 24.781 55.242 55.241 55.242 30.459 0 55.241-24.781 55.241-55.242-.001-30.458-24.782-55.24-55.242-55.24zm-115.322-80.624h-37.08l-8.284-66.275h45.365v66.275zm124.883-165.95h57.31l-16.568 66.275h-49.026l8.284-66.275zm-12.459 99.676h44.85l-16.568 66.275h-36.566l8.284-66.275zm-79.025-99.676h57.824l-8.284 66.275h-49.539v-66.275zm0 99.675h45.365l-8.284 66.275h-37.08v-66.275zm-33.399-99.675v66.275H237.49l-8.284-66.275h57.823zm-149.641 0h58.158l8.284 66.275h-49.873l-16.569-66.275zm24.919 99.675h45.699l8.284 66.275h-37.414l-16.569-66.275zm16.008 223.982c-12.043 0-21.841-9.798-21.841-21.842 0-12.043 9.798-21.841 21.841-21.841s21.841 9.798 21.841 21.841c0 12.044-9.798 21.842-21.841 21.842zm224.036 0c-12.043 0-21.841-9.798-21.841-21.842 0-12.043 9.798-21.841 21.841-21.841 12.043 0 21.841 9.798 21.841 21.841 0 12.044-9.798 21.842-21.841 21.842z" fill="#ffff" data-original="#000000" class=""></path></g></svg>
                PANEL D'ADMINISTRATION</h1>
        </div>
        <div  class="gestion">
            <a  href="{{route('getvalidateFalse')}}"  class="g">
                <img src="{{asset('images/logos/stamp (1).png')}}"/>
                <h3>
                    VALIDATION DES ANNONCES
                </h3>
            </a>
            <a href="{{route('users.index')}}" class="g">
            <img src="{{asset('images/logos/icons8-member-100.png')}}"/>
                <h3>SUPPRIMER UN MEMBRE</h3>
            </a>
            <a  href="{{route('categories.index')}}" class="g">
                <img src="{{asset('images/logos/evaluation.png')}}"/>
                <h3>GESTION DES CATEGORIES</h3>
            </a>
            <a href="{{route('villes.index')}}" class="g">
                <img  src="{{asset('images/logos/earth.png')}}"/>
                <h3>GESTION DES VILLES</h3>
            </a>
            <a  href="{{route('annonces.index')}}" class="g">
            <img src="{{asset('images/logos/tools.png')}}"/>
                <h3>SUPPRIMER UNE ANNONCE</h3>
            </a>
        </div>
    </div>
            @endif
        @endif            
            @yield('content')
        </div>  
    </div>
</body>
</html>