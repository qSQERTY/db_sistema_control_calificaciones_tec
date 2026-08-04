<?php

namespace App\Exports;


use App\Models\Estudiante;
use App\Models\Examen;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;



class ResumenExport implements FromCollection, WithTitle, WithEvents
{


    public function collection()
    {


        return collect([


            [
                'TOTAL DE ESTUDIANTES',
                Estudiante::count()
            ],


            [
                'TOTAL DE EXÁMENES',
                Examen::count()
            ],


            [
                '',
                ''
            ],


            [
                'TIPO DE EXAMEN',
                'CANTIDAD'
            ],



            [
                'Examen de Ubicación',

                Examen::where(
                    'tipo_examen',
                    'Examen de Ubicación'
                )->count()

            ],



            [
                'Examen General de 4 Habilidades',

                Examen::where(
                    'tipo_examen',
                    'Examen General de 4 Habilidades'
                )->count()

            ],



            [
                'TOEFL ITP',

                Examen::where(
                    'tipo_examen',
                    'TOEFL ITP'
                )->count()

            ],



            [
                'Speaking por Certificación',

                Examen::where(
                    'tipo_examen',
                    'Speaking por Certificación'
                )->count()

            ],



            [
                '',
                ''
            ],



            [
                'ESTADO DE RESULTADOS',
                'CANTIDAD'
            ],



            [
                'Calificados',

                Examen::whereHas(
                    'resultadoCalificacion'
                )->count()

            ],



            [
                'Pendientes',

                Examen::doesntHave(
                    'resultadoCalificacion'
                )->count()

            ],



            [
                '',
                ''
            ],



            [
                'ESTADO DE PAGOS',
                'CANTIDAD'
            ],



            [
                'Pagados',

                Examen::where(
                    'pago',
                    1
                )->count()

            ],



            [
                'Pendientes',

                Examen::where(
                    'pago',
                    0
                )->count()

            ]


        ]);

    }



    public function title(): string
    {
        return 'Resumen';
    }
    public function registerEvents(): array
{

    return [

        AfterSheet::class => function($event){


            $sheet = $event->sheet->getDelegate();



            // Ancho de columnas

            $sheet->getColumnDimension('A')
                ->setWidth(35);


            $sheet->getColumnDimension('B')
                ->setWidth(15);



            // Títulos principales

            $sheet->insertNewRowBefore(1,2);



            $sheet->mergeCells('A1:B1');

            $sheet->setCellValue(
                'A1',
                'Tecnológico Nacional de México'
            );



            $sheet->mergeCells('A2:B2');

            $sheet->setCellValue(
                'A2',
                'Sistema de Control de Calificaciones'
            );



            $sheet->getStyle('A1:B2')
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            );



            $sheet->getStyle('A1')
            ->getFont()
            ->setBold(true)
            ->setSize(16);



            $sheet->getStyle('A2')
            ->getFont()
            ->setBold(true);



            // Encabezados de secciones

            foreach([6,14,20] as $fila){


                $sheet->getStyle(
                    'A'.$fila.':B'.$fila
                )
                ->getFill()
                ->setFillType(
                    Fill::FILL_SOLID
                )
                ->getStartColor()
                ->setRGB('39FF88');



                $sheet->getStyle(
                    'A'.$fila.':B'.$fila
                )
                ->getFont()
                ->setBold(true);


            }



            // Bordes

            $sheet->getStyle(
                $sheet->calculateWorksheetDimension()
            )
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                Border::BORDER_THIN
            );



            // Centrar cantidades

            $sheet->getStyle(
                'B:B'
            )
            ->getAlignment()
            ->setHorizontal(
                Alignment::HORIZONTAL_CENTER
            );



        }

    ];

}


}