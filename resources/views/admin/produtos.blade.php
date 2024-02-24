@extends('layouts.baseAdmin')
@section('facturar')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">lista de Produtos</h6>
            <a href="#Cadastro" onclick="limpar()" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
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
                            <th>#</th>
                            <th>Cdg</th>
                            <th>Nome</th>
                            <th>Medidas</th>
                            <th>Qtd</th>
                            <th>Preço Unit</th>
                            <th>Caducidade</th>
                            <th>Perecivel</th>
                            <th>Categoria</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($produto as $item)
                            <tr>
                               <th><img src="{{url('getfile/'.$item->foto)}}" class="img-fluid" alt=""></th> 
                               <th>{{$item->codigo}}</th> 
                               <th>{{$item->nome}}</th> 
                               <th>{{$item->medicao}}</th> 
                               <th>{{$item->qtd}}</th> 
                               <th>{{number_format($item->preco, 2, ',', '.')}} Kz</th> 
                               <th>{{$item->caducidade}}</th> 
                               <th>{{$item->perecivel}}</th> 
                               <th>{{$item->categoria->nome}}</th> 
                               <th>
                                <a href="#Cadastro" onclick="editar({{$item}})" data-toggle="modal" class="text-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="{{route('produto.apagar',$item->id)}}" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                <h5 class="modal-title">Cadastro de Produtos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{route('produto.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="foto"><b>Imagem do Produto</b></label>
                        <div class="">
                            <input type="file" accept="image/*" name="foto" id="foto" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="codigo"><b>Codigo do Produto</b></label>
                        <div class="">
                            <input type="text" name="codigo" id="codigo" class="form-control" placeholder="000000000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome"><b>Nome do Produto</b></label>
                        <div class="">
                            <input type="text" name="nome" id="nome" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="medicao"><b>Medidas</b></label>
                        <div class="">
                            <select name="medicao" class="form-control" id="medicao">
                                <option value="Kilograma">Kilograma</option>
                                <option value="Caixa">Caixa</option>
                                <option value="Unidade">Unidade</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="qtd"><b>Quantidade Existente</b></label>
                        <div class="">
                            <input type="number" min="0" name="qtd" id="qtd" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="preco"><b>Preço por Unidade</b></label>
                        <div class="">
                            <input type="text" min="0" name="preco" id="preco" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="caducidade"><b>Data de caducidade</b></label>
                        <div class="">
                            <input type="date" min="0" name="caducidade" id="caducidade" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="perecivel"><b>Perecivel</b></label>
                        <div class="">
                            <select name="perecivel" class="form-control" id="perecivel">
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoria_id"><b>Categoria</b></label>
                        <div class="">
                            <select name="categoria_id" class="form-control" id="categoria_id">
                                @foreach (App\Models\Categoria::all() as $cate)
                                    <option value="{{$cate->id}}">{{$cate->nome}}</option>
                                @endforeach
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
        document.getElementById('preco').value = valor.preco;
        document.getElementById('nome').value = valor.nome;
        document.getElementById('codigo').value = valor.codigo;
        document.getElementById('medicao').value = valor.medicao;
        document.getElementById('qtd').value = valor.qtd;
        document.getElementById('perecivel').value = valor.perecivel;
        document.getElementById('caducidade').value = valor.caducidade;
        document.getElementById('categoria_id').value = valor.categoria_id;
    }
    function limpar(){
        document.getElementById('id').value = ""
        document.getElementById('nome').value = ""
        document.getElementById('codigo').value = ""
        document.getElementById('medicao').value = ""
        document.getElementById('qtd').value = "0"
        document.getElementById('perecivel').value = ""
        document.getElementById('caducidade').value = ""
        document.getElementById('categoria_id').value = ""
        document.getElementById('preco').value = "0"
    }
</script>
@endsection