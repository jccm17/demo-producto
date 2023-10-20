<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function __construct(){
        //$this->middleware('auth', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = producto::all();
        return $products;
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
    public function store(Request $request)
    {
        $response = array();
        $data = $request->all();
        $product = Producto::create($data);
        if ($product) {
            $response = array("Producto" => $product, "Message" => "OK");
        } else {
            $response = array("Message" => "NOK");
        }
        return $response;
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
    public function edit($id)
    {
        $response = array();
        $product = Producto::find($id);
        if ($product) {
            $response = array("Producto" => $product, "Message" => "OK");
        } else {
            $response = array("Message" => "NOK");
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = array();
        $data = $request->all();
        $product = Producto::find($id);
        if (!$product) {
            $response = array("Message" => "Product not found");
        } else {
            $product->name = $data["name"];
            $product->description = $data["description"];
            $product->code = $data["code"];
            $product->price = $data["price"];
            $product->update($data);
            if ($product) {
                $response = array("product" => $product, "message" => "product updated successfully");
            }
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = array();
        $product = Producto::find($id);
        if( $product ) {
            $product->delete();
            $response = array("Message" => "Product deleted successfully");
        }else{
            $response = array("Message" => "Product not found");
        }
        return $response;
    }
}
