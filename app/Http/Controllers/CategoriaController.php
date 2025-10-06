<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;

use Illuminate\Routing\Controller;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
         public function __construct()
    {
        $this->middleware('can:categoria.create')->only(['create','store']);      
        $this->middleware('can:categoria.index')->only('index');
        $this->middleware('can:categoria.update')->only(['edit','update']); 
        $this->middleware('can:categoria.destroy')->only('destroy');

    }



    public function index()
    {
        //
        $categorias=Categoria::orderBy('id','DESC')->paginate(8);
        return view ('categoria.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar datos del formulario
        $validateData=$request->validate(
            [ 'nombre'=>'required|max:255|unique:categorias,nombre',
              'descripcion'=>'required',
              'status'=>'required|boolean'
        ],[
            'nombre.required'=>'El campo nombre es obligatorio',
            'nombre.max'=>'El nombre debe tener maximo 255 caracteres',
            'nombre.unique'=>'El nombre ya existe en la base de datos',
            'descripcion.required'=>'El campo descripcion es  es obligatorio',
            'status.required'=>'El campo status es  es obligatorio',

        ]
        );
    //crear una nueva categoria
    // $categoria=new Categoria();
    // $categoria->nombre=$validateData['nombre'];
    // $categoria->descripcion=$validateData['descripcion'];
    // $categoria->status=$validateData['status'];

    // $categoria->save();
    $categoria=Categoria::create($validateData);

    return redirect()->route('categoria.index')->with('success','Categoria agregada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $categoria=Categoria::findOrFail($id);
        return view('categoria.edit',['categoria'=>$categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, $id)
    {
        //
        $categoria=Categoria::findOrFail($id);

        $categoria->update($request->validated());

        return redirect()->route('categoria.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
         $categoria=Categoria::findOrFail($id);
        $categoria->delete();
        return redirect()->route('categoria.index');
    }
}
