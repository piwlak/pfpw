<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/tutor.php');

$action = $_SERVER['REQUEST_METHOD'];
$id =  isset($_GET['id']) ?  $_GET['id'] : null;

switch($action){
    case 'DELETE':
        $data['mensaje']= 'No existe el tutor.';
        if (!is_null($id)) {
            $contador = $tutor->delete($id);
            if ($contador == 1) {
                $data['mensaje']= 'Se elimino el tutor.';
            }
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $tutor->new($data);
            if ($cantidad !=0) {
                $data['mensaje']='Se inserto el tutor.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }else{
            $cantidad = $tutor->edit($id, $data);
            if ($cantidad !=0) {
                $data['mensaje']='Se modifico el tutor.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }
        
        break;
    case 'GET':
    default:
        if (is_null($id)) {
            $data = $tutor->get();
        }else {
            $data = $tutor->get($id);
        }
        break;
}
$data = json_encode($data);
echo ($data);
?>