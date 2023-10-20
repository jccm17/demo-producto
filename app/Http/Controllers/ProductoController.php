<?php

namespace App\Http\Controllers;

use App\Models\producto;
use App\Models\Response\ResponseData;
use Illuminate\Http\Request;

/**
 * @OA\PathItem(path="/api")
 */
class ProductoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     tags={"product"},
     *     path="/api/product",
     *     summary="Listar productos",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/Product")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid Request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     * )
     */
    public function index()
    {
        $products = producto::all();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *     tags={"product"},
     *     path="/api/product",
     *     summary="Nuevo Producto",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Product")
     *             )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/ResponseData")
     *             )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid Request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $response = new ResponseData();
        $data = $request->all();
        $product = Producto::create($data);
        if ($product) {
            $response->message = "OK";
            $response->status = true;
            $response->entity = $product;
        } else {
            $response->message = "NOK";
            $response->status = false;
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     tags={"product"},
     *     path="/api/product/{id}",
     *     summary="Obtener producto",
     *     @OA\Parameter(
     *         description="Parameter",
     *         in="path",
     *         name="id",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/ResponseData")
     *             )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     * )
     */
    public function edit($id)
    {
        $response = new ResponseData();
        $product = Producto::find($id);
        if ($product) {
            $response->message = "OK";
            $response->status = true;
            $response->entity = $product;
        } else {
            $response->message = "NOK";
            $response->status = false;
        }
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *     tags={"product"},
     *     path="/api/product/{id}",
     *     summary="Actualizar producto",
     *     @OA\Parameter(
     *         description="Parameter",
     *         in="path",
     *         name="id",
     *         required=true
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Product")
     *             )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(ref="#/components/schemas/ResponseData"),
     *             },
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     * )
     */
    public function update(Request $request, $id)
    {
        $response = new ResponseData();
        $data = $request->all();
        $product = Producto::find($id);
        if (!$product) {
            $response->message = "Product not found";
            $response->status = false;
        } else {
            $product->name = $data["name"];
            $product->description = $data["description"];
            $product->code = $data["code"];
            $product->price = $data["price"];
            $product->update($data);
            if ($product) {
                $response->message = "OK";
                $response->status = true;
                $response->entity = $product;
            } else {
                $response->message = "Failed to update product";
                $response->status = false;
            }
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *     tags={"product"},
     *     path="/api/product/{id}",
     *     summary="Eliminar producto",
     * @OA\Parameter(
     *         description="Parameter",
     *         in="path",
     *         name="id",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(ref="#/components/schemas/ResponseData"),
     *             },
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     * )
     */
    public function destroy($id)
    {
        $response = new ResponseData();
        $product = Producto::find($id);
        if ($product) {
            $product->delete();
            $response->message = "OK";
            $response->status = true;
        } else {
            $response->message = "Product not found";
            $response->status = false;
        }
        return response()->json($response);
    }
}
