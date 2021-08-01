<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


/**
 * Definindo um grupo de rotas coom o prefixo padrão API
 */
$router->group(['prefix' => '/api'], function ($router){
    $router->get('videos', "VideosController@index");
    $router->post('videos', "videosController@store");
});


$router->get('/', function () use ($router) {
    echo "Bem vindo ao AluraFlix -> API em desenvolvimento";
});


