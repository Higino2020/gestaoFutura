<?php

namespace App\Http\Controllers;

use App\Models\PreVenda;
use Illuminate\Http\Request;

class PreVendaController extends Controller
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
        $prev = null;
        if(isset($request->id)){
            $prev = PreVenda::find($request->id);
        }else{
            $prev = new PreVenda();
        }
        $prev->produto_id = $request->produto_id;
        $prev->qtd = $request->qtd;
        $prev->total = $request->total;
        $prev->save();
        return redirect()->back()->with('Sucesso','Prevenda Realizada');
    }

   public function novaSaida(){
        $pre= PreVenda::all();
        $pre->delete();
        return "Em Algum Sitio";
   }
    public function show($id)
    {
        $pre = PreVenda::find($id);
        $pre->delete();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PreVenda $preVenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PreVenda $preVenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreVenda $preVenda)
    {
        //
    }
}
