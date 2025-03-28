<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'libros';
    protected $primaryKey = 'id_libro';
    public $timestamps = false;
    protected $fillable = ['titulo', 'precio', 'stock', 'id_categoria', 'id_autor'];

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'id_autor', 'id_autor');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
}


