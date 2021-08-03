<?php

namespace App\Http\Requests;


use Illuminate\Http\Request;

class VideosFormRequest extends Request

{
    public function rules()
    {
        return [
            'titulo' => 'required| max:40',
            'descricao' => 'required|max: 240',
            'url' => 'required|url'
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Um título é obrigatório',
            'descricao.required' => 'Adicione uma descrição ao seu vídeo',
            'url.url' => 'Url',
        ];
    }
    public function authorize()
    {
        return true;
    }
}
