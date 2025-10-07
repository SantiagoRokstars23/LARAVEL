@extends('layouts.plantilla')

@section('contenido')
<div class="container-formulario">
  <div class="card formulario">
    <h2>Editar Cita</h2>

    <form action="{{ route('cita.update', $cita->id) }}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PATCH')

      <!-- Campo Mascota -->
      <div class="form-group">
        <label for="nombre_mascota">Nombre de la Mascota</label>
        <input type="text" id="nombre_mascota" name="nombre_mascota" required value="{{ $cita->nombre_mascota }}">
      </div>

      <!-- Campo Dueño -->
      <div class="form-group">
        <label for="nombre_duenio">Nombre del Dueño</label>
        <input type="text" id="nombre_duenio" name="nombre_duenio" required value="{{ $cita->nombre_duenio }}">
      </div>

      <!-- Campo Fecha -->
      <div class="form-group">
        <label for="fecha">Fecha de la Cita</label>
        <input type="date" id="fecha" name="fecha" required value="{{ $cita->fecha }}">
      </div>

      <!-- Campo Hora -->
      <div class="form-group">
        <label for="hora">Hora de la Cita</label>
        <input type="time" id="hora" name="hora" required value="{{ $cita->hora }}">
      </div>

      <!-- Campo Motivo -->
      <div class="form-group">
        <label for="motivo">Motivo de la Cita</label>
        <textarea id="motivo" name="motivo" rows="4">{{ $cita->motivo }}</textarea>
      </div>

            <!-- Campo Veterinario -->
      <div class="form-group">
        <label for="veterinario">Veterinario Asignado</label>
        <select name="veterinario" id="veterinario" required>
          <option value="{{ $cita->veterinario }}" selected>
            {{ $cita->veterinario ?? 'Sin asignar' }}
          </option>
      
            <option value="Santiago grueso">Santiago grueso</option>
            <option value="Andres carvajal">Andres carvajal</option>
            <option value="Jhon carvajal">Jhon carvajal</option>
            <option value="Luis jimenez">Luis jimenez</option>
     
        </select>
      </div>



      <!-- Botón Guardar -->
      <div class="form-group">
        <button type="submit">Actualizar Cita</button>
      </div>
    </form>

    {{-- Mostrar validaciones --}}
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
