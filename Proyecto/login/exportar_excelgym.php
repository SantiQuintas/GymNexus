<?php
require_once 'PHPExcel/Classes/PHPExcel.php';

$conexion = mysqli_connect("localhost", "root", "", "gym_nexus");
session_start();

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

$nombregym = $_SESSION['nombregym'];

// Realiza tus consultas para obtener la información del gimnasio
$consultaClientes = "SELECT COUNT(DISTINCT usuario) AS total_clientes FROM usuarios_gimnasios WHERE nombregym = '$nombregym'";
// Realiza otras consultas necesarias para obtener los datos del gimnasio

// Crear un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Crear una hoja de cálculo
$objPHPExcel->setActiveSheetIndex(0);

// Definir el título de las columnas
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Estadísticas del Gimnasio: ' . $nombregym);
$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Cantidad de Clientes');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Nuevos Asociados en el Último Mes');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Crecimiento de Clientes (Mes Anterior al Último Mes)');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Ingresos Mensuales');
// Agrega más títulos según tus necesidades

// Inserta los datos obtenidos en las celdas correspondientes
$objPHPExcel->getActiveSheet()->setCellValue('A4', $totalClientes);
$objPHPExcel->getActiveSheet()->setCellValue('B4', $nuevosAsociados);
$objPHPExcel->getActiveSheet()->setCellValue('C4', $totalClientes - $clientesMesAnterior);
$objPHPExcel->getActiveSheet()->setCellValue('D4', $ingresosMensuales);
// Inserta más datos según tus necesidades

// Configurar el ancho de las columnas si es necesario
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
// Configura el ancho de más columnas si es necesario

// Guarda el archivo de Excel
$filename = 'estadisticas_gimnasio_' . $nombregym . '.xlsx';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($filename);

// Descarga el archivo generado
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
readfile($filename);

// Elimina el archivo después de la descarga
unlink($filename);

?>


