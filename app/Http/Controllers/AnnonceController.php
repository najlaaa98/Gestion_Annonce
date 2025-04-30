<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Annonce;
use App\Models\Ville;
use App\Models\Categorie;

use Validator;

class AnnonceController extends Controller
{
    public function index(Request $request)
    {
        $annonces= DB::table("annonces")
        ->join("villes","villes.id","annonces.ville")
        ->join("categories","categories.id","annonces.categorie")
        ->Select('annonces.*',"villes.ville","categories.libelle")
        ->where('validated', 1)->get();
     
        foreach ($annonces as $annonce) {
            $annonce->images = json_decode($annonce->images);
        }
        $lettre="";
        $villes = Ville::all();
        $categories = Categorie::all();
        $ville=$request->input('ville');
        $categorie=$request->input('categorie');
        $sort=$request->input('sort');   
        if( $request->has('sort')){                         
            switch ($sort) {
                case "ville":
                    $annonces = DB::table("annonces")
                    ->join("villes","villes.id","annonces.ville")
                    ->join("categories","categories.id","annonces.categorie")
                    ->Select('annonces.*',"villes.ville","categories.libelle")
                    ->where('validated', 1)
                    ->orderBy("villes.ville")
                     ->get(); 
                    foreach ($annonces as $annonce) {
                        $annonce->images = json_decode($annonce->images);
                    }
                    return view("annonces.index", compact("annonces", "villes", "categories","sort","ville","categorie")); 
                    
                    break;
                case "categorie":
                    $annonces =DB::table("annonces")
                    ->join("villes","villes.id","annonces.ville")
                    ->join("categories","categories.id","annonces.categorie")
                    ->Select('annonces.*',"villes.ville","categories.libelle")
                    ->where('validated', 1)
                    ->orderBy("categories.libelle")
                    ->get();
                    foreach ($annonces as $annonce) {
                        $annonce->images = json_decode($annonce->images);
                    }
                    return view("annonces.index", compact("annonces", "villes", "categories","sort","ville","categorie")); 
                    break;
        
                case "prix":
                    $annonces = DB::table("annonces")
                    ->join("villes","villes.id","annonces.ville")
                    ->join("categories","categories.id","annonces.categorie")
                    ->Select('annonces.*',"villes.ville","categories.libelle")
                    ->where('validated', 1)
                        ->orderBy("prix")
                        ->get();
                    foreach ($annonces as $annonce) {
                        $annonce->images = json_decode($annonce->images);
                    }
                    return view("annonces.index", compact("annonces", "villes", "categories","sort" ,"ville","categorie")); 
                    break;
                
                case "date":
                    $annonces =DB::table("annonces")
                    ->join("villes","villes.id","annonces.ville")
                    ->join("categories","categories.id","annonces.categorie")
                    ->Select('annonces.*',"villes.ville","categories.libelle")
                    ->where('validated', 1)
                    ->orderBy("created_at")
                    ->get();
                    foreach ($annonces as $annonce) {
                        $annonce->images = json_decode($annonce->images);
                    }
                    return view("annonces.index", compact("annonces", "villes", "categories","sort","ville","categorie")); 
                    break;
                default: 
                    $annonces = Annonce::where('validated', 1)->with('categorie', 'ville', 'user')->get();
                    foreach ($annonces as $annonce) {
                        $annonce->images = json_decode($annonce->images);
                    }
                    return view("annonces.index", compact("annonces", "villes", "categories","sort","ville","categorie")); 
                    break;
                    
                }
                
        }
        if($request->has("ville")) {
            $annonces =DB::table("annonces")
                    ->join("villes","villes.id","annonces.ville")
                    ->join("categories","categories.id","annonces.categorie")
                    ->Select('annonces.*',"villes.ville","categories.libelle")
                    ->where('validated', 1)
                    ->where("villes.ville",'=',$ville)
                    ->get();
                    foreach ($annonces as $annonce) {
                        $annonce->images = json_decode($annonce->images);
                    }
            }
        if($request->has("categorie")) {
            $annonces =DB::table("annonces")
                    ->join("villes","villes.id","annonces.ville")
                    ->join("categories","categories.id","annonces.categorie")
                    ->Select('annonces.*',"villes.ville","categories.libelle")
                    ->where('validated', 1)
                    ->where("categories.libelle",'=',$categorie)
                    ->get();
                    foreach ($annonces as $annonce) {
                        $annonce->images = json_decode($annonce->images);
                    }
        }  
        $annonce=null;
        if($request->has('lettre')){
            $lettre=$request->input('lettre');
            $annonces = DB::table("annonces")
            ->join("villes","villes.id","annonces.ville")
            ->join("categories","categories.id","annonces.categorie")
            ->Select('annonces.*',"villes.ville","categories.libelle")
            ->where('validated', 1)         
            ->where('titre','like','%'.$lettre.'%')        
             ->get(); 
            foreach ($annonces as $ann) {
                $ann->images = json_decode($ann->images);
            }
          $annonce= DB::table("annonces")
          ->join("villes","villes.id","annonces.ville")
          ->join("categories","categories.id","annonces.categorie")
          ->Select('annonces.*',"villes.ville","categories.libelle")
          ->where('validated', 1)         
          ->where('titre','like','%'.$lettre.'%')        
           ->get();   
           foreach ($annonce as $ann) {
            $ann->images = json_decode($ann->images);
            }    
        }
    
       if( $annonce==null){
            return view("annonces.index",compact("annonces","annonce", "villes", "categories","sort","lettre","ville","categorie"))->with("success","Aucune Annonce Trouvée") ;
        }
        else{
            return view("annonces.index", compact("annonces","annonce", "villes", "categories","sort","lettre","ville","categorie")); 
        }
          
        return view("annonces.index", compact("annonces", "villes", "categories","sort","lettre","ville","categorie")); 

          
        }

    

    
        
        
 
    public function create(){
        $villes=Ville::all();
        $categories=Categorie::all();
        if(!auth()->check()){
            return redirect()->route("annonces.index");
        }
        return view("annonces.create" ,compact("villes","categories"));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'ville' => 'required',
            'categorie' => 'required',
            'image1' => 'required|mimes:jpeg,jpg,png,gif|required|max:10000',
            'image2' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'image3' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'image4' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'image5' => 'mimes:jpeg,jpg,png,gif|max:10000',

        ]);

        $user = Auth::user();       
        $images = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                $image = $request->file('image' . $i);
                $imageName = time().'_image'.$i.'.'.$image->extension();
                $image->move(public_path('images/annonces'), $imageName);
                $images['image' . $i] = $imageName;
            }
        }
        if (!$user) return redirect()->route("annonces.index")->with("success","Veillez vous authentifier "); 
        $annonce = new Annonce();
        $annonce->titre = $request->titre;
        $annonce->description = $request->description;
        $annonce->prix = $request->prix;
        $annonce->ville = $request->ville;
        $annonce->categorie = $request->categorie;
        $annonce->user = $user->id;
        $annonce->images = json_encode($images);
        $annonce->save();

        return redirect()->route("annonces.index")->with("success","Veuillez patienter pendant que nous examinons votre demande. L'approbation des administrateurs est requise !");
    }

    public function show($id)
    {     
        $annonce = Annonce::with('categorie', 'ville', 'user')->find($id); 
        $annonces= DB::table("annonces")
        ->join("villes","villes.id","annonces.ville")
        ->join("categories","categories.id","annonces.categorie")
        ->select("villes.ville","categories.libelle")
        ->where('validated', 1)
        ->where('annonces.id',$id)        
        ->get(); 
        if ($annonce==null or $annonces->isEmpty()) {
            return redirect()->route('annonces.index')->with("failed","Annonce introuvable");
         }
      
          
     
        if ( $annonce->validated == 0 && Auth::user()->id != $annonce->user && Auth::user()->role != 'admin') {
            return redirect()->route('annonces.index')->with("failed","Annonce invalidée");
        }
        $annonce->load('categorie', 'ville', 'user');
        $annonce->images = json_decode($annonce->images);
        

        return view("annonces.show",compact("annonce","annonces"));
    }
    public function edit($id)
    {
        $annonce = Annonce::with('categorie', 'ville', 'user')->find($id);      
        $villes = Ville::all();  
        $categories=Categorie::all();
        if ($annonce==null or $annonce->validated == 0 && Auth::user()->id != $annonce->user ) {
            return redirect()->route('annonces.index')->with("failed","Annonce not validated");
        }
        $annonce->load('categorie', 'ville', 'user');
        $annonce->images = json_decode($annonce->images);

        return view("annonces.edit",compact("annonce",'villes','categories'));
    }

    public function update(Request $request, $id)
    {
        $annonce = Annonce::find($id);
       
        $user = Auth::user();
        if ($user->id != $annonce->user) {
            return redirect()->route('annonces.index')->with("failed","ce n'est pas votre annonce");
        }
        Validator::make($request->all(),[
            'titre' => '',
            'description' => '',
            'prix' => '',
            'ville' => '',
            'categorie' => '',
            'image1' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'image2' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'image3' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'image4' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'image5' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        
        $images = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                $images = json_decode($annonce->images, true);
                    if (isset($images['image'.$i])) {
                        $path = public_path('images/annonces/' . $images['image' . $i]);
                        if (file_exists($path)) unlink($path);
                    }
                $image = $request->file('image' . $i);
                $imageName = time().'_image'.$i.'.'.$image->extension();
                $image->move(public_path('images/annonces'), $imageName);
                $images['image' . $i] = $imageName;
            }
        }
        if ($request->titre) $annonce->titre = $request->titre;
        if ($request->description) $annonce->description = $request->description;
        if ($request->prix) $annonce->prix = $request->prix;
        if ($request->ville) $annonce->ville = $request->ville;
        if ($request->categorie) $annonce->categorie = $request->categorie;
        if ($images) $annonce->images = json_encode($images);
        $annonce->save();
        return redirect()->route('annonces.index')->with("success","Annonce bien modifiée");
    }

    public function getvalidateFalse()
    {
        $annonces = DB::table("annonces")
        ->join("villes","villes.id","annonces.ville")
        ->join("categories","categories.id","annonces.categorie")
        ->Select('annonces.*',"villes.ville","categories.libelle")
        ->where('validated', 0)->get();
        foreach ($annonces as $annonce) {
            $annonce->images = json_decode($annonce->images);
        }
        
        return view('annonces.validate', compact("annonces"));
    }

    public function setVlidateTrue($id)
    {
        $annonce = Annonce::find($id);      
        $annonce->validated = 1;
        $annonce->save();
        return redirect()->route('getvalidateFalse')->with("valider","Annonce validée");
    }

    public function destroy($id)
    {
        $annonce = Annonce::find($id);
        if(!auth()->checK()){
            return redirect()->route("login")->with('success' , 'veuillez vous authentifier ');

        }
        $user = Auth::user();
        if ($annonce->user == $user->id || $user->role == 'admin'){
            $images = json_decode($annonce->images, true);
            for ($i = 1; $i < 6; $i++) {
                if (isset($images['image'.$i])) {
                    $path = public_path('images/annonces/' . $images['image' . $i]);
                    if (file_exists($path)) unlink($path);
                }
            }
            $annonce->delete();
            return redirect()->route("users.index")->with('success' , 'Annonce bien supprimée');
        }
        redirect()->route("annonces.index")->with("success","Annoce bien supprimée "); 
    }
    public function search(Request $request){
        $annonce=null;
        if($request->has('lettre')){
            $lettre=$request->input('lettre');
            $annonce = DB::table("annonces")
            ->join("villes","villes.id","annonces.ville")
            ->join("categories","categories.id","annonces.categorie")
            ->Select('annonces.*',"villes.ville","categories.libelle")
            ->where('validated', 1)         
            ->where('titre','like','%'.$lettre.'%')        
             ->get(); 
            foreach ($annonce as $ann) {
                $ann->images = json_decode($ann->images);
            }
          $annonces= DB::table("annonces")
          ->join("villes","villes.id","annonces.ville")
          ->join("categories","categories.id","annonces.categorie")
          ->Select('annonces.*',"villes.ville","categories.libelle")
          ->where('validated', 1)         
          ->where('titre','like','%'.$lettre.'%')        
           ->get();              
                  
             
        }
    
       if( $annonce==null){

            return view("annonces.search",compact("annonce"))->with("success","Aucune Annonce Trouvée") ;
        }
        else{
            return view("annonces.search", compact("annonce","lettre","annonces"));

        }
       
    }
    public function ParCategorie(){
        $categorie=$request->input('categorie');
        if($request->has("categorie")) {
        $annonces=DB::table("annonces")
        ->join("categories","categories.id","=","annonces.categorie")
        ->where("categories.libelle",'=',$categorie)
        ->get();
    }  
        return view("annonces.parcategorie",compact("annonces"));
    }
    public function ParVille(){
        $ville=$request->input('ville');
        if($request->has("ville")) {
        $annonces=DB::table("annonces")
        ->join("villes","villes.id","=","annonces.ville")
        ->where("villes.ville",'=',$ville)
        ->get();
        }
        return view("annonces.parville",compact("annonces"));
    }
    public function immobilier()
    {
        $annonces= DB::table("annonces")
        ->join("villes","villes.id","annonces.ville")
        ->join("categories","categories.id","annonces.categorie")
        ->Select('annonces.*',"villes.ville","categories.libelle")
        ->where('validated', 1)
        ->where('categories.libelle',"like","immobilier")
        ->get();
     
        foreach ($annonces as $annonce) {
            $annonce->images = json_decode($annonce->images);
        }
        return view("annonces.immobilier",compact("annonces"));
    }
    public function multimedia()
    {
        $annonces= DB::table("annonces")
        ->join("villes","villes.id","annonces.ville")
        ->join("categories","categories.id","annonces.categorie")
        ->Select('annonces.*',"villes.ville","categories.libelle")
        ->where('validated', 1)
        ->where('categories.libelle',"like","multimedia")
        ->get();
     
        foreach ($annonces as $annonce) {
            $annonce->images = json_decode($annonce->images);
        }
        return view("annonces.multimedia",compact("annonces"));
    }
    public function maison()
    {
        $annonces= DB::table("annonces")
        ->join("villes","villes.id","annonces.ville")
        ->join("categories","categories.id","annonces.categorie")
        ->Select('annonces.*',"villes.ville","categories.libelle")
        ->where('validated', 1)
        ->where('categories.libelle',"like","maison")
        ->get();
     
        foreach ($annonces as $annonce) {
            $annonce->images = json_decode($annonce->images);
        }
        return view("annonces.maison",compact("annonces"));
    }
    public function vehicule()
    {
        $annonces= DB::table("annonces")
        ->join("villes","villes.id","annonces.ville")
        ->join("categories","categories.id","annonces.categorie")
        ->Select('annonces.*',"villes.ville","categories.libelle")
        ->where('validated', 1)
        ->where('categories.libelle',"like","vehicule")
        ->get();
     
        foreach ($annonces as $annonce) {
            $annonce->images = json_decode($annonce->images);
        }
        return view("annonces.vehicule",compact("annonces"));
    }
    public function emploi()
    {
        $annonces= DB::table("annonces")
        ->join("villes","villes.id","annonces.ville")
        ->join("categories","categories.id","annonces.categorie")
        ->Select('annonces.*',"villes.ville","categories.libelle")
        ->where('validated', 1)
        ->where('categories.libelle',"like","emploi")
        ->get();
     
        foreach ($annonces as $annonce) {
            $annonce->images = json_decode($annonce->images);
        }
        return view("annonces.emploi",compact("annonces"));
    }
    public function objet()
    {
        $annonces= DB::table("annonces")
        ->join("villes","villes.id","annonces.ville")
        ->join("categories","categories.id","annonces.categorie")
        ->Select('annonces.*',"villes.ville","categories.libelle")
        ->where('validated', 1)
        ->where('categories.libelle',"like","objet")
        ->get();
     
        foreach ($annonces as $annonce) {
            $annonce->images = json_decode($annonce->images);
        }
        return view("annonces.objet",compact("annonces"));
    }
}
