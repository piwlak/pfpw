<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/materia.php');

$action = $_SERVER['REQUEST_METHOD'];
$id =  isset($_GET['id']) ?  $_GET['id'] : null;

switch($action){
    case 'DELETE':
        $data['mensaje']= 'No existe el materia.';
        if (!is_null($id)) {
            $contador = $materia->delete($id);
            if ($contador == 1) {
                $data['mensaje']= 'Se elimino el materia.';
            }
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $materia->new($data);
            if ($cantidad !=0) {
                $data['mensaje']='Se inserto el materia.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }else{
            $cantidad = $materia->edit($id, $data);
            if ($cantidad !=0) {
                $data['mensaje']='Se modifico el materia.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }
        
        break;
    case 'GET':
    default:
        if (is_null($id)) {
            $data = $materia->get();
        }else {
            $data = $materia->get($id);
        }
        break;
}
$data = json_encode($data);
echo ($data);
?>