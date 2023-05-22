<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewProducteRequest;
use App\Http\Requests\UpdateProducteRequest;
use App\Models\PcSobremesa;
use App\Models\Portatil;
use App\Models\Producte;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ProducteController extends Controller
{
    use ValidatesRequests;


         /**
     * @OA\Post(
     *     path="/product/newProduct",
     *     tags={"Producte"},
     *     summary="Crear un nuevo producto",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="codigo_producto", type="string"),
     *             @OA\Property(property="activo", type="boolean"),
     *             @OA\Property(property="tipo_producto", type="string", enum={"pc_sobremesa", "portatil"}),
     *             @OA\Property(property="gaming", type="boolean", nullable=true),
     *             @OA\Property(property="potencia_fuente", type="integer", nullable=true),
     *             @OA\Property(property="capacidad_bateria", type="integer", nullable=true),
     *             @OA\Property(property="amperaje_cargador", type="integer", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto creado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="codigo_producto", type="string"),
     *             @OA\Property(property="activo", type="boolean"),
     *             @OA\Property(property="fecha_entrada", type="string", format="date"),
     *             @OA\Property(property="tipo_producto", type="string", enum={"pc_sobremesa", "portatil"}),
     *             @OA\Property(property="gaming", type="boolean", nullable=true),
     *             @OA\Property(property="potencia_fuente", type="integer", nullable=true),
     *             @OA\Property(property="capacidad_bateria", type="integer", nullable=true),
     *             @OA\Property(property="amperaje_cargador", type="integer", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al crear el cliente",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function newProduct(NewProducteRequest $request){

        $producto = new Producte;

        $producto->descripcion = $request->input('descripcion');
        $producto->codigo_producto = $request->input('codigo_producto');
        $producto->activo = $request->input('activo');
        $producto->fecha_entrada = str(Carbon::now());
        $producto->save();
        // Crear información específica de los tipos de productos
        if ($request->input('tipo_producto') === 'pc_sobremesa') {
            $pcSobremesa = new PcSobremesa;
            $pcSobremesa->producte_id = $producto->id;
            $pcSobremesa->gaming = $request->input('gaming');
            $pcSobremesa->potencia_fuente = $request->input('potencia_fuente');
            $producto->pcSobremesa()->save($pcSobremesa);
        }

        if ($request->input('tipo_producto') === 'portatil') {
            $portatil = new Portatil;
            $portatil->producte_id = $producto->id;
            $portatil->capacidad_bateria = $request->input('capacidad_bateria');
            $portatil->amperaje_cargador = $request->input('amperaje_cargador');
            $producto->portatil()->save($portatil);
        }

        return $producto;
    }


    /**
     * @OA\Get(
     *     path="/product/getAllProducts",
     *     tags={"Producte"},
     *     summary="Obtener todos los productos",
     *     @OA\Response(
     *         response=200,
     *         description="Listado de productos",
     *     )
     * )
     */
    public function getAllProducts(){
        return Producte::with('pcSobremesa', 'portatil')->get();
    }

    /**
     * @OA\Get(
     *     path="/product/getOneProduct/{id}",
     *     summary="Obtener un producto por ID",
     *     tags={"Producte"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del producto",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Informción de un producto",
    *     )
    * )
    */
    public function getOneProduct($id=0){
        $producto = Producte::with('pcSobremesa', 'portatil')->find($id);
        if($producto){
            return $producto;
        }else{
            return response()->json([
                'error' => 'Producto no encontrado',
            ], 404);
        }
    }



    /**
     * @OA\Put(
     *     path="/product/updateProduct",
     *     tags={"Producte"},
     *     summary="Actualizar un producto",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="codigo_producto", type="string"),
     *             @OA\Property(property="activo", type="boolean"),
     *             @OA\Property(property="fecha_entrada", type="string", format="date"),
     *             @OA\Property(property="tipo_producto", type="string", enum={"pc_sobremesa", "portatil"}),
     *             @OA\Property(property="gaming", type="boolean", nullable=true),
     *             @OA\Property(property="potencia_fuente", type="integer", nullable=true),
     *             @OA\Property(property="capacidad_bateria", type="integer", nullable=true),
     *             @OA\Property(property="amperaje_cargador", type="integer", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto actualizado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="cognoms", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="telefon", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar el producto",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function updateProduct(UpdateProducteRequest $request){

        $producto = Producte::findOrFail($request->input('id'));

        if($producto->codigo_producto != $request->input('codigo_producto') && Producte::whereNot('id', $request->input('id'))->where('codigo_producto',$request->input('codigo_producto')->exists())  ){
            $producto->codigo_producto = $request->input('codigo_producto');
        }

        $producto->descripcion = $request->input('descripcion');
        $producto->codigo_producto = $request->input('codigo_producto');
        $producto->activo = $request->input('activo');


        // Actualizar información específica de los tipos de productos
        if ($producto->pcSobremesa) {
            $producto->pcSobremesa->gaming = $request->input('gaming');
            $producto->pcSobremesa->potencia_fuente = $request->input('potencia_fuente');
            $producto->pcSobremesa->save();
        }

        if ($producto->portatil) {
            $producto->portatil->capacidad_bateria = $request->input('capacidad_bateria');
            $producto->portatil->amperaje_cargador = $request->input('amperaje_cargador');
            $producto->portatil->save();
        }

        $producto->save();

        return response()->json([
            'message' => 'Producto actualizado correctamente'
        ]);
    }



}
