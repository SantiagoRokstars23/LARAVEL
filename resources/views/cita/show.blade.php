@extends('layouts.plantilla')

@section('contenido')

<section class="container-detalle">
   <h2 class="titulo-tabla">Detalles de la Cita</h2>

   <div class="detalle-cita">
      <div class="detalle-item">
         <strong>ID:</strong> {{ $cita->id }}
      </div>
      <div class="detalle-item">
         <strong>Fecha:</strong> {{ $cita->fecha }}
      </div>
      <div class="detalle-item">
         <strong>Hora:</strong> {{ $cita->hora }}
      </div>
      <div class="detalle-item">
         <strong>Mascota:</strong> {{ $cita->mascota->nombre ?? 'Sin mascota registrada' }}
      </div>
      <div class="detalle-item">
         <strong>Cliente:</strong> {{ $cita->cliente->nombre ?? 'Sin cliente asignado' }}
      </div>
      <div class="detalle-item">
         <strong>Veterinario:</strong> {{ $cita->veterinario->nombre ?? 'No asignado' }}
      </div>
      <div class="detalle-item">
         <strong>Motivo:</strong> {{ $cita->motivo }}
      </div>
      <div class="detalle-item">
         <strong>Estado:</strong> 
         <span class="estado {{ $cita->estado }}">
            {{ ucfirst($cita->estado) }}
         </span>
      </div>
      <div class="detalle-item">
         <strong>Observaciones:</strong> 
         {{ $cita->observaciones ?? 'Sin observaciones' }}
      </div>
   </div>

   <div class="nav-botones">
      <a href="{{ route('cita.index') }}" class="nav-link btn-regresar">← Volver al listado</a>
      <a href="{{ route('cita.edit', $cita->id) }}" class="nav-link btn-agregar">Editar cita</a>
      <form action="{{ route('cita.destroy', $cita->id) }}" method="POST" onsubmit="return confirmarEliminacion()" style="display:inline;">
         @csrf
         @method('DELETE')
         <button type="submit" class="nav-link btn-eliminar">Eliminar</button>
      </form>
   </div>

   <script>
      function confirmarEliminacion() {
         return confirm('¿Seguro deseas eliminar esta cita?');
      }
   </script>

</section>

@endsection
