<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiveSudoku extends Model
{
    protected $table = 'givesudoku';
    protected $fillable = ['idgamer', 'x', 'y', 'value'];
    
    public function gamer()
    {
        return $this->belongsTo('App\Gamer', 'idgamer', 'id');
    }
}
