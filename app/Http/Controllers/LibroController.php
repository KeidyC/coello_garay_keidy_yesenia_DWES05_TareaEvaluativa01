<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponseHelper;

class LibroController extends Controller
{
    public function getAllLibros()
    {
        try{
            $libros = DB::table('libros')->get();
            // $libros = Libro::with(['autor', 'categoria'])->get();
            if($libros->isEmpty()){
                return ApiResponseHelper::apiResponse(
                    'error', 
                    404, 
                    'No hay libros disponibles', 
                    null
                );
            }
            return ApiResponseHelper::apiResponse(
                'success', 
                200, 
                'Lista de libros obtenida correctamente', 
                $libros
            );
        } catch(\Exception $e){
            return ApiResponseHelper::apiResponse(
                'error', 
                500, 
                'Error al obtener los libros: ' . $e->getMessage(), 
                null
            );
        }
    }
    
    public function getLibroById($id)
    {
        try {
            $libro = Libro::find($id);
            //$libro = Libro::with(['autor', 'categoria'])->findOrFail($id);
            if (!$libro) {
                return ApiResponseHelper::apiResponse(
                    'error',
                    404,
                    'Libro no encontrado',
                    null
                );
            }
            return ApiResponseHelper::apiResponse(
                'success',
                200,
                'Libro encontrado correctamente',
                $libro
            );
        } catch (\Exception $e) {
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al obtener el libro: ' . $e->getMessage(),
                null
            );
        }
    }

    public function createLibro(Request $request){
        try {
            $validarDatos = $request->validate([
                'titulo' => 'required|string|max:255',
                'precio' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'id_categoria' => 'required|exists:categorias,id_categoria',
                'id_autor' => 'required|exists:autores,id_autor',
            ]);

            $libro = Libro::create($validarDatos);
    
            return ApiResponseHelper::apiResponse(
                'success',
                201,
                'Libro creado correctamente',
                $libro
            );
    
        } catch (\Exception $e) {
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al crear el libro: ' . $e->getMessage(),
                null
            );
        }
    }

    public function updateLibro(Request $request, $id){
        try {
            $validarDatos = $request->validate([
                'titulo' => 'nullable|string|max:255',
                'precio' => 'nullable|numeric|min:0',
                'stock' => 'nullable|integer|min:0',
                'id_categoria' => 'nullable|exists:categorias,id_categoria',
                'id_autor' => 'nullable|exists:autores,id_autor',
            ]);

            $libro = Libro::findOrFail($id);
            $libro->update($validarDatos);

            return ApiResponseHelper::apiResponse(
                'success',
                200,
                'Libro actualizado correctamente',
                $libro
            );
        } catch (\Exception $e) {
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al actualizar el libro: ' . $e->getMessage(),
                null
            );
        }
    }

    public function deleteLibro($id){
        try{
            $libro = Libro::findOrFail($id);
            $libro->delete();
           
            return ApiResponseHelper::apiResponse(
                'success',
                200,
                'Libro eliminado correctamente',
                null
            );
        }catch (\Exception $e){
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al eliminar el libro: ' . $e->getMessage(),
                null
            );
        }
    }
}
