<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Video extends Model
{
    public $timestamps = true;
    public $fillable = ["titulo", "descricao", "url"];
}
