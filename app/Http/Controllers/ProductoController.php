<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $categorias=Categoria::all(); 
        //cosnsulta base de producto
        $query=Producto::query();
        //filtro por  categoria 
         if($request->filled('categoria')) {
            $query->where('id_categoria',$request->categoria);
         }
         //filtro por stock
         if($request->stock=='con'){
            $query->where('stock','>',0);
         }elseif ($request->stock=='sin'){

            $query->where('stock','<=',0);
         }
         //filtro por nombre
         if ($request->filled('buscar')){
            $query->where('nombre','like','%'.$request->buscar.'%');
         }

        $productos=$query->orderBy('id','DESC')->paginate(4);
        return view('producto.index',compact('productos','categorias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias=Categoria::orderBy('id','DESC')
        ->select('categorias.id','categorias.nombre')
        ->get();
        return view('producto.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        //procesar la imagen

        if($request->hasFile('imagen')){
            $imagen=$request->file('imagen');
            $nombreImagen=time().'.'.$imagen->getClientOriginalExtension();
            $imagen->move(public_path('img'),$nombreImagen);
        }
        //asignacion masiva
        $data=$request->except('imagen');
        $data['imagen']=$nombreImagen;
       Producto::create($data);
       return redirect()->route('producto.index')->with('success','Producto agregado con exito');

    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
       $categorias=Categoria::orderBy('id','DESC')
        ->select('categorias.id','categorias.nombre')
        ->get();
        $producto=Producto::findOrFail($id);

        return view('producto.edit',compact('producto','categorias'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request,$id)
    {
         //
        $producto=Producto::findOrFail($id);
      
      //procesar imagen
    if($request->hasFile('imagen')){
      // Verificar si el producto ya tiene una imagen guardada
      if ($producto->imagen && file_exists(public_path('img/' . $producto->imagen))) {
        // Eliminar la imagen vieja
        unlink(public_path('img/' . $producto->imagen));
       }
    $imagen=$request->file('imagen');
    $nombreImagen=time().'.'.$imagen->getClientOriginalExtension();
    $imagen->move(public_path('img'),$nombreImagen);
     }  else{
      $nombreImagen=$producto->imagen;
     }
    //preparar los datos para asignacion masiva
   $data = $request->except('imagen');
   //actuliza el nombre de la imagen
    $data['imagen'] = $nombreImagen;

  //actuallizacion masiva

   $producto->update($data);

  return redirect()->route('producto.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
