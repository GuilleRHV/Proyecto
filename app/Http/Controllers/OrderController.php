<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index()
    {
        
        $orderList = Order::all();
        return view('order.index', ['orderList' => $orderList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("order.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

          
        ], [
            

        ]);
        Order::create($request->all());
        //return redirect("orders.index")->with("exito","cliente creado correctamente");
        return redirect()->route('orders.index')->with('exito', 'cliente creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('order.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('order.edit', ['order' => $order]);
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
        $request->validate([

            "nombre" => "required",
            "fecha" => "required",
            "descripcion" => "required",
            
        ], [
            "fecha.required" => "El dni es obvligatorio",
            "nombre.required" => "El nombre es obvligatorio",
            "descripcion.required" => "El descripcion es obvligatorio",
         

        ]);

        $order = Order::find($id);
        $order->nombre = $request->input("nombre");
        $order->fecha = $request->input("fecha");
        $order->descripcion = $request->input("descripcion");
   

        $order->save();
        return redirect()->route('orders.index')->with("exito", "Modificado exitosamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $order = Order::find($id);
        $order->delete();
        return redirect()->route('orders.index')->with("exito", "Eliminado exitosamente");
    }
}
