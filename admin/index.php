<?php
//controladores
require_once(__DIR__.'/controllers/sistema.php');


//vistas
include("views/header.php");


$menu = $_SESSION['roles'];
switch ($menu[0]) {
    case 'Administrador':
        include("views/menu_director.php");
        break;
    case 'Director':
        include("views/menu_director.php");
        break;  
    case 'Maestro':
        include("views/menu_maestro.php");
        break;
    case 'Alumno':
        $sistema->validatePrivilegio('Consultar');
        $data=$sistema->getAlumnos($_SESSION['correo']);
        $datacalificacion = $sistema->getCal($_SESSION['correo']);
        include("views/menu_alumno.php");
        break;    
}

include("views/footer.php");
?>