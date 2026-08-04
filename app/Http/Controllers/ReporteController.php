<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Estudiante;
use App\Exports\ReporteContinuoExport; // <-- Importamos tu clase de Excel
use Maatwebsite\Excel\Facades\Excel;    // <-- Importamos la fachada del paquete

class ReporteController extends Controller
{
    // Vista principal de reportes
    public function index()
    {
        try {

            $estudiantes = Estudiante::all();

            return view('reporte.index', compact('estudiantes'));

        } catch (\Exception $e) {

            return back()->with('error', 'Error al cargar reportes');

        }
    }

    // Generar PDF por estudiante
    public function tipo_reporte($tipo, $id)
    {
        try {

            switch ($tipo) {

                case 'estudiante':

                    $estudiante = Estudiante::with([

                    'carrera',

                    'examenes.resultadoCalificacion'

                    ])->find($id);

                    if (!$estudiante) {
                        return back()->with('error', 'Estudiante no encontrado');
                    }

                    $pdf = Pdf::loadView(
                        'reporte.estudiante',
                        compact('estudiante')
                    )->setPaper('A4', 'landscape');

                    return $pdf->stream('reporte_estudiante.pdf');

                break;

                default:

                    return back()->with('error', 'Tipo de reporte inválido');

            }

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Error al generar reporte: ' . $e->getMessage()
            );

        }
    }

    // Reporte general en PDF
    public function test()
{
    try {


        $estudiantes = Estudiante::with([

            'carrera',

            'examenes'

        ])->get();



        $pdf = Pdf::loadView(

            'reporte.estudiantes',

            compact('estudiantes')

        )->setPaper('A4', 'landscape');



        return $pdf->stream('reporte_general.pdf');


    } catch (\Exception $e) {


        return back()->with(

            'error',

            'Error al generar PDF'

        );


    }
}

    // NUEVO: Reporte continuo de Estudiantes y Exámenes en Excel
    public function exportarExcel()
    {
        try {

            return Excel::download(new ReporteContinuoExport, 'reporte_estudiantes_examenes.xlsx');

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Error al generar el reporte de Excel: ' . $e->getMessage()
            );

        }
    }
}