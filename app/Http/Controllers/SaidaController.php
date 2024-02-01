<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Saida;
use Illuminate\Http\Request;

class SaidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $saida = null;
        if(isset($request->id)){
            $saida = Saida::find($request->id);
            $produto = Produto::find($request->produto_id);
            if($request->qtd > $saida->qtd){
                $produto->qtd = $produto->qtd - ($request->qtd - $saida->qtd); 
            }else{
                if($request->qtd < $saida->qtd){
                    $produto->qtd = $produto->qtd + ($saida->qtd - $request->qtd); 
                } 
            }
            $produto->save();
        }else{
            $saida = new Saida();
            $produto = Produto::find($request->id_produto);
            if($produto->qtd <= $request->qtd){
                $produto->qtd = $produto->qtd - $request->qtd;
                $produto->save();
            }else{
                return redirect()->back()->with('Error','Stoqeu indisponivel para esta compra');
            }
        }

        $saida->qtd = $request->qtd;
        $saida->data_saida = $request->data_saida;
        $saida->descricao = $request->descricao;
        $saida->produto_id = $request->produto_id;
        $saida->save();
        return redirect()->back()->with('Sucesso','Saida Realizada com exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Saida $saida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saida $saida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saida $saida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saida $saida)
    {
        //
    }
}
