<?php 
//controladores
require_once('controllers/calificaciones.php');
require_once('controllers/materia.php');
require_once('controllers/alumno.php');
require_once('controllers/grupo.php');
require_once('controllers/tutor.php');
require_once('controllers/status.php');
require_once('controllers/localidad.php');

//vistas
include("views/header.php");
include("views/menu.php");

$alumno->validateRol('Maestro');


$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_grupo = (isset($_GET['id_grupo'])) ? $_GET['id_grupo'] : null;

switch ($action) {
    case 'new':
        $alumno->validatePrivilegio('Crear');
        $datalocalidad = $localidad->get();
        $datatutor = $tutor->get();
        $datastatus = $status->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $alumno->new($data);
            if ($cantidad) {
                $alumno->flash('success', "Alumno dado de alta con éxito");
                $data = $alumno->get();
                include('views/alumno/index.php');
            } else {
                $alumno->flash('danger', "Algo fallo");
                include('views/alumno/form.php');
            }
        } else {
            include('views/alumno/form.php');
        }
        break;
        case 'edit':
            $alumno->validatePrivilegio('Modificar');
            $datalocalidad = $localidad->get();
            $datatutor = $tutor->get();
            $datastatus = $status->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_alumno'];
                $cantidad = $alumno->edit($id, $data);
                if ($cantidad) {
                    $alumno->flash('success', "Alumno actualizado con éxito");
                    $data = $alumno->get();
                    include('views/alumno/index.php');
                } else {
                    $alumno->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $alumno->get();
                    include('views/alumno/index.php');
                }
            } else {
                $data = $alumno->get($id);
                include('views/alumno/form.php');
            }
            break; 
            case 'delete':
                $alumno->validatePrivilegio('Borrar');
                $cantidad = $alumno->delete($id);
                if ($cantidad) {
                    $alumno->flash('success', "Alumno eliminado con exito");
                    $data = $alumno->get();
                    include('views/alumno/index.php');
                } else {
                    $alumno->flash('danger', "Algo fallo");
                    $data = $alumno->get();
                    include('views/alumno/index.php');
                }
            break; 
            case 'asignar':
                $alumno->validatePrivilegio('Consultar');
                $data = $alumno->get($id);
                $data_grupo = $alumno->getGrupo($id);
                include("views/alumno/asignar.php");
                break; 
        case 'newGrupo':
            $alumno->validatePrivilegio('Crear');
            $data = $alumno->get($id);
                $data_grupo = $grupo->get();
                if (isset($_POST['enviar'])) {
                    $data2 = $_POST['data'];
                    $cantidad = $alumno->newGrupo($id, $data2);
                    if ($cantidad) {
                        $alumno->flash('success', "Grupo asignado con éxito");
                    } else {
                        $alumno->flash('danger', "Algo fallo");
                    }
                    $data_grupo = $alumno->getGrupo($id);
                    include('views/alumno/asignar.php');
                } else {
                    include("views/alumno/asignar_form.php");
                }
                break; 
                case 'deleteGrupo':
                    $alumno->validatePrivilegio('Borrar');
                    $cantidad = $alumno->deleteGrupo($id_grupo);
                     if ($cantidad) {
                         $alumno->flash('success', "Grupo eliminado con exito");
                         $data = $alumno->get($id);
                         $data_grupo = $alumno->getGrupo($id);
                         include('views/alumno/asignar.php');
                     } else {
                         $alumno->flash('danger', "Algo fallo");
                         $data = $alumno->get($id);
                         $data_grupo = $alumno->getGrupo($id);
                         include('views/alumno/asignar.php');
                     }
                     break;   
                    case 'getCalificacion':
                    $alumno->validatePrivilegio('Consultar');
                    $datacalificacion = $calificacion->get($id);
                    $data = $alumno->get($id);
                    include("views/calificaciones/index.php");
                    break;
                    case 'guardar':
                        $alumno->validatePrivilegio('Modificar');
                        if (isset($_POST['enviar'])) {
                            $data = $_POST['calificacion'];
                            $id = $_POST['data']['id_alumno'];
                            $cantidad = $alumno->guardar($id, $data);
                            if ($cantidad) {
                                $alumno->flash('success', "Calificaciones Guardadas con éxito");
                                $data = $alumno->get();
                                include("views/alumno/index.php");       
                            } else {
                                $alumno->flash('warning', "Algo fallo o no hubo cambios");
                                $data = $calificacion->get();
                                include("views/alumno/index.php");       
                            }
                        } else {
                            $data = $calificacion->get($id);
                            include("views/calificaciones/index.php");
                        }
                    break;                   
    case 'get':
    default:
    $alumno->validatePrivilegio('Consultar');
    $data = $alumno->get($id);
    include("views/alumno/index.php");       
}



include("views/footer.php");
?>