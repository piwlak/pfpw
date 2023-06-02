<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/materia.php');

$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($action) {
    case 'POST':
        $data = array();
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if (is_null($id)) {
            $cantidad = $materia->new($data);
            if ($cantidad != 0) {
                $data['mensaje'] = 'Se insertó el materia.';
            } else {
                $data['mensaje'] = 'Ocurrió un error.';
            }
        } else {
            $cantidad = $materia->edit($id, $data);
            if ($cantidad != 0) {
                $data['mensaje'] = 'Se modificó el materia.';
            } else {
                $data['mensaje'] = 'Ocurrió un error.';
            }
        }
        break;
    case 'DELETE':
        if (!is_null($id)) {
            $cantidad = $materia->delete($id);
            if ($cantidad == 1) {
                $data['mensaje'] = 'Se eliminó el materia.';
            }
        }
        break;
    case 'GET':
    default:
        if (is_null($id)) {
            $data = $materia->get();
        } else {
            $data = $materia->get($id);
        }
        break;
}

$data = json_encode($data);
echo ($data);
?>
