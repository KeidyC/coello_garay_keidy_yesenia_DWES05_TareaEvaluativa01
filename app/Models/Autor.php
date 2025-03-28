<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';
    protected $primaryKey = 'id_autor';
    public $timestamps = false;
    protected $fillable = ['nombre_autor', 'nacionalidad','fecha_nacimiento'];

    public function libros()
    {
        return $this->hasMany(Libro::class, 'id_autor', 'id_autor');
    }
}
