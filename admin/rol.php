<?php
require_once('controllers/rol.php');
require_once('controllers/privilegio.php');
include_once('views/header.php');
include_once('views/menu.php');

$rol->validateRol('Administrador');

$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_privilegio = (isset($_GET['id_privilegio'])) ? $_GET['id_privilegio'] : null;

switch ($action) {
    case 'new':
        $rol->validatePrivilegio('Crear');

        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $rol->new($data);
            if ($cantidad) {
                $rol->flash('success', "Rol dado de alta con éxito");
                $data = $rol->get();
                include('views/rol/index.php');
            } else {
                $rol->flash('danger', "Algo fallo");
                include('views/rol/form.php');
            }
        } else {
            include('views/rol/form.php');
        }
        break;
        case 'edit':
            $rol->validatePrivilegio('Modificar');

            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_rol'];
                $cantidad = $rol->edit($id, $data);
                if ($cantidad) {
                    $rol->flash('success', "Rol actualizado con éxito");
                    $data = $rol->get();
                    include('views/rol/index.php');
                } else {
                    $rol->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $rol->get();
                    include('views/rol/index.php');
                }
            } else {
                $data = $rol->get($id);
                include('views/rol/form.php');
            }
            break; 
            case 'delete':
                $rol->validatePrivilegio('Borrar');

                $cantidad = $rol->delete($id);
                if ($cantidad) {
                    $rol->flash('success', "Rol eliminado con exito");
                    $data = $rol->get();
                    include('views/rol/index.php');
                } else {
                    $rol->flash('danger', "Algo fallo");
                    $data = $rol->get();
                    include('views/rol/index.php');
                }
            break; 
            case 'privilegio':
                $rol->validatePrivilegio('Consultar');

                $data = $rol->get($id);
                $data_privilegio = $rol->getPrivilegio($id);
                include("views/rol/privilegio.php");
                break; 
            case 'newPrivilegio':
            $rol->validatePrivilegio('Crear');
            $data = $rol->get($id);
            $data_privilegio = $privilegio->get();
            if (isset($_POST['enviar'])) {
                $data2 = $_POST['data'];
                $cantidad = $rol->newPrivilegio($id, $data2);
                if ($cantidad) {
                    $rol->flash('success', "Privilegio asignado con éxito");
                } else {
                    $rol->flash('danger', "Algo fallo");
                }
                $data_privilegio = $rol->getPrivilegio($id);
                include('views/rol/privilegio.php');
            } else {
                include("views/rol/privilegio_form.php");
            }
            break; 
            case 'deletePrivilegio':
                $rol->validatePrivilegio('Borrar');

                // $proyecto -> validatePrivilegio('Proyecto Eliminar');
                 $cantidad = $rol->deletePrivilegio($id_privilegio);
                 if ($cantidad) {
                     $rol->flash('success', "Privilegio eliminado con exito");
                     $data = $rol->get($id);
                     $data_privilegio = $rol->getPrivilegio($id);
                     include('views/rol/privilegio.php');
                 } else {
                     $rol->flash('danger', "Algo fallo");
                     $data = $rol->get($id);
                     $data_privilegio = $rol->getPrivilegio($id);
                     include('views/rol/privilegio.php');
                 }
                 break;  
    case 'get':
    default:
    $rol->validatePrivilegio('Consultar');

    $data = $rol->get($id);
    include("views/rol/index.php");       
}

include_once('views/footer.php');

?>