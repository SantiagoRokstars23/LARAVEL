@extends('layouts.plantilla')

@section('contenido')
<div class="container-formulario">
  <div class="card formulario">
    <h2>Registrar Nueva Cita</h2>

    <form action="{{ route('cita.store') }}" enctype="multipart/form-data" method="POST">
      @csrf

      <!-- Campo Mascota -->
      <div class="form-group">
        <label for="nombre_mascota">Nombre de la Mascota</label>
        <input type="text" id="nombre_mascota" name="nombre_mascota" required>
      </div>

      <!-- Campo Dueño -->
      <div class="form-group">
        <label for="nombre_dueno">Nombre del Dueño</label>
        <input type="text" id="nombre_dueno" name="nombre_dueno" required>
      </div>

      <!-- Campo Fecha -->
      <div class="form-group">
        <label for="fecha">Fecha de la Cita</label>
        <input type="date" id="fecha" name="fecha" required>
      </div>

      <!-- Campo Hora -->
      <div class="form-group">
        <label for="hora">Hora de la Cita</label>
        <input type="time" id="hora" name="hora" required>
      </div>

      <!-- Campo Motivo o Descripción -->
      <div class="form-group">
        <label for="motivo">Motivo de la Cita</label>
        <textarea id="motivo" name="motivo" rows="4"></textarea>
      </div>

      <!-- Campo Veterinario -->
      <div class="form-group">
        <label for="veterinario">Veterinario Asignado</label>
        <select name="veterinario" id="veterinario" required>
          <option value="" disabled selected>Seleccione un veterinario</option>
        
            <option value="Santiago grueso">Santiago grueso</option>
            <option value="Andres carvajal">Andres carvajal</option>
            <option value="Jhon carvajal">Jhon carvajal</option>
            <option value="Luis jimenez">Luis jimenez</option>
     
        </select>
      </div>

            <!-- Campo servicio -->
      <div class="form-group">
        <label for="servicio">Servicio</label>
        <select name="servicio" id="servicio" required>
          <option value="" disabled selected>Seleccione un servicio</option>
        
            <option value="Vacunacion">Vacunacion</option>
            <option value="Baño">Baño</option>
            <option value="Peluqueria">Peluqueria</option>
            <option value="Revision">Revision</option>
     
        </select>
      </div>

      <!-- Botón Guardar -->
      <div class="form-group">
        <button type="submit">Guardar Cita</button>
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
