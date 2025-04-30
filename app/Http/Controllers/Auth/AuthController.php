<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Annonce;
use App\Models\User;
use Validator;

class AuthController extends Controller

{
    public function register(){        
        return view('users.register');
    }
    
    public function registerPost(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'c_password' => 'required|same:password',
        'sexe' => 'required',
        'telephone' => 'required',
        'username' => 'required',
        'prenom' => 'required',
        'nom' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    if ($request->hasFile('profile')) {
        $file = $request->file('profile');
        $photo = time().'_profile.'.$file->extension();
        $file->move(public_path('/images/profile/'), $photo);
    } else {
        $photo = 'default.png';
    }

    $input = $request->all();
    $input['profile'] = $photo;
    $input['password'] = Hash::make($input['password']);
    $user = User::create($input);

    return redirect()->route('register')->with('success', 'Inscription réussie ! Veuillez vous connecter.');
}
public function login(){        
    return view('users.register');
}

    public function loginPost()
{   
    if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) { 
        $user = Auth::user(); 
        $token = $user->createToken('auth_token')->accessToken;
        return redirect()->route('annonces.index')->with('success'," Bienvenue dans notre communauté ! "); 
     
    } else {
        return redirect()->route('register')->with('failed'," Nom d'utilisateur et/ou Mot de passe incorrect ");
    }
}

public function logout()
{    
    
    Auth::logout();   
   
    return redirect()->route("register");
}



    public function profile()
    {
        $user=auth()->user();
        return view("users.profile", compact("user"));
    }

    public function index()
    {
        $userAuth=Auth::user();
        if($userAuth->role=="admin"){
            $users = User::all();
            return view('users.index',compact("users"));
        }
        else{
            redirect()->route("login")->with("success","Merci de vous authentifier");
        }
    }
    public function edit($id){
        $user=User::find($id);
        if($user==null || auth()->user()->id != $id ){
            return redirect()->route("annonces.index");
        }
        return view("users.edit", compact("user"));
    }

    public function show($id)
    {
      
        $user = User::find($id);  
        if($user==null){
            return redirect()->route("users.index")->with('success', 'User not found');
        }      
        $annonces = Annonce::where('user', $id)->get();
        if($annonces->isEmpty()){
            return redirect()->route("users.index")->with('success', 'User not found');
        }
        $user->annonces = $annonces;
        return view("users.show",compact("user","annonces"));
    }



    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $request->validate([
            'email' => 'email',
            'password' => 'min:6',
            'old_password' => 'required_with:password',
            'profile' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);       
        if (isset($request->password)) {
            if (!Hash::check($request->old_password, $user->password)) 
             return redirect()->route("profile")->with('failed' , "l'ancien mot de passe est incorrect");
            $user->password = bcrypt($request->password);
        }
        if ($request->hasFile('profile')) {
            $path = public_path('/images/profile/'.$user->profile);
            if (file_exists($path)) unlink($path);
            $file = $request->file('profile');
            $photo = time() . '_profile.' . $file->extension();
            $file->move(public_path('/images/profile/'), $photo);
            $user->profile = $photo;
        }
        if (isset($request->email)) $user->email = $request->email;
        if (isset($request->sexe)) $user->sexe = $request->sexe;
        if (isset($request->telephone)) $user->telephone = $request->telephone;
        if (isset($request->username)) $user->username = $request->username;
        if (isset($request->prenom)) $user->prenom = $request->prenom;
        if (isset($request->nom)) $user->nom = $request->nom;
        $user->save();
        return redirect()->route("profile")->with("success","Les modifications bien enregistrées ");
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if ($user==null) {
        return redirect()->route("users.index")->with('success', 'User not found');
    }
        if (!$user) 
        return redirect()->route("users.index")->with('success', 'User not found');
        if (Auth::user()->role != 'admin' &&  Auth::user()->id != $user->id) 
        return redirect()->route("users.index")->with('success', 'Unauthorized. Token not provided.');
        $user->delete();
        return redirect()->route("users.index")->with('success' , "l'utilisateur ".$user->nom." est bien supprimé");
    }
}
