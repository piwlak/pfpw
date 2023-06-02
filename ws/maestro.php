<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/maestro.php');

$action = $_SERVER['REQUEST_METHOD'];
$id =  isset($_GET['id']) ?  $_GET['id'] : null;

switch($action){
    case 'DELETE':
        $data['mensaje']= 'No existe el maestro.';
        if (!is_null($id)) {
            $contador = $maestro->delete($id);
            if ($contador == 1) {
                $data['mensaje']= 'Se elimino el maestro.';
            }
        }
        break;
    case 'POST':
        $data = array();
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);             
          if (is_null($id)) {
            $cantidad = $maestro->new($data);
            if ($cantidad !=0) {
                $data['mensaje']='Se inserto el maestro.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }else{
            $cantidad = $maestro->edit($id, $data);
            if ($cantidad !=0) {
                $data['mensaje']='Se modifico el maestro.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }
        
        break;
    case 'GET':
    default:
        if (is_null($id)) {
            $data = $maestro->get();
        }else {
            $data = $maestro->get($id);
        }
        break;
}
$data = json_encode($data);
echo ($data);
?>