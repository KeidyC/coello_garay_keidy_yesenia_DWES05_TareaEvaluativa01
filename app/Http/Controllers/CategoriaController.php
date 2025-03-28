<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponseHelper;

class CategoriaController extends Controller
{
    public function getAllCategorias()
    {
        try{
            $categorias = DB::table('categorias')->get();
            if($categorias->isEmpty()){
                return ApiResponseHelper::apiResponse(
                    'error', 
                    404, 
                    'No hay categorias disponibles', 
                    null
                );
            }
            return ApiResponseHelper::apiResponse(
                'success', 
                200, 
                'Lista de categorias obtenida correctamente', 
                $categorias
            );
        } catch(\Exception $e){
            return ApiResponseHelper::apiResponse(
                'error', 
                500, 
                'Error al obtener las categorias: ' . $e->getMessage(), 
                null
            );
        }
    }

    public function getCategoriaById($id)
    {
        try {
            $categoria = Categoria::find($id);
            if (!$categoria) {
                return ApiResponseHelper::apiResponse(
                    'error',
                    404,
                    'Categoria no encontrada',
                    null
                );
            }
            return ApiResponseHelper::apiResponse(
                'success',
                200,
                'Categoria encontrado correctamente',
                $categoria
            );
        } catch (\Exception $e) {
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al obtener la categoria: ' . $e->getMessage(),
                null
            );
        }
    }

    public function createCategoria(Request $request){
        try {
            $validarDatos = $request->validate([
                'nombre_categoria' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
            ]);
            
            $categoria = Categoria::create($validarDatos);
    
            return ApiResponseHelper::apiResponse(
                'success',
                201,
                'Categoria creada correctamente',
                $categoria
            );
    
        } catch (\Exception $e) {
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al crear la categoria: ' . $e->getMessage(),
                null
            );
        }
    }

    public function updateCategoria(Request $request, $id){
        try {
            $validarDatos = $request->validate([
                'nombre_categoria' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
            ]);
           
            $categoria = Categoria::findOrFail($id);
            $categoria->update($validarDatos);

            return ApiResponseHelper::apiResponse(
                'success',
                200,
                'Categoria actualizada correctamente',
                $categoria
            );
        } catch (\Exception $e) {
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al actualizar la categoria: ' . $e->getMessage(),
                null
            );
        }
    }

    public function deleteCategoria($id){
        try{
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();
           
            return ApiResponseHelper::apiResponse(
                'success',
                200,
                'Categoria eliminada correctamente',
                null
            );
        }catch (\Exception $e){
            return ApiResponseHelper::apiResponse(
                'error',
                500,
                'Error al eliminar la categoria: ' . $e->getMessage(),
                null
            );
        }
    }
}
