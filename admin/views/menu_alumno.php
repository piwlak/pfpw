<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Sistema Escolar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">              
                <li class="nav-item">
                    <a class="nav-link" href="login.php?action=logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php 
foreach ($data as $key => $alumno) : ?>
<h1>Calificaciones de <?php echo $data[$key]['nombre_alumno']; ?></h1>
<table class="table">
        <thead>
            <tr>
                <th scope="col" class="col-md-1">Materia </th>
                <th scope="col" class="col-md-1">Primer Periodo</th>
                <th scope="col" class="col-md-1">Segundo Periodo</th>
                <th scope="col" class="col-md-1">Tercer Periodo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datacalificacion as $key1 => $calificacion) {
    if ($calificacion['nombre_alumno'] == $data[$key]['nombre_alumno']) { ?>
                <tr>
                    <td><?php echo $calificacion['materia']; ?></td>
                    <td><?php echo $calificacion['periodo_1']; ?></td>
                    <td><?php echo $calificacion['periodo_2']; ?></td>
                    <td><?php echo $calificacion['periodo_3']; ?></td>
                </tr>
                <?php
    }
}
?>
        </tbody>
        </table>
<?php endforeach; ?>