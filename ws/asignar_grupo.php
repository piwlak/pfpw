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
            $contador = $alumno->deleteGrupo($id);
            if ($contador == 1) {
                $data['mensaje']= 'Se elimino el alumno.';
            }
        }
        break;
    case 'POST':
        $data = array();
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);        if (is_null($id)) {
            $data['mensaje']='Ocurrio un error';
        }else{
            $cantidad = $alumno->newGrupo($data,$id);
            if ($cantidad !=0) {
                $data['mensaje']='Se modifico el grupo.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }
        
        break;
    case 'GET':
    default:
        if (is_null($id)) {
            $data['mensaje']='Ocurrio un error';
        }else {
            $data = $alumno->getGrupo($id);
        }
        break;
}
$data = json_encode($data);
echo ($data);
?>