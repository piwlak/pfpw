<?php
require_once('controllers/materia.php');
require_once('controllers/grado.php');
require_once('controllers/nivel.php');
include_once('views/header.php');
include_once('views/menu.php');

$materia->validateRol('Director');

$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($action) {
    case 'new':
        $materia->validatePrivilegio('Crear');

        $datagrado1 = $grado->get(1);
        $datagrado2 = $grado->get(2);
        $datagrado3 = $grado->get(3);

        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $materia->new($data);
            if ($cantidad) {
                $materia->flash('success', "Nueva Materia Registrada");
                $data = $materia->get();
                include('views/materia/index.php');
            } else {
                $materia->flash('danger', "Algo fallo");
                include('views/materia/form.php');
            }
        } else {
            include('views/materia/form.php');
        }
        break;
        case 'edit':
            $materia->validatePrivilegio('Modificar');

            $datagrado1 = $grado->get(1);
            $datagrado2 = $grado->get(2);
            $datagrado3 = $grado->get(3);
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_materia'];
                $cantidad = $materia->edit($id, $data);
                if ($cantidad) {
                    $materia->flash('success', "Materia actualizada");
                    $data = $materia->get();
                    include('views/materia/index.php');
                } else {
                    $materia->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $materia->get();
                    include('views/materia/index.php');
                }
            } else {
                $data = $materia->get($id);
                include('views/materia/form.php');
            }
            break; 
            case 'delete':
                $materia->validatePrivilegio('Borrar');

                $cantidad = $materia->delete($id);
                if ($cantidad) {
                    $materia->flash('success', "Materia eliminado con exito");
                    $data = $materia->get();
                    include('views/materia/index.php');
                } else {
                    $materia->flash('danger', "Algo fallo");
                    $data = $materia->get();
                    include('views/materia/index.php');
                }
            break;   
    case 'get':
    default:
    $materia->validatePrivilegio('Consultar');
    $data = $materia->get($id);
    include("views/materia/index.php");       
}

include_once('views/footer.php');

?>