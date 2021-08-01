<?php


namespace App\Http\Controllers;


use App\Models\Video;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Finally_;

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
        }catch (\Exception $exception)
        {
            echo "O erro Detectado na aplicação foi: ".$exception->getMessage();
        }
    }

    /**
     *
     * Retorna o recurso Video solicitado com o parâmetro id,
     * caso não exista tal recurso na base, retorna uma resposta 204 noContent
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $video = Video::find($id);
        if(is_null($video)) return response()->json(['Mensagem' => "Este vídeo não existe em nossa base de dados"], 204);
        return response()->json($video, 200);
    }

    public function update(int $id, Request $request)
    {
        $video = Video::find($id);
    }


}
