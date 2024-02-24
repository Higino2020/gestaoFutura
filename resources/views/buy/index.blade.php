@extends('layouts.buy')
@section('factura')
    <div class="container-xxl">
        <div class="base">
            <div class="baseMenu">
                <a href="{{route('prevenda.novaSaida')}}">Nova</a>
                <a href="">Cancelar</a>
                <a>
                    <b>{{number_format(App\Models\Caixa::where('user_id',Auth::user()->id)->where('estado','Aberto')->first()['total'], 2, ',', '.')}} Kz</b>
                </a>
                <a href="{{route('fechar')}}">Fechar</a>
            </div>  
            <div class="factuarar">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8 produtoBase" style="border-right:2px solid #b3b2b279">
                        <div class="inputs">
                           <form action="{{route('produto.pesquisa')}}" method="post">
                                @csrf
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <input type="text" autofocus placeholder="codigo de barra/nome do produto" name="valor">
                                <button type="submit"></button>
                           </form>
                        </div>
                        <div class="produtos">
                            <div class="row">
                                @foreach ($produtos as $item)
                                    @if($item->qtd > 0)
                                        <div class="col-12 col-md-4 col-lg-2 mb-4" style="cursor: pointer">
                                            <a href="{{route('prevenda.comprar',$item->id)}}" style="color: #353434c4; text-decoration: none">
                                                <div class="product">
                                                    <div class="img">
                                                        @if($item->foto == null)
                                                            <i class="fa fa-image" aria-hidden="true"></i>
                                                        @else
                                                            <img src="{{route('getfile',$item->foto)}}" alt="" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    <div class="descricao">
                                                        <h5>
                                                            <b>{{$item->nome}}</b> <br>
                                                           <b>Qtd: {{$item->qtd}}</b> <br>
                                                            preço: {{number_format($item->preco, 2, ',', '.') }} kz
                                                        </h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 showTable">
                        <div class="baseTable">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Nome do produto</td>
                                        <td>Qtd</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (App\Models\PreVenda::orderBy('id','DESC')->get() as $pre)
                                        <tr>
                                            <td><b>{{$pre->produto->nome}}</b></td>
                                            <td><b>1</b></td>
                                            <td><b>{{number_format($pre->produto->preco, 2, ',', '.')}} Kz</b> </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="operacao">
                            @if (App\Models\PreVenda::count() > 0)
                                <a href="#Finalizar" class="bg-success" data-bs-toggle="modal"  ><i class="fa fa-money-bill" aria-hidden="true"></i></a>
                                <a href="{{route('prevenda.imprimir')}}" class="bg-primary"><i class="fa fa-print" aria-hidden="true"></i></a>
                            @endif
                            <a href="" class="bg-info"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div
        class="modal fade"
        id="Finalizar"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalTitleId"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Finalizar a compra
                    </h5>
                    <button  type="button"   class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{route('saida.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                    <div class="col-12 col-md-10 col-lg-10">
                                        <small>Valor Total (kz)</small>
                                        <div class="total" id="valorTotal">
                                            {{ number_format(App\Models\PreVenda::join('produtos', 'produtos.id', '=', 'pre_vendas.produto_id')
                                            ->sum('produtos.preco'), 0, ',', '.') }} 
                                        </div>
                                        <input type="hidden" value="{{App\Models\PreVenda::join('produtos', 'produtos.id', '=', 'pre_vendas.produto_id')
                                        ->sum('produtos.preco')}}" id="total">
                                        <small>Valor apagar (Kz)</small>
                                        <input type="number" min="50" required id="campo" autofocus='true' name="valorpagar" autocomplete="00" class="total" placeholder="" value="0">
                                        <small>Troco (kz)</small>
                                        <div class="toco total" id="troco">
                                            0
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 col-md-2">
                                        <div class="basePagamento">
                                            <a id="cash">CASH</a>
                                            <a id="tpa">TPA</a>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <div class="operacao">
                                <button type="submit" class="bg-success"><i class="fa fa-check" aria-hidden="true"></i></button>
                                <a href="" class="bg-danger"><i class="fa fa-close " aria-hidden="true"></i></a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('js')
<script>
    $(function(){
        $("#campo").hover(function(){
           var total = $('#total').val()
           var entrege = $("#campo").val()
           if((entrege - total) < 0){
               $('#troco').html(0)
            }else{
                $('#troco').html(entrege - total)
            }
        })

        $('#cash').click(function(){
            $('#campo').val("0")
            $('#campo').disabled('true')
        })

        $('#tpa').click(function(){
            var valor = $('#total').val()
            $('#campo').val(valor)
        })


    })
</script>
@endpush