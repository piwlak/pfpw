<?php 
//controladores
require_once('controllers/tutor.php');
require_once('controllers/usuario.php');
require_once('controllers/rol_tutor.php');

//vistas
include("views/header.php");
include("views/menu.php");
$tutor->validateRol('Director');


$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($action) {
    case 'new':
        $tutor->validatePrivilegio('Crear');

        $datausuario = $usuario->get();
        $datarol_tutor = $rol_tutor->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $tutor->new($data);
            if ($cantidad) {
                $tutor->flash('success', "Tutor dado de alta con éxito");
                $data = $tutor->get();
                include('views/tutor/index.php');
            } else {
                $tutor->flash('danger', "Algo fallo");
                include('views/tutor/form.php');
            }
        } else {
            include('views/tutor/form.php');
        }
        break;
        case 'edit':
            $tutor->validatePrivilegio('Modificar');
            $datausuario = $usuario->get();
            $datarol_tutor = $rol_tutor->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_tutor'];
                $cantidad = $tutor->edit($id, $data);
                if ($cantidad) {
                    $tutor->flash('success', "Tutor actualizado con éxito");
                    $data = $tutor->get();
                    include('views/tutor/index.php');
                } else {
                    $tutor->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $tutor->get();
                     print_r($data);
                    include('views/tutor/index.php');
                }
            } else {
                $data = $tutor->get($id);
                include('views/tutor/form.php');
            }
            break; 
            case 'delete':
                $tutor->validatePrivilegio('Borrar');
                $cantidad = $tutor->delete($id);
                if ($cantidad) {
                    $tutor->flash('success', "Tutor eliminado con exito");
                    $data = $tutor->get();
                    include('views/tutor/index.php');
                } else {
                    $tutor->flash('danger', "Algo fallo");
                    $data = $tutor->get();
                    include('views/tutor/index.php');
                }
            break;   
    case 'get':
    default:
    $tutor->validatePrivilegio('Consultar');
    $data = $tutor->get($id);
    include("views/tutor/index.php");       
}



include("views/footer.php");
?>