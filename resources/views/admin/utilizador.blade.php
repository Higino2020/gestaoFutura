@extends('layouts.baseAdmin')
@section('facturar')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Utilizador</h1>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">lista de utilizador</h6>
            <a href="#Cadastro" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
            @if(session('Error'))
                <div class="alert alert-danger">
                    <p>{{session('Error')}}</p>
                </div>
            @endif
            @if(session('Sucesso'))
                <div class="alert alert-success">
                    <p>{{session('Sucesso')}}</p>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email/nome de acesso</th>
                            <th>Tipo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($user as $item)
                            <tr>
                               <th>{{$item->name}}</th> 
                               <th>{{$item->email}}</th> 
                               <th>{{$item->tipo}}</th> 
                               <th>
                                <a href="#Cadastro" onclick="editar({{$item}})" data-toggle="modal" class="text-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="{{route('user.show',$item->id)}}" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                               </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Cadastro" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro de Utilizador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.store')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="name"><b>Nome do Utilizador</b></label>
                        <div class="">
                            <input type="text" name="nome" id="name" class="form-control" placeholder="Paulo Andrade">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email"><b>E-mail ou nome de acesso</b></label>
                        <div class="">
                            <input type="text" name="email" id="email" class="form-control" placeholder="andrade@alguma.com/pauloandrade">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipo"><b>Tipo de Utilizador</b></label>
                        <div class="">
                            <select name="tipo" class="form-control" id="tipo">
                                <option value="Gestor">Gestor</option>
                                <option value="Funcionario">Funcionario</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
<script class="">
    function editar(valor){
        document.getElementById('id').value = valor.id;
        document.getElementById('name').value = valor.name;
        document.getElementById('tipo').value = valor.tipo;
        document.getElementById('email').value = valor.email;
    }
</script>
@endsection