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
     * Dados validados
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        try {
            return response()->json(
                Video::create($this->validate($request, [
                    'titulo' => 'required',
                    'descricao' => 'required',
                    'url' => 'required|url'
                ])),
                201
            );
        } catch (\Exception $exception) {
            return response()->json([
                'mensagem' => 'Dados inválidos para cadastro',
                'error' => $exception->getMessage()],
                400);
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
        if (is_null($video)) {
            return response()->json([
                'erro' => 'Este vídeo não existe em nossa base de dados'],
                404);
        }
        return response()->json($video, 200);
    }

    public function update(int $id, Request $request)
    {
        $video = Video::find($id);
        if (is_null($video)) {
            return response()->json([
                'erro' => 'este vídeo não existe em nossa base de dados'],
                404
            );
        }
        $video->fill($request->all());
        $video->save();
        return response()->json($video, 200);

    }


}
