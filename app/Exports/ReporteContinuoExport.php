<?php

namespace App\Exports;

use App\Models\Examen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReporteContinuoExport implements
FromCollection,
WithHeadings,
WithMapping,
ShouldAutoSize,
WithEvents,
WithMultipleSheets
{

    public function collection()
    {

        return Examen::with([

            'estudiante.carrera',

            'resultadoCalificacion',

            'anio'

        ])->orderBy('fecha')->get();

    }

    public function headings(): array
{
    return [

        'No. Control',

        'Nombre',

        'Carrera',

        'Correo',

        'Horario',

        'Tipo de alumno',

        'Tipo de examen',

        'Fecha',

        'Intento',

        'Pago',

        'Folio',

        'Resultado',

        'Reading',

        'Listening',

        'Writing',

        'Speaking',

        'Promedio',

        'Puntaje TOEFL',

        'Nivel de ubicación',

        'Estado'

    ];
}
public function map($examen): array
{

    $estudiante = $examen->estudiante;

    $calificacion = $examen->resultadoCalificacion;


    return [

        // Datos del estudiante

        $estudiante?->numero_control,

        $estudiante?->nombre_completo,

        $estudiante?->carrera?->nombre,

        $estudiante?->correo,

        $estudiante?->horario,

        $estudiante?->tipo_alumno,



        // Datos del examen

        $examen->tipo_examen,

        $examen->fecha 
        ? \Carbon\Carbon::parse($examen->fecha)->format('d/m/Y')
        : null,

        $examen->intento,

        $examen->pago ? 'Pagado' : 'Pendiente',

        $examen->folio,

        $examen->resultado,



        // Calificaciones 4 habilidades

        $calificacion?->reading,

        $calificacion?->listening,

        $calificacion?->writing,

        $calificacion?->speaking,

        $calificacion?->promedio,



        // TOEFL

        $calificacion?->puntaje_toefl,



        // Ubicación

        $calificacion?->nivel_ubicacion,



        // Estado del examen

        $calificacion

            ? 'Calificado'

            : 'Pendiente'


    ];

}
public function styles(Worksheet $sheet)
{

    return [

        // Primera fila (encabezados)
        1 => [

            'font' => [

                'bold' => true,

                'color' => [
                    'rgb' => 'FFFFFF'
                ]

            ],

            'fill' => [

                'fillType' => Fill::FILL_SOLID,

                'startColor' => [

                    'rgb' => '16A34A'

                ]

            ],

            'alignment' => [

                'horizontal' => Alignment::HORIZONTAL_CENTER

            ]

        ]

    ];

}
public function registerEvents(): array
{

    return [

        AfterSheet::class => function($event){


            $sheet = $event->sheet->getDelegate();



            // Insertar filas superiores para título

            $sheet->insertNewRowBefore(1,3);



            // Título

            $sheet->mergeCells('A1:S1');

            $sheet->setCellValue(
                'A1',
                'Tecnológico Nacional de México'
            );


            $sheet->mergeCells('A2:S2');

            $sheet->setCellValue(
                'A2',
                'Sistema de Control de Calificaciones'
            );


            $sheet->mergeCells('A3:S3');

            $sheet->setCellValue(
                'A3',
                'Reporte general de exámenes - '.date('d/m/Y')
            );



            // Estilo títulos

            $sheet->getStyle('A1:S3')
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            );



            $sheet->getStyle('A1:S1')
            ->getFont()
            ->setBold(true)
            ->setSize(16);



            $sheet->getStyle('A2:S3')
            ->getFont()
            ->setBold(true);



            // Encabezados de tabla

            $sheet->getStyle('A4:S4')
            ->getFont()
            ->setBold(true);



            $sheet->getStyle('A4:S4')
            ->getFill()
            ->setFillType(
                Fill::FILL_SOLID
            )
            ->getStartColor()
            ->setRGB('39FF88');



            // Centrar toda la información

            $sheet->getStyle(
                $sheet->calculateWorksheetDimension()
            )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            );



            // Bordes

            $sheet->getStyle(
                $sheet->calculateWorksheetDimension()
            )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                Border::BORDER_THIN
            );



            // Congelar encabezados

            $sheet->freezePane('A5');



            // Filtros

            $sheet->setAutoFilter(
                'A4:S'. $sheet->getHighestRow()
            );

            foreach(
    $sheet->getRowIterator(5) as $row
){

    $estado = $sheet
        ->getCell('G'.$row->getRowIndex())
        ->getValue();


    if($estado == 'Calificado'){

        $sheet->getStyle(
            'G'.$row->getRowIndex()
        )
        ->getFill()
        ->setFillType(
            Fill::FILL_SOLID
        )
        ->getStartColor()
        ->setRGB('39FF88');

    }


    if($estado == 'Pendiente'){

        $sheet->getStyle(
            'G'.$row->getRowIndex()
        )
        ->getFill()
        ->setFillType(
            Fill::FILL_SOLID
        )
        ->getStartColor()
        ->setRGB('FFFF00');

    }

}
foreach ($sheet->getRowIterator(5) as $row) {

    $fila = $row->getRowIndex();

    $estado = $sheet
        ->getCell('T'.$fila)
        ->getValue();


    if($estado == 'Calificado'){

        $sheet->getStyle('T'.$fila)
            ->getFill()
            ->setFillType(
                Fill::FILL_SOLID
            )
            ->getStartColor()
            ->setRGB('39FF88');

    }


    if($estado == 'Pendiente'){

        $sheet->getStyle('T'.$fila)
            ->getFill()
            ->setFillType(
                Fill::FILL_SOLID
            )
            ->getStartColor()
            ->setRGB('FFFF00');

    }

}
foreach ($sheet->getRowIterator(5) as $row) {

    $fila = $row->getRowIndex();

    $pago = $sheet
        ->getCell('J'.$fila)
        ->getValue();


    if($pago == 'Pagado'){

        $sheet->getStyle('J'.$fila)
        ->getFill()
        ->setFillType(
            Fill::FILL_SOLID
        )
        ->getStartColor()
        ->setRGB('39FF88');

    }


    if($pago == 'Pendiente'){

        $sheet->getStyle('J'.$fila)
        ->getFill()
        ->setFillType(
            Fill::FILL_SOLID
        )
        ->getStartColor()
        ->setRGB('FFFF00');

    }

}


        }


    ];

}
public function sheets(): array
{

    return [

        $this,

        new ResumenExport()

    ];

}
}
