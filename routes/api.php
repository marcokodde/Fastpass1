<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/support/server/server_data/all',function(){
    echo '<table>';
    echo '<thead border="1"><th>CLAVE</th><th>VALOR</th></tehead>';
    foreach($_SERVER as $server => $valor){
        echo '<tr><td> ' . $server . '</td><td>' . $valor . '</td></tr>';
    }
    echo '</table>';
});

Route::get('/server_data',function(){
    echo '<table>';
    echo '<thead border="1"><th>CLAVE</th><th>VALOR</th></tehead>';
    foreach($_SERVER as $server => $valor){
        if (is_array($valor)){
            echo '<tr><td> ' . $server . '</td><td>';
            foreach($valor as $x_valor => $valor_x){
                echo '<tr><td>' . $x_valor .'</td><td>' . $valor_x . '</td></tr>';
            }
            echo '</td>';
        }else{
            echo '<tr><td> ' . $server . '</td><td>' .$valor . '</td></tr>';
        }
    }
    echo '</table>';
});
