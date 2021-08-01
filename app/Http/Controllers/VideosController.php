<?php


namespace App\Http\Controllers;


use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
        return Video::all();
    }

    /**
     *
     * Tratando-se de uma API, devemos retornar o conteúdo adicionado e
     * um código de status que representa o que foi realizado de fato no servidor
     * no caso o código 201 é o status para created
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            return response()->json(
                Video::create([
                    'titulo' => $request->titulo,
                    'descricao' => $request->descricao,
                    'url'=> $request->url]),
                201
            );
        }Catch(\Exception $exception){
            echo "O erro Detectado na aplicação foi: ".$exception->getMessage();
        }

    }
}
