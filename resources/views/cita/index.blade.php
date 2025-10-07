@extends('layouts.plantilla')

@section('contenido')
<section class="container-tabla">
   <h2 class="titulo-tabla">Listado de Citas</h2>
   
   <nav class="nav-botones">
      {{-- formulario de filtros --}}
      <form action="{{ route('cita.index') }}" method="GET" class="form-filtros">
         {{-- filtro por fecha --}}
         <input type="date" name="fecha" value="{{ request('fecha') }}" class="filtro-input">

         {{-- filtro por estado --}}
         <select name="estado" class="filtro-select">
            <option value="">Estado</option>
            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
            <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
         </select>

         {{-- filtro por nombre de mascota o cliente --}}
         <input type="text" name="buscar" placeholder="Buscar mascota o cliente..." value="{{ request('buscar') }}" class="filtro-input">
      
         <button type="submit" class="nav-link btn-filtrar">Filtrar</button>
      </form>

      {{-- botones agregar y generar pdf --}}
      <ul class="nav-menu">
         <li class="nav-item">
            <a href="{{ route('cita.create') }}" class="nav-link btn-agregar">Agregar Cita</a>
         </li>
         <li class="nav-item">
            <a href="{{ route('pdf.citas', request()->query()) }}" target="_blank" class="nav-link btn-generar-pdf">Generar PDF</a>
         </li>
      </ul>
   </nav>

   <table class="tabla-productos">
      <thead>
         <tr>
            <th>ID</th>
            <th>Nombre Mascota</th>
            <th>Nombre Dueño</th>
            <th>Servicio</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>Acciones</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($citas as $cita)
         <tr>
            <td>{{ $cita->id }}</td>
            <td>{{ $cita->nombre_mascota }}</td>
            <td>{{ $cita->nombre_duenio }}</td>
            <td>{{ $cita->servicio }}</td>
            <td>{{ $cita->fecha }}</td>
            <td>{{ $cita->hora }}</td>
            <td>{{ ucfirst($cita->estado) }}</td>
            <td class="acciones">
               <a href="{{ route('cita.show', $cita->id) }}" class="btn-ver"><img src="img/view.png" alt=""></a>
               <a href="{{ route('cita.edit', $cita->id) }}" class="btn-editar"><img src="img/edit.png" alt=""></a>
               <form action="{{ route('cita.destroy', $cita->id) }}" method="POST" style="display:inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta cita?')">
                     <input type="image"src="img/delete.png"></input>
                  </button>
               </form>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>

   <div class="paginacion">
      {{ $citas->links() }}
   </div>
</section>
@endsection
