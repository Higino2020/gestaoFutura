<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fornecedor = Fornecedor::orderBy('id','DESC')->get();
        return view('',compact('fornecedor'));
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
        $fornecedor = null;
        if(isset($request->id)){
            $fornecedor = Fornecedor::find($request->id);
        }else{
            $fornecedor = new Fornecedor();
        }
        $fornecedor->nome = $request->nome;
        $fornecedor->tipoProduto = $request->tipoProduto;
        $fornecedor->descricao = $request->descricao;
        $fornecedor->save();
        return redirect()->back()->with('Sucesso','fornecedor cadastrado com exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($fornecedor)
    {
        Fornecedor::find($fornecedor)->delete();
        return redirect()->back()->with('Sucesso','fornecedor eliminado com exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornecedor $fornecedor)
    {
        //
    }
}
