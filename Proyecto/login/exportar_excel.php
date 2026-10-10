<?php
require_once 'PHPExcel/Classes/PHPExcel.php';

// Crear un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Crear una hoja de cálculo
$objPHPExcel->setActiveSheetIndex(0);

// Definir el título de las columnas
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Cantidad Total de Gimnasios');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Cantidad Total de Usuarios');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Precio Mensual Promedio de los Gimnasios');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Gimnasios Asistidos por Usuarios');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Gimnasios Registrados');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Usuarios Registrados');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Valoración Promedio de Gimnasios');

// Realizar las mismas consultas SQL que en tu página web para obtener las estadísticas
$conn = mysqli_connect("localhost", "root", "", "gym_nexus");

// Consulta 1: Cantidad Total de Gimnasios
$sqlTotalGimnasios = "SELECT COUNT(*) AS total_gimnasios FROM gimnasio";
$resultTotalGimnasios = $conn->query($sqlTotalGimnasios);
$rowTotalGimnasios = $resultTotalGimnasios->fetch_assoc();
$totalGimnasios = $rowTotalGimnasios['total_gimnasios'];
$objPHPExcel->getActiveSheet()->setCellValue('A2', $totalGimnasios);

// Consulta 2: Cantidad Total de Usuarios
$sqlTotalUsuarios = "SELECT COUNT(*) AS total_usuarios FROM usuario";
$resultTotalUsuarios = $conn->query($sqlTotalUsuarios);
$rowTotalUsuarios = $resultTotalUsuarios->fetch_assoc();
$totalUsuarios = $rowTotalUsuarios['total_usuarios'];
$objPHPExcel->getActiveSheet()->setCellValue('B2', $totalUsuarios);

// Consulta 3: Precio Mensual Promedio de los Gimnasios
$sqlPrecioMensualPromedio = "SELECT AVG(mensualidad) AS precio_promedio FROM gimnasio";
$resultPrecioMensualPromedio = $conn->query($sqlPrecioMensualPromedio);
$rowPrecioMensualPromedio = $resultPrecioMensualPromedio->fetch_assoc();
$precioPromedioMensual = number_format($rowPrecioMensualPromedio['precio_promedio'], 2, '.', '');
$objPHPExcel->getActiveSheet()->setCellValue('C2', $precioPromedioMensual);

// Consulta 4: Gimnasios Asistidos por Usuarios
$sqlGimnasiosAsistidos = "SELECT * FROM usuarios_gimnasios";
$resultGimnasiosAsistidos = $conn->query($sqlGimnasiosAsistidos);
$gimnasiosAsistidos = '';
if ($resultGimnasiosAsistidos->num_rows > 0) {
    while ($row = $resultGimnasiosAsistidos->fetch_assoc()) {
        $gimnasiosAsistidos .= "ID: " . $row['id'] . ", Gimnasio: " . $row['nombregym'] . ", Usuario: " . $row['usuario'] . ", Fecha de Indicación: " . $row['fecha_indicacion'] . "\n";
    }
}
$objPHPExcel->getActiveSheet()->setCellValue('D2', $gimnasiosAsistidos);

// Consulta 5: Gimnasios Registrados
$sqlConsultaGimnasios = "SELECT * FROM gimnasio";
$resultGimnasios = $conn->query($sqlConsultaGimnasios);
$rowIndex = 2;
while ($rowGimnasio = $resultGimnasios->fetch_assoc()) {
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowIndex, 'Nombre Gym: ' . $rowGimnasio['nombregym']);
    $rowIndex++;
    // Agregar detalles adicionales aquí, si es necesario
}

// Consulta 6: Usuarios Registrados
$sqlConsultaUsuario = "SELECT * FROM usuario";
$resultUsuario = $conn->query($sqlConsultaUsuario);
$rowIndex = 2;
while ($rowUsuario = $resultUsuario->fetch_assoc()) {
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowIndex, 'Nombre: ' . $rowUsuario['nombre']);
    $rowIndex++;
    // Agregar detalles adicionales aquí, si es necesario
}

// Consulta 7: Valoración Promedio de Gimnasios
$sqlPromedioValoracion = "SELECT AVG(puntuacion) AS promedio FROM puntuaciones";
$resultPromedioValoracion = $conn->query($sqlPromedioValoracion);
$rowPromedioValoracion = $resultPromedioValoracion->fetch_assoc();
$promedioValoracion = number_format($rowPromedioValoracion['promedio'], 2, '.', '');
$objPHPExcel->getActiveSheet()->setCellValue('G2', $promedioValoracion);

// Consulta 8: Comentarios en Gimnasios
$sqlComentarios = "SELECT * FROM comentarios";
$resultComentarios = $conn->query($sqlComentarios);
$comentarios = '';
if ($resultComentarios->num_rows > 0) {
    while ($row = $resultComentarios->fetch_assoc()) {
        $comentarios .= "Gimnasio: " . $row['nombregym'] . ", Usuario: " . $row['usuario'] . ", Comentario: " . $row['comentario'] . ", Fecha: " . $row['fecha'] . "\n";
    }
}
$objPHPExcel->getActiveSheet()->setCellValue('H2', $comentarios);


// Configurar el ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50);

// Definir el nombre del archivo
$filename = 'estadisticas.xlsx';

// Configurar el encabezado para la descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");

// Salida al navegador
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>


