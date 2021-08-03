<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Video extends Model
{
    public $timestamps = true;
    protected $fillable = ["titulo", "descricao", "url"];
}
