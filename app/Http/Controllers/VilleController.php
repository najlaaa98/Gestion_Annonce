<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;
use Validator;

class VilleController extends Controller
{
    public function index()
    {
        $villes = Ville::all();
        return view("villes.index",compact("villes"));
    }
    public function create()    {
        
        return view("villes.create");
    }

    public function store(Request $request)
    {
         Validator::make($request->all() ,[
            'ville' => 'required'
        ]);
        
        $ville = Ville::create($request->all());
        return redirect()->route("villes.index")->with("success","ville bien ajoutée");
    }

    public function show($id)
    {
        $ville = Ville::find($id);
        return view("villes.show");
    }
    public function edit($id)
    {
        $ville = Ville::find($id);
        return view("villes.edit",compact("ville"));
    }

    public function update(Request $request, $id)
    {
        $existingVille = Ville::find($id);

        $existingVille->update($request->all());

        return redirect()->route("villes.index")->with("success","ville bien modifiée");
    }



    public function destroy($id)
    {
        $existingVille = Ville::findOrFail($id);       
        $existingVille->delete();
        return redirect()->route("villes.index")->with("success","ville bien supprimée");
    }
}
