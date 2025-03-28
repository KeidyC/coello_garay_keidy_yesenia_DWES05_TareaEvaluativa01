<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponseHelper;

class AutorController extends Controller
{
    public function getAllAutores()
    {
        try{
            $autores = DB::table('autores')->get();
            if($autores->isEmpty()){
                return ApiResponseHelper::apiResponse(
                    'error', 
                    404, 
                    'No hay autores disponibles', 
                    null
                );
            }
            return ApiResponseHelper::apiResponse(
                'success', 
                200, 
                'Lista de autores obtenida correctamente', 
                $autores
            );
        } catch(\Exception $e){
            return ApiResponseHelper::apiResponse(
                'error', 
                500, 
                'Error al obtener los autores: ' . $e->getMessage(), 
                null
            );
        }
    }

    public function getAutorById($id)
    {
        try {
            $autor = Autor::find($id);
            if (!$autor) {
                return ApiResponseHelper::apiResponse(
                    'error',
                    404,
                    'Autor no encontrado',
                    null
                );
            }
            return ApiResponseHelper::apiResponse(
                'success',
                200,
                'Autor encontrado correctamente',
                $autor
            );
        } catch (\Exception $e) {
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al obtener el autor: ' . $e->getMessage(),
                null
            );
        }
    }

    // Crear un autor
    public function createAutor(Request $request){
        try {
            $validarDatos = $request->validate([
                'nombre_autor' => 'required|string|max:255',
                'nacionalidad' => 'nullable|string|max:255',
                'fecha_nacimiento' => 'nullable|date',
            ]);

            $autor = Autor::create([
                'nombre_autor' => $validarDatos['nombre_autor'],
                'nacionalidad' => $validarDatos['nacionalidad'],
                'fecha_nacimiento' => $validarDatos['fecha_nacimiento'],               
            ]);
    
            return ApiResponseHelper::apiResponse(
                'success',
                201,
                'Autor creado correctamente',
                $autor
            );
    
        } catch (\Exception $e) {
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al crear el autor: ' . $e->getMessage(),
                null
            );
        }
    }
    public function updateAutor(Request $request, $id){
        try {
            $validarDatos = $request->validate([
                'nombre_autor' => 'required|string|max:255',
                'nacionalidad' => 'nullable|string|max:255',
                'fecha_nacimiento' => 'required|date',
            ]);
          
            $autor = Autor::find($id);
            if (!$autor) {
                return ApiResponseHelper::apiResponse(
                    'error',
                    404,
                    'Autor no encontrado',
                    null
                );
            }
            $autor->update($validarDatos);
    
            return ApiResponseHelper::apiResponse(
                'success',
                200,
                'Autor actualizado correctamente',
                $autor
            );
        } catch (\Exception $e) {
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al actualizar el autor: ' . $e->getMessage(),
                null
            );
        }
    }

    public function deleteAutor($id){
        try{
            $autor = Autor::find($id);
            if(!$autor){
                return ApiResponseHelper::apiResponse(
                    'error',
                    404,
                    'Autor no encontrado',
                    null
                );
            }

            $autor->delete();
            return ApiResponseHelper::apiResponse(
                'success',
                200,
                'Autor eliminado correctamente',
                null
            );
        }catch (\Exception $e){
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al eliminar el autor: ' . $e->getMessage(),
                null
            );
        }
    }
}
