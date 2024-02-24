<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\PreVenda;
use App\Models\Produto;
use App\Models\Saida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $saida = null;
        // if(isset($request->id)){
        //     $saida = Saida::find($request->id);
        //     $produto = Produto::find($request->produto_id);
        //     if($request->qtd > $saida->qtd){
        //         $produto->qtd = $produto->qtd - ($request->qtd - $saida->qtd); 
        //     }else{
        //         if($request->qtd < $saida->qtd){
        //             $produto->qtd = $produto->qtd + ($saida->qtd - $request->qtd); 
        //         } 
        //     }
        //     $produto->save();
        // }else{
        
        $prev = PreVenda::all();
        $total = 0;
        $valorPago = $request->valorpagar;
        foreach($prev as $pre){
            $saida = new Saida();
            $produto = Produto::find($pre->produto_id);
            $produto->qtd -= 1;
            $produto->save();
            $saida->qtd = 1;
            $saida->total = $pre->produto->preco;
            $saida->data_saida = date('Y-m-d');
            $saida->descricao = "";
            $saida->produto_id = $pre->produto_id;
            $saida->save();
            $total += $pre->produto->preco;
        }
        $caixa = Caixa::where('user_id',Auth::user()->id)->where('estado','Aberto')->first();
        if($caixa == null){
            $caixa = new Caixa();
            $caixa->user_id = Auth::user()->id;
            $caixa->total = $total;
            $caixa->estado = "Aberto";
            $caixa->save();
        }else{
            $caixa->total += $total;
            $caixa->save();
        }
        return view('buy.saida.recibo', compact('total','prev','valorPago'));
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
