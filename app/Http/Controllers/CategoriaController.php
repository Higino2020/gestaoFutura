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
        return view('admin.categoria',compact('categoria'));
    }

    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        $categoria = null;
        $sms = "";
        if(isset($request->id)){
            $categoria = Categoria::find($request->id);
            $sms ='Categoria Actualizada com exito';
        }else{
            $categoria = new Categoria();
            $sms ='Categoria cadastrada com exito';
        }
        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;
        $categoria->save();
        return redirect()->back()->with('Sucesso',$sms);
    }

    /**
     * Display the specified resource.
     */
    public function show( $categoria)
    {
        $user = Categoria::find($categoria)->delete();
        return redirect()->back()->with('Sucesso','Categoria eliminada com exito');
    }

}
