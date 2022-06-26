<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function MostrarProductos()
    {
        $resProducto = Producto::get();

        return view('productos', ["resProducto"=>$resProducto]);
    }

    public function Editar(Request $data)
    {
        $data->validate(
            [
                'detalles' => 'required|string|max:255',
                'stock' => 'required',
                'precio' => 'required',
            ]
        );
        $rprecio = round($data['precio'],1);

        $producto = Producto::find($data->id);
        $producto->detalles = $data['detalles'];
        $producto->stock = $data['stock'];
        $producto->precio = $rprecio;
        $producto->Save();

        return redirect()->route('productos')->with('status', 'Producto Actualizado!');
    }

    public function Activar(Request $data)
    {
        $prod_estado = Producto::find($data->id);
        $prod_estado->estado = 'Activo';
        $prod_estado->save();

        return redirect()->route('productos')->with('status', 'Producto Activado!');
    }

    public function Desactivar(Request $data)
    {
        $prod_estado = Producto::find($data->id);
        $prod_estado->estado = 'Inactivo';
        $prod_estado->save();

        return redirect()->route('productos')->with('status', 'Producto Desactivado!');
    }
}
