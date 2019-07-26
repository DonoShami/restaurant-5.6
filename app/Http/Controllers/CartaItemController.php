<?php

namespace restaurant\Http\Controllers;

use Illuminate\Http\Request;
use restaurant\models\carta_item;
use restaurant\models\carta;
use restaurant\models\producto;

class CartaItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartaActiva = carta::where('estado', 1)->first();
        return carta_item::with('productos')->where('carta_id', $cartaActiva->id)->get();
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
        //$productos = producto::all();
        carta_item::create($request->all());
        //return $request->input('carta_id') ." - ".$request->input('producto_id') ." - " .$request->input('stock');
        return "save";
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
        //
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
         	
        //carta_item::destroy($id);	
        $item = carta_item::find($id);
        if($item != null){
            $item->delete();
            return "Eliminado ->".$item;
        }
        else {
            return "Ocurrio un problema-> ".$item;   
        }
        
        
    }
}
