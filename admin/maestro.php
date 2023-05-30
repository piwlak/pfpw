<?php
//controladores
require_once(__DIR__.'/controllers/maestro.php');
require_once(__DIR__.'/controllers/usuario.php');

//vistas
include("views/header.php");
include("views/menu_director.php");
$maestro->validateRol('Director');

$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($action) {
    case 'new':
        $maestro->validatePrivilegio('Crear');

        $datausuario = $usuario->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $maestro->new($data);
            if ($cantidad) {
                $maestro->flash('success', "Maestro dado de alta con éxito");
                $data = $maestro->get();
                include('views/maestro/index.php');
            } else {
                $maestro->flash('danger', "Algo fallo");
                include('views/maestro/form.php');
            }
        } else {
            include('views/maestro/form.php');
        }
        break;
        case 'edit':
            $maestro->validatePrivilegio('Modificar');

            $datausuario = $usuario->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_maestro'];
                $cantidad = $maestro->edit($id, $data);
                if ($cantidad) {
                    $maestro->flash('success', "Maestro actualizado con éxito");
                    $data = $maestro->get();
                    include('views/maestro/index.php');
                } else {
                    $maestro->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $maestro->get();
                    include('views/maestro/index.php');
                }
            } else {
                $data = $maestro->get($id);
                include('views/maestro/form.php');
            }
            break; 
            case 'delete':
                $maestro->validatePrivilegio('Borrar');

                $cantidad = $maestro->delete($id);
                if ($cantidad) {
                    $maestro->flash('success', "Maestro eliminado con exito");
                    $data = $maestro->get();
                    include('views/maestro/index.php');
                } else {
                    $maestro->flash('danger', "Algo fallo");
                    $data = $maestro->get();
                    include('views/maestro/index.php');
                }
            break;   
    case 'get':
    default:
    $maestro->validatePrivilegio('Consultar');

    $data = $maestro->get($id);
    include("views/maestro/index.php");       
}
include("views/footer.php");
?>