<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Factura</title>
    <link rel="stylesheet" href="{{asset('asset/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('asset/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <div class="geral">

        <div class="container-xxl">
            <div class="base">
                <div class="form">
                    <div class="titulo">
                        <h4>POS - Entrar</h4>
                    </div>
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="form-group">   
                            <label for="">Nome ou codigo de acesso</label>
                            <div class="">
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">   
                            <label for="">Senha</label>
                            <div class="">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success form-control">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>