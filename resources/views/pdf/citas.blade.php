<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Citas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Listado de Citas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Dueño</th>
                <th>Mascota</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
            <tr>
                <td>{{ $cita->id }}</td>
                <td>{{ $cita->nombre_dueno }}</td>
                <td>{{ $cita->nombre_mascota }}</td>
                <td>{{ $cita->fecha }}</td>
                <td>{{ $cita->hora }}</td>
                <td>{{ $cita->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
