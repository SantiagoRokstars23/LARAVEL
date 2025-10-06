<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
     public function welcome(){        

                 
        $productos = Producto::select('nombre','imagen', 'descripcion', 
        'precio_venta', 'stock','id_categoria') 
                     ->orderBy('id', 'ASC')
                     ->paginate(10);
       
        return view('welcome',compact('productos'));
    }
}
