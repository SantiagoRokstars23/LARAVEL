@extends('layouts.plantilla')

@section('titulomain')
<a href="{{ route('categoria.index') }}">categorias</a>
<span>/agregar</span>


@endsection

@section('contenido')

  {{-- mostrar formulario para crear nueva categoria --}}
  <div class= "container-formulario">
    <div class="card formulario">
        <h2>Crear Nueva Categoría</h2>
        <form action="{{route('categoria.store')}}" method="POST">
            {{-- agregar directica para qu se genere un token --}}
            @csrf
            <!-- Campo Nombre -->
            <div class="form-group">
                <label for="nombre">Nombre de la Categoría</label>
                <input type="text" id="nombre" name="nombre" required  class="form-control @error('nombre') is-invalid @enderror"
        value="{{ old('nombre') }}">
            </div>
            <!-- Campo Descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"></textarea>
            </div>
            <!-- Campo Status -->
            <div class="form-group">
                <label for="status">Estado</label>
                <select id="status" name="status" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <!-- Botón Guardar -->
            <div class="form-group">
                <button type="submit">Guardar Categoría</button>
            </div>
        </form>
        {{-- agrega div para ver la validadion --}}
       @if ($errors->any())
        <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
    </div>
    
    </div>

@endsection