<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabalhos extends Model
{
    protected $guarded =['id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}
