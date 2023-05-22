<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Client;
use Illuminate\Http\Request;
/**
 * @OA\Info(
 *     title="Laravel + Vue ",
 *     version="0.2",
 * ),
 *  @OA\Server(
 *      url="http://localhost:8000"
 *  ),
 */

class ClientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/client/getAllClients",
     *     tags={"Client"},
     *     summary="Obtener todos los clientes",
     *     @OA\Response(
     *         response=200,
     *         description="Listado de clientes",
     *     )
     * )
     */
    public function getAllClients(){
        return Client::all();
    }


    /**
     * @OA\Get(
     *     path="/client/getOneClient/{id}",
     *     summary="Obtener un cliente por ID",
     *     tags={"Client"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del cliente",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Informción de un cliente",
    *     )
    * )
    */
    public function getOneClient($id){
        try {
            return Client::findOrFail($id);
        } catch (\Throwable $th) {

            return response()->json([
                'error' => 'Cliente no encontrado',
            ], 404);
        }


    }

    /**
     * @OA\Post(
     *     path="/client/newClient",
     *     tags={"Client"},
     *     summary="Crear un nuevo cliente",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="cognoms", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="telefon", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente creado exitosamente",
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
     *         description="Error al crear el cliente",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function newClient(NewClienteRequest $request){
        try {
            return Client::create(
                $request->only('nom','cognoms','email','telefon')
            );
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'No es posible',
            ], 500);
        }
    }





    /**
     * @OA\Put(
     *     path="/client/updateClient",
     *     tags={"Client"},
     *     summary="Actualizar un cliente",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="cognoms", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="telefon", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente actualizado exitosamente",
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
     *         description="Error al actualizar el cliente",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function updateClient(UpdateClienteRequest $request){
        try {
            Client::findOrFail($request->input('id'))->update(
                $request->only('nom','cognoms','email','telefon')
            );

            return response()->json([
                'message' => 'Cliente actualizado correctamente'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'No es posible',
            ], 500);
        }
    }

}
