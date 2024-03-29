<?php

namespace restaurant\Http\Controllers;

use Illuminate\Http\Request;
use restaurant\models\carta;
use restaurant\models\producto;
use restaurant\models\carta_item;
class CartaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = carta::all();
        $cartaActiva = carta::where('estado', 1)->first();
        $data2 = carta_item::with('productos')->where('carta_id', $cartaActiva->id)->get();
        $headers = carta::getHeaders();
        $productos = producto::all();
        return view('sistema.carta.index',['data' => $data,'data2' => $data2,'title' => 'CARTA','action' => '/carta','headers' => $headers, 'productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headers = carta::getPull();//campos
        return view('sistema.carta.crear',['title' => 'NUEVA CARTA','action' => '/carta','headers' => $headers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        carta::create($request->all());
        return redirect('/sistema/carta')/*->with('mensaje', 'Creado con exito')*/;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$mesa = mesa::find($id);
        //$headers = mesa::getPull();
        //return view('sistema.mesa.editar',['title' => 'MESA - EDITAR','action' => '/carta'.$id,'data' => $mesa,'headers' => $headers]);
        carta::where('estado', 1)->update(['estado' => 0]);
        carta::where('id', $id)->update(['estado' => 1]);

        return redirect('/sistema/carta');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function buscarProducto(Request $request)
    {
        return producto::where('nombre', 'like', '%' . $request->valor . '%')->orWhere('codigo', 'like', '%' . $request->valor . '%')->get();
        //return $request->valor;
    }
}
