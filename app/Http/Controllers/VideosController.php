<?php


namespace App\Http\Controllers;


use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends BaseController
{
    public function __construct()
    {
        $this->classe = Video::class;
    }
}
