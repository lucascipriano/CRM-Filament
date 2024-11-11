<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    protected $guarded = [
        'id'
    ];

    public function filiado()
    {
        return $this->belongsTo(Filiado::class);
    }
}
