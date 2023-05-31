<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
include_once(__DIR__.'/controllers/alumno.php');

// Obtener los datos de los alumnos desde tu controlador
$alumnos = $alumno->get();

// Crear un nuevo objeto Spreadsheet
$spreadsheet = new Spreadsheet();
// Obtener la hoja activa
$sheet = $spreadsheet->getActiveSheet();
// Agregar los datos de los alumnos a la hoja de cálculo

foreach ($alumnos as $rowIndex => $rowData) {
    foreach ($rowData as $columnIndex => $cellData) {
        $numberOfItems = count($rowData);
        $sheet->setCellValueByColumnAndRow($numberOfItems , $rowIndex, $cellData);
    }
}



// Crear un objeto Writer para guardar el archivo de Excel
$writer = new Xlsx($spreadsheet);

// Establecer las cabeceras para descargar el archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="alumnos.xlsx"');
header('Cache-Control: max-age=0');

// Guardar el archivo en el flujo de salida de la respuesta
$writer->save('php://output');
