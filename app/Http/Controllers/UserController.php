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
        return view('pages.user',compact('user'));
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
        if(isset($request->id)){
            $user = User::find($request->id);
        }else{
            $user = new User();
        }

        $user->name = $request->nome;
        $user->tipo = "Funcionario";
        $user->password = "funcionario";
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('Sucesso','Funcionario cadastrado com exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = User::find($user)->delete();
        return redirect()->back()->with('Sucesso','Funcionario eliminado com exito');
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
