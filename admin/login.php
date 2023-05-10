<?php
include("controllers/sistema.php");
include("views/header.php");
$action = (isset($_GET['action'])) ? $_GET['action'] : 'login';
switch ($action) {
    case 'logout':
        $sistema ->logout();
        include("views/login/index.php");
        break;
    case 'forgot':
        include("views/login/forgot.php");
        break;
    case 'recovery':
        $data = $_GET;
        if(isset($data['correo']) and isset($data['token'])){
            if($sistema->validateToken($data['correo'],$data['token'])){
                //die('OK');
                include_once('views/login/recovery.php');
            }else{
                $sistema->flash('danger', 'el Token expiró');
                include_once('views/login/index.php');
            }
        } else{
            $sistema->flash('danger','URL no puede ser completada como la requirio');
            include_once('views/login/index.php');
        }
        //die('error');
        break;
    case 'reset':
        $data = $_POST;
           if(isset($data['correo']) and isset($data['token']) and isset($data['contrasena'])){
               if($sistema->validateToken($data['correo'],$data['token'])){
                   if($sistema->resetPassword($data['correo'],$data['token'],$data['contrasena'])){
                        $sistema->flash('success', 'Contrasenia actualizada con exito');
                        include_once('views/login/index.php');
                   } else{
                        $sistema->flash('warning', 'Contacta a soporte técnico o reinicia el proceso 
                        especificando su correo electrónico');
                        include_once('views/login/forgot.php');
                   }
               }else{
                   $sistema->flash('danger', 'el Token expiró');
                   include_once('views/login/index.php');
               }
           } else{
               $sistema->flash('danger','URL no puede ser completada como la requirio');
               include_once('views/login/index.php');
           }
    break;
    case 'send':
        if(isset($_POST['enviar'])){
            $correo=$_POST['correo'];
            $cantidad=$sistema->loginSend($correo);
            if ($cantidad) {
                $sistema->flash('success', "Sí hay una cuenta asociada a este correo se le enviara un correo de reestablecimiento");               include('views/login/index.php');
            } else {
                $sistema->flash('warning', "Sí hay una cuenta asociada a este correo se le enviara un correo de reestablecimiento");
                include('views/login/index.php');
            }
        }           
        break;
    case 'login':
        default:
        if(isset($_POST['enviar'])){
            $data = $_POST;
            if($sistema ->login($data['correo'],$data['contrasena'])){
                header("Location: index.php");
            }
        }
        include("views/login/index.php");
        break;
}
include("views/footer.php");
