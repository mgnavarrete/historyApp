<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class InicioController extends Controller
{
    // Muestra la lista de códigos
    public function index()
    {
        // Obtener la lista de archivos del bucket en el disco S3 configurado
        $files = Storage::disk('s3')->files('Historial-Subida');

        // Filtrar solo los archivos que siguen el patrón 'XXX-historial.csv'
        $codigos = [];

        foreach ($files as $file) {
            if (preg_match('/Historial-Subida\/(.*)-historial\.csv$/', $file, $matches)) {
                $codigos[] = $matches[1];
            }
        }

        return view('pages.index', compact('codigos'));
    }

    // Muestra el historial de un código
    public function showHistorial($codigo)
    {
        // Construir la ruta del archivo en base al código
        $filePath = "Historial-Subida/{$codigo}-historial.csv";

        // Verificar si el archivo existe en S3
        if (!Storage::disk('s3')->exists($filePath)) {
            abort(404, 'El archivo no existe');
        }

        // Obtener el contenido del archivo CSV desde S3
        $csvContent = Storage::disk('s3')->get($filePath);

        // Convertir el contenido CSV en un array
        $csvData = array_map('str_getcsv', explode("\n", $csvContent));

        return view('pages.historial', ['codigo' => $codigo, 'csvData' => $csvData]);
    }

    // Método para devolver el historial en formato JSON (para la actualización automática)
    public function fetchHistorialJson($codigo)
    {
        // Construir la ruta del archivo en base al código
        $filePath = "Historial-Subida/{$codigo}-historial.csv";

        // Verificar si el archivo existe en S3
        if (!Storage::disk('s3')->exists($filePath)) {
            return response()->json(['error' => 'Archivo no encontrado'], 404);
        }

        // Obtener el contenido del archivo CSV desde S3
        $csvContent = Storage::disk('s3')->get($filePath);

        // Convertir el contenido CSV en un array
        $csvData = array_map('str_getcsv', explode("\n", $csvContent));

        // Devolver el CSV en formato JSON
        return response()->json($csvData);
    }
}
