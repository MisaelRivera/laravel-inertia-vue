<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Client;
use Inertia\Inertia;

class OrdersController extends Controller
{
    //

    public function create () {
        $data = ['lastOrder' => Order::getOrderWithLastFolio()];
        $data['aguas'] = $data['lastOrder']->aguas_alimentos === 'Aguas'; 
        return Inertia::render('orders/CreateOrder', $data);
    }

    public function toggleCesavedac (Request $request) {
       try {
           $request->validate([
               'order_id' => 'exists:ordenes,id'
           ]);
           $order = Order::find($request->input('order_id'));
           $order->reporte_cesavedac_entregado = !$request->input('value');
           $order->save();
           return response()->json(!$request->input('value'));
        } catch (\Exception $e) {
            Log::error('Error in toggleCesavedac: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function toggleSupervision (Request $request) {
        try {
            $request->validate([
                'order_id' => 'exists:ordenes,id'
            ]);
            $order = Order::find($request->input('order_id'));
            $order->supervision = !$request->input('value');
            $order->save();
            return response()->json(!$request->input('value'));
         } catch (\Exception $e) {
             Log::error('Error in toggleSupervision: ' . $e->getMessage());
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
     }

     public function toggleHojaCampo (Request $request) {
        try {
            $request->validate([
                'order_id' => 'exists:ordenes,id'
            ]);
            $order = Order::find($request->input('order_id'));
            $siralab = $order->siralab;
            $siralab->hoja_campo = !$request->input('value');
            $siralab->save();
            return response()->json(!$request->input('value'));
         } catch (\Exception $e) {
             Log::error('Error in toggleHojaCampo: ' . $e->getMessage());
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
     }

    public function toggleCadenaCustodia (Request $request) {
        try {
            $request->validate([
                'order_id' => 'exists:ordenes,id'
            ]);
            $order = Order::find($request->input('order_id'));
            $siralab = $order->siralab;
            $siralab->cadena_custodia = !$request->input('value');
            $siralab->save();
            return response()->json(!$request->input('value'));
         } catch (\Exception $e) {
             Log::error('Error in toggleCadenaCustodia: ' . $e->getMessage());
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
    }

    public function toggleCroquis (Request $request) {
        try {
            $request->validate([
                'order_id' => 'exists:ordenes,id'
            ]);
            $order = Order::find($request->input('order_id'));
            $siralab = $order->siralab;
            $siralab->croquis = !$request->input('value');
            $siralab->save();
            return response()->json(!$request->input('value'));
         } catch (\Exception $e) {
             Log::error('Error in toggleCroquis: ' . $e->getMessage());
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
    }

    public function toggleReporteEntregado (Request $request) {
        try {
            $request->validate([
                'order_id' => 'exists:ordenes,id'
            ]);
            $order = Order::find($request->input('order_id'));
            $order->reporte_entregado = !$request->input('value');
            $order->save();
            return response()->json(!$request->input('value'));
         } catch (\Exception $e) {
             Log::error('Error in toggleReporteEntregado: ' . $e->getMessage());
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
    }

    public function filter (Request $request) 
    {
        $clientes = Client::where('cliente', 'like', "%" . $request->input('client') . "%")->get()->toArray();
        $ordenes = Order::whereIn('id_cliente', array_column($clientes, 'id'))
            ->with(['muestras.identificacionMuestraRelacion', 'cliente', 'siralab'])
            ->orderBy('fecha_recepcion', 'desc')
            ->orderBy('hora_recepcion', 'desc')
            ->orderBy('cesavedac', 'asc')
            ->orderBy('folio', 'desc')
            ->paginate(40);
        return response()->json($ordenes);
    }

}
