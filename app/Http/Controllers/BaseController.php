<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class BaseController
 * @package App\Http\Controllers
 *
 * Esta classe representa um controle abstrato que pode ser herdado por outros controllers
 * para que possuam o comportamento das principais requisições rest
 */


abstract class BaseController extends Controller
{

    protected $classe;

    public function index()
    {
        return $this->classe::all();
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
                $this->classe::create($this->validate($request, [
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
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json([
                'erro' => 'Este vídeo não existe em nossa bases de dados'],
                404);
        }
        return response()->json($recurso, 200);
    }

    public function update(int $id, Request $request)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json([
                'erro' => 'este vídeo não existe em nossa base de dados'],
                404
            );
        }
        //validando dados para atualização
        try {
            $recurso->fill($this->validate($request, [
                'titulo' => 'required',
                'descricao' => 'required',
                'url' => 'required|url'
            ]));
            $recurso->save();
            return response()->json($recurso, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'mensagem' => 'Dados inválidos para cadastro',
                'error' => $exception->getMessage()],
                400);
        }
    }

    public function destroy(int $id)
    {
        if ($this->classe::destroy($id) === 0) {
            return response()->json([
                'Vídeo não encontrado em nossa base de dados'],
                404);
        }
        return response()->json('',204);
    }
}
