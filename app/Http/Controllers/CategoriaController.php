<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria = Categoria::orderBy('id','DESC')->get();
        return view('pages.categoria',compact('categoria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = null;
        if(isset($request->id)){
            $categoria = Categoria::find($request->id);
        }else{
            $categoria = new Categoria();
        }
        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;
        $categoria->save();
        return redirect()->back()->with('Sucesso','Categoria cadastrado com exito');
    }

    /**
     * Display the specified resource.
     */
    public function show( $categoria)
    {
        $user = User::find($categoria)->delete();
        return redirect()->back()->with('Sucesso','Categoria eliminado com exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
