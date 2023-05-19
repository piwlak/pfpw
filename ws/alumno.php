<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/alumno.php');

$action = $_SERVER['REQUEST_METHOD'];
$id =  isset($_GET['id']) ?  $_GET['id'] : null;

switch($action){
    case 'DELETE':
        $data['mensaje']= 'No existe el alumno.';
        if (!is_null($id)) {
            $contador = $alumno->delete($id);
            if ($contador == 1) {
                $data['mensaje']= 'Se elimino el alumno.';
            }
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $alumno->new($data);
            if ($cantidad !=0) {
                $data['mensaje']='Se inserto el alumno.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }else{
            $cantidad = $alumno->edit($id, $data);
            if ($cantidad !=0) {
                $data['mensaje']='Se modifico el alumno.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }
        
        break;
    case 'GET':
    default:
        if (is_null($id)) {
            $data = $alumno->get();
        }else {
            $data = $alumno->get($id);
        }
        break;
}
$data = json_encode($data);
echo ($data);
?>