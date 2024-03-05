<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'autor_id',
        'resena_id',
        'categoria_id',
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }

    public function resena()
    {
        return $this->belongsTo(Resena::class, 'resena_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

}
