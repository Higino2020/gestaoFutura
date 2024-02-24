<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo de Compra</title>
    <link rel="stylesheet" href="{{asset('asset/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/recibo.css')}}">
</head>
<body>
    <div class="cabe">
        <a href="{{route('prevenda.novaSaida')}}"><i class="fa fa-angle-left" aria-hidden="true"></i> Voltar</a>
    </div>
    <div class="container-xxl control">
        <div class="base">
            <div class="cabecalho">
                <h2>Comercio a Retalho</h2>
                <h3>Nome da Empresa Lda.</h3>
                <h4>Alguma coisa a dizer aqui</h4>
            </div>
            @if($valorPago == 0)
                <div class="cabecalho mt-3">
                    <h4>Factura Proforma</h4>
                </div>
            @endif
            <div class="compra">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prev as $item)
                            <tr>
                                <td><b>{{$item->produto->nome}}</b></td>
                                <td><b>1</b></td>
                                <td><b>{{number_format($item->produto->preco, 2, ',', '.')}} Kz</b></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="total">
                    <p>Total:</p>
                    <p>{{ number_format($total, 2, ',', '.')}} Kz</p>
                </div>
                @if($valorPago > 0)
                    <div class="total">
                        <p>Valor pago:</p>
                        <p>{{ number_format($valorPago, 2, ',', '.')}} Kz</p>
                    </div>
                    <div class="total">
                        <p>Troco:</p>
                        <p>{{ number_format($valorPago-$total, 2, ',', '.')}}</p>
                    </div>
                @endif
            </div>
            <div class="rodape">
                <p>nome da empresa lda</p>
                <p>comercio a retalho </p>
                <p>Benguela</p>
            </div>
        </div>
    </div>
</body>
</html>