<?php
require_once(__DIR__.'/controllers/grupo.php');
require_once(__DIR__.'/controllers/grado.php');
require_once(__DIR__.'/controllers/maestro.php');
include_once('views/header.php');
include_once('views/menu_director.php');

$grupo->validateRol('Director');


$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($action) {
    case 'new':
        $grupo->validatePrivilegio('Crear');
        $datagrado1 = $grado->get(1);
        $datagrado2 = $grado->get(2);
        $datagrado3 = $grado->get(3);
        $datamaestro = $maestro->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $grupo->new($data);
            if ($cantidad) {
                $grupo->flash('success', "Grupo dado de alta con éxito");
                $data = $grupo->get();
                include('views/grupo/index.php');
            } else {
                $grupo->flash('danger', "Algo fallo");
                include('views/grupo/form.php');
            }
        } else {
            include('views/grupo/form.php');
        }
        break;
        case 'edit':
            $grupo->validatePrivilegio('Modificar');
            $datamaestro = $maestro->get();
            $datagrado1 = $grado->get(1);
            $datagrado2 = $grado->get(2);
            $datagrado3 = $grado->get(3);
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_grupo'];
                $cantidad = $grupo->edit($id, $data);
                if ($cantidad) {
                    $grupo->flash('success', "Grupo actualizado con éxito");
                    $data = $grupo->get();
                    include('views/grupo/index.php');
                } else {
                    $grupo->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $grupo->get();
                    include('views/grupo/index.php');
                }
            } else {
                $data = $grupo->get($id);
                include('views/grupo/form.php');
            }
            break; 
            case 'delete':
                $grupo->validatePrivilegio('Borrar');
                $cantidad = $grupo->delete($id);
                if ($cantidad) {
                    $grupo->flash('success', "Grupo eliminado con exito");
                    $data = $grupo->get();
                    include('views/grupo/index.php');
                } else {
                    $grupo->flash('danger', "Algo fallo");
                    $data = $grupo->get();
                    include('views/grupo/index.php');
                }
            break;   
    case 'get':
    default:
    $grupo->validatePrivilegio('Consultar');
    $data = $grupo->get($id);
    include("views/grupo/index.php");       
}

include_once('views/footer.php');
?>