@extends('layouts.baseAdmin')
@section('facturar')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Fornecedor</h1>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">lista de fornecedor</h6>
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
                            <th>Nome do fornecedor</th>
                            <th>Tipo de Produto fornecido</th>
                            <th>Descrição</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($fornecedor as $item)
                            <tr>
                               <th>{{$item->nome}}</th> 
                               <th>{{$item->tipoProduto}}</th> 
                               <th>{{$item->descricao}}</th> 
                               <th>
                                <a href="#Cadastro" onclick="editar({{$item}})" data-toggle="modal" class="text-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="{{route('fornecedor.show',$item->id)}}" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                <h5 class="modal-title">Cadastro de fornecedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{route('fornecedor.store')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="nome"><b>Nome do Fornecedor</b></label>
                        <div class="">
                            <input type="text" name="nome" id="nome" class="form-control" placeholder="Paulo Andrade">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="tipoProduto"><b>Tipo de Produtos fornecidos</b></label>
                        <div class="">
                            <select name="tipoProduto" class="form-control" id="tipoProduto">
                                <option value="Perecivel">Perecivel</option>
                                <option value="N/Perecivel">N/Perecivel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descricao"><b>Descrição do fornecedor</b></label>
                        <div class="">
                            <textarea style="resize: none" name="descricao" id="descricao" cols="30" rows="4"  class="form-control" ></textarea>
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
        document.getElementById('nome').value = valor.nome;
        document.getElementById('tipoProduto').value = valor.tipoProduto;
        document.getElementById('descricao').value = valor.descricao;
    }
</script>
@endsection