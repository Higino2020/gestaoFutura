<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('tipo','<>','Admin')->get();
        return view('admin.utilizador',compact('user'));
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
        $user = null;
        $sms ="";
        if(isset($request->id)){
            $user = User::find($request->id);
            $sms = 'Utilizador actualizado com exito';
        }else{
            $user = new User();
            $sms = "Utilizador cadastrado com exito";
        }

        $user->name = $request->nome;
        $user->tipo = $request->tipo;
        $user->password = bcrypt("funcionario");
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('Sucesso',$sms);
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = User::find($user)->delete();
        return redirect()->back()->with('Sucesso','Utilizador eliminado com exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user)
    {
        $user = User::find($user);
        return view('pages.user_view',compact('user'));
    }

    
}
