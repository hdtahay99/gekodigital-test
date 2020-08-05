<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sudoku extends Model
{
    protected $fillable = ['idgamer', 'x', 'y', 'value'];
    
    public function gamer()
    {
        return $this->belongsTo('App\Gamer', 'idgamer', 'id');
    }
}
