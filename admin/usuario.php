<?php
require_once(__DIR__."/controllers/usuario.php");
require_once(__DIR__."/controllers/rol.php");
include_once('views/header.php');
include_once('views/menu_director.php');
$usuario->validateRol('Administrador');

$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_rol = (isset($_GET['id_rol'])) ? $_GET['id_rol'] : null;
switch ($action) {
    case 'new':
        $usuario->validatePrivilegio('Crear');
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $usuario->new($data);
            if ($cantidad) {
                $usuario->flash('success', "Usuario dado de alta con éxito");
                $data = $usuario->get();
                include('views/usuario/index.php');
            } else {
                $usuario->flash('danger', "Algo fallo");
                include('views/usuario/form.php');
            }
        } else {
            include('views/usuario/form.php');
        }
        break;
        case 'edit':
            $usuario->validatePrivilegio('Modificar');
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_usuario'];
                $cantidad = $usuario->edit($id, $data);
                if ($cantidad) {
                    $usuario->flash('success', "Usuario actualizado con éxito");
                    $data = $usuario->get();
                    include('views/usuario/index.php');
                } else {
                    $usuario->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $usuario->get();
                    include('views/usuario/index.php');
                }
            } else {
                $data = $usuario->get($id);
                include('views/usuario/form.php');
            }
            break; 
            case 'delete':
                $usuario->validatePrivilegio('Borrar');
                $cantidad = $usuario->delete($id);
                if ($cantidad) {
                    $usuario->flash('success', "Usuario eliminado con exito");
                    $data = $usuario->get();
                    include('views/usuario/index.php');
                } else {
                    $usuario->flash('danger', "Algo fallo");
                    $data = $usuario->get();
                    include('views/usuario/index.php');
                }
            break;  
            case 'rol':
                $usuario->validatePrivilegio('Consultar');
                $data = $usuario->get($id);
                $data_rol = $usuario->getRol($id);
                include("views/usuario/rol.php");
                break;
            case 'newRol':
                $usuario->validatePrivilegio('Crear');
                $data = $usuario->get($id);
                $data_rol = $rol->get();
                if (isset($_POST['enviar'])) {
                    $data2 = $_POST['data'];
                    $cantidad = $usuario->newRol($id, $data2);
                    if ($cantidad) {
                        $usuario->flash('success', "Rol Asignado con éxito");
                    } else {
                        $usuario->flash('danger', "Algo fallo");
                    }
                    $data_rol = $usuario->getRol($id);
                    include('views/usuario/rol.php');
                } else {
                    include("views/usuario/rol_form.php");
                }
                break; 
                case 'deleteRol':
                    $usuario->validatePrivilegio('Borrar');
                     $cantidad = $usuario->deleteRol($id_rol);
                     if ($cantidad) {
                         $usuario->flash('success', "Rol eliminado con exito");
                         $data = $usuario->get($id);
                         $data_rol = $usuario->getRol($id);
                         include('views/usuario/rol.php');
                     } else {
                         $usuario->flash('danger', "Algo fallo");
                         $data = $usuario->get($id);
                         $data_rol = $usuario->getRol($id);
                         include('views/usuario/rol.php');
                     }
                     break;  
            case 'get':
                default:
                $usuario->validatePrivilegio('Consultar');
                $data = $usuario->get($id);
            include("views/usuario/index.php");       
}

include_once('views/footer.php');

?>