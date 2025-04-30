<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Validator;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();       
        return view("categories.index",compact("categories"));
    }
    public function create()
    {
        return view("categories.create");
    }
    public function store(Request $request)
    {
        Validator::make($request->all() ,[
            'libelle' => 'required',
            'description' => 'required'
        ]);
        
        $categorie = Categorie::create($request->all());
        return redirect()->route("categories.index")->with("success","Catégories bien ajoutée");
    }

    public function show($id)
    {
        $cat= Categorie::findOrFail($id);       
        return view("categories.show", compact("cat"));
    }
    public function edit($id)
    {
        $cat = Categorie::findOrFail($id);       
        return view("categories.edit", compact("cat"));
    }

    public function update($id, Request $request)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) return response()->json(['message' => 'Categorie not found'], 404);
        $validator = Validator::make($request->all() ,[
            'libelle' => 'required',
            'description' => 'required'
        ]);
        $categorie->update($request->all());
        return redirect()->route("categories.index")->with("success","Catégorie bien modifiée");
    }

    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);    
        $categorie->delete();
        return redirect()->route("categories.index")->with("success","Catégorie bien supprimée");
    }

}
