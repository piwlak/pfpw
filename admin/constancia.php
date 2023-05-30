<?php
    require_once(__DIR__.'/controllers/sistema.php');
    require_once ('../vendor/autoload.php');
    use Spipu\Html2Pdf\Html2Pdf;
    $html2pdf = new Html2Pdf();

    $action = (isset($_GET['action'])) ? $_GET['action'] : null;
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;

    $sistema->db();

    switch ($action) {
        case 'alumno':
            $sql = "SELECT * FROM alumno AS a
                    LEFT JOIN tutor t ON a.id_tutor = t.id_tutor
                    LEFT JOIN localidad l ON a.id_localidad = l.id_localidad
                    LEFT JOIN status s ON a.id_status = s.id_status
                    LEFT JOIN calificacion c ON a.id_alumno = c.id_alumno
                    WHERE a.id_alumno = :id_alumno";
            $st = $sistema->db->prepare($sql);
            $st->bindParam(":id_alumno", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            $aux=0;
            $html = '
            <h1>Constancia de Estudios</h1>
            <hr>
            <h2>Colegio Muller</h2>';

            foreach ($data as $alumno) {
                $aux = ($aux + ($alumno['periodo_1'] + $alumno['periodo_2'] + $alumno['periodo_3']) / 3);
            }
            $promedio=$aux/(count($data));
            $html .= '
            <p>Nombre del alumno: '.$alumno['nombre_alumno'].' '.$alumno['primer_apellido_alumno'].' '.$alumno['segundo_apellido_alumno'].'</p>
            <p>CURP: '.$alumno['curp_alumno'].'</p>
            <p>Promedio de calificaciones: '.$promedio.'</p>
            <hr>';
            break;
        
        default:
            $html = '<h1>Sin reporte</h1>No hay ningún reporte para generar';
            break;
    }
    
    $html2pdf->writeHTML($html);
    $html2pdf->output();
?>
