<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gamer extends Model
{
    protected $fillable = ['nickname'];

    public function sudokus(){
        return $this->hasMany('App\Sudoku', 'idgamer', 'id');
    }

    public function entradas(){
        return $this->hasMany('App\GiveSudoku', 'idgamer', 'id');
    }

}
