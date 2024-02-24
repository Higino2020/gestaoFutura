<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Plank\Mediable\Facades\MediaUploader;
class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produto = Produto::orderBy('id','DESC')->get();
        return view('admin.produtos',compact('produto'));
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
        $produto = null;
        $sms = "";
        $verify = Produto::where('codigo',$request->codigo)->first();
        if($verify != null){
            return redirect()->back()->with('Error', "Este codigo já se encontra em uso");
        }

        if(isset($request->id)){
            $produto = Produto::find($request->id);
            $sms = 'Produto actualizado com exito';
        }else{
            $produto = new Produto();
            $sms = 'Produto cadastrado com exito';
        }
        if (request()->hasFile('foto')) {
            $media = MediaUploader::fromSource(request()->file('foto'))
                ->toDirectory('produto')->onDuplicateIncrement()
                ->useHashForFilename()
                ->setAllowedAggregateTypes(['image'])->upload();
            $produto->foto = $media->basename;
        }
        $produto->codigo = $request->codigo;
        $produto->nome = $request->nome;
        $produto->medicao = $request->medicao;
        $produto->qtdaVender = 0;
        $produto->qtd = $request->qtd;
        $produto->preco = $request->preco;
        $produto->caducidade = $request->caducidade;
        $produto->perecivel = $request->perecivel;
        $produto->categoria_id = $request->categoria_id;

        $produto->save();
        return redirect()->back()->with('Sucesso', $sms);

    }

    /**
     * Display the specified resource.
     */
    public function show( $produto)
    {
        $produto  = Produto::find($produto);
        return view('',compact('produto'));
    }
    public function apagar( $produto)
    {
        $produto  = Produto::find($produto)->delete();
        return redirect()->back()->with('Sucesso','Produto Eliminado com exito');

    }

    
}
