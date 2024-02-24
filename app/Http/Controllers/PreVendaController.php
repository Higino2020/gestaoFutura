<?php

namespace App\Http\Controllers;

use App\Models\Caixa;
use App\Models\PreVenda;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $prev->user_id = Auth::user()->id;
        $prev->save();
        return redirect()->back()->with('Sucesso','Prevenda Realizada');
    }
    public function comprar($id){
        $prod = Produto::find($id);
        $prev = new PreVenda();
        $prev->produto_id = $prod->id;
        $prev->qtd = 1;
        $prev->total = 1;
        $prev->user_id = Auth::user()->id;
        $prev->save();
        return redirect()->route('buy');
    }

   public function novaSaida(){
        $pre= PreVenda::where('user_id',Auth::user()->id)->get();
        foreach($pre as $del){
            $del->delete();
        }
        return redirect()->route('buy');
   }
    public function show($id)
    {
        $pre = PreVenda::find($id);
        $pre->delete();
        return redirect()->back();
    }

    public function imprimir(){
        $prev = PreVenda::where('user_id',Auth::user()->id)->get();
        $total = 0;
        foreach($prev as $pre){
            $total += $pre->produto->preco;
        }
        $valorPago = 0;
        return view('buy.saida.recibo', compact('total','prev','valorPago'));
    }

    public function fechar(){
        $caixa = Caixa::where('user_id',Auth::user()->id)->where('estado','Aberto')->first();
        $caixa->estado = "Fechado";
        $caixa->save();
        Auth::logout();
        return view('auth.login');
    }
}
