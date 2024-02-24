<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\{
        UserController,
        ProdutoController,
        EntradaController,
        SaidaController,
        PreVendaController,
        FornecedorController,
        CategoriaController
    };
use App\Models\Caixa;
use App\Models\PreVenda;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Plank\Mediable\Media;
use Intervention\Image\Facades\Image;
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    Route::group(['middleware'=>'auth'],function(){

        Route::get('getfile/{name}',function($name){
            $path = '';
            $media = Media::whereBasename($name)->first();
    
            if ($media != null) {
                $path = $media->getDiskPath();
            } else {
                $path = 'default.png';
            }
            $img = Image::make($media->getAbsolutePath());
            $w = 300;
            $h = 300;
    
            if (request()->w != null) {
                $w = request()->w;
            }
            if (request()->h != null) {
                $h = request()->h;
            }
            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $img->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->stream();
            //Log::debug(storage_path() . '/app/' . $path);
            return (new Response($img->__toString(), 200))
                ->header('Content-Type', '*');
        })->name('getfile');

        Route::get('/', function () {
            return view('admin.inicio');
        })->name('inicio');
        Route::resource('user', UserController::class);
        Route::resource('produto', ProdutoController::class);
        Route::resource('entradas', EntradaController::class);
        Route::resource('prevenda', PreVendaController::class);
        Route::resource('fornecedor', FornecedorController::class);
        Route::resource('categoria', CategoriaController::class);
        //Routas Simplificas para cada efeito unico
        Route::get('apagar/{id}',[ProdutoController::class,'apagar'])->name('produto.apagar');
        Route::get('sair',function(){
            Auth::logout();
            return view('auth.login');
        })->name('sair');
    });

    Route::group(['middleware'=>'auth','prefix'=> 'buy'],function(){
        Route::get('/',function(){
            $produtos = Produto::all();
            $caixa = new Caixa();
            $caixa->user_id = Auth::user()->id;
            $caixa->total = 0;
            $caixa->estado = "Aberto";
            $caixa->save();
            return view('buy.index',compact('produtos'));
        })->name('buy');
    
        Route::post('pesquisa',function(Request $request){
            $produtos =null;
            if(!isset($request->valor)){
                $produtos = Produto::all();
            }else{
                $produtos = Produto::where('codigo',$request->valor)->orWhere('nome',$request->valor)->get();
                if($produtos->count() == 1){
                    foreach($produtos as $prod){
                        $prev = new PreVenda();
                        $prev->produto_id = $prod->id;
                        $prev->qtd = 1;
                        $prev->total = 1;
                        $prev->save();
                    }
                }
            }
            return view('buy.index',compact('produtos'));
        })->name('produto.pesquisa');
        Route::resource('saida', SaidaController::class);
        Route::get('prevenda/compra/{id}',[PreVendaController::class,'comprar'])->name('prevenda.comprar');
        Route::get('imprimir',[PreVendaController::class,'imprimir'])->name('prevenda.imprimir');
        Route::get('novavenda',[PreVendaController::class,'novaSaida'])->name('prevenda.novaSaida');
        Route::get('logout',[PreVendaController::class,'fechar'])->name('fechar');
    });
    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('recibo',function(){
        return view('buy.saida.recibo');
    });
