<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cita;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    // ----------------------------
    // PDF DE PRODUCTOS
    // ----------------------------
    public function pdfProductos(Request $request)
    {
        $query = Producto::select('id', 'nombre', 'descripcion', 'precio', 'precio_venta', 'stock', 'id_categoria');

        // Filtro por categoría
        if ($request->filled('categoria')) {
            $query->where('id_categoria', $request->categoria);
        }

        // Filtro por stock
        if ($request->stock == 'con') {
            $query->where('stock', '>', 0);
        } elseif ($request->stock == 'sin') {
            $query->where('stock', '<=', 0);
        }

        // Filtro por nombre o búsqueda
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // Obtener resultados con orden
        $productos = $query->orderBy('id', 'ASC')->get();

        // Carga la vista del PDF
        $pdf = Pdf::loadView('pdf.productos', compact('productos'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Listado_de_Productos.pdf');
    }

    // ----------------------------
    // PDF DE CITAS
    // ----------------------------
    public function pdfCitas(Request $request)
    {
        $query = Cita::select('id', 'fecha', 'hora', 'nombre_mascota', 'nombre_dueno');

        // Filtros opcionales
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre_mascota', 'like', '%' . $buscar . '%')
                  ->orWhere('nombre_dueno', 'like', '%' . $buscar . '%');
            });
        }

        $citas = $query->orderBy('fecha', 'ASC')->get();

        // Asegúrate de que la vista exista: resources/views/pdf/citas.blade.php
        $pdf = Pdf::loadView('pdf.citas', compact('citas'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Listado_de_Citas.pdf');
    }
}
