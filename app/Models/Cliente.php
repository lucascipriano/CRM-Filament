<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    protected $fillable = ['name', 'birth_date', 'email', 'phone', 'description', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function trabalhos()
    {
        return $this->hasMany(Trabalhos::class);
    }


    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }
}
