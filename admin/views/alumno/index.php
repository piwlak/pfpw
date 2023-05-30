<h1><a href="alumno.php?action=get"> Alumno  </a></h1>
<a href="alumno.php?action=new" class="btn btn-success"> Nuevo alumn@ </a>
<table class="table" >
    <thead>
        <tr>
            <th scope="col" class="col-md-1">Nombre</th>
            <th scope="col" class="col-md-1">Primer Apellido</th>
            <th scope="col" class="col-md-1">Segundo Apellido</th>
            <th scope="col" class="col-md-1">CRUP</th>
            <th scope="col" class="col-md-1">Fecha de Nacimiento</th>
            <th scope="col" class="col-md-1">Inscrito</th>
            <th scope="col" class="col-md-1">Tutor 1</th>
            <th scope="col" class="col-md-1">Localidad</th>
            <th scope="col" class="col-md-3">Opciones</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $alumno) : ?>
            <tr>
                <td><?php echo $alumno['nombre_alumno']; ?></td>
                <td><?php echo $alumno['primer_apellido_alumno']; ?></td>
                <td><?php echo $alumno['segundo_apellido_alumno']; ?></td>
                <td><?php echo $alumno['curp_alumno']; ?></td>
                <td><?php echo $alumno['nacimiento_alumno']; ?></td>
                <td><?php echo $alumno['status']; ?></td>
                <td><?php echo $alumno['nombre']; ?></td>
                <td><?php echo $alumno['localidad']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-warning" href="alumno.php?action=getCalificacion&id=<?php echo $alumno['id_alumno'] ?>">Calificaciones</a>
                        <a class="btn btn-info" href="alumno.php?action=asignar&id=<?php echo $alumno['id_alumno'] ?>">Grupo</a>
                        <a class="btn btn-dark" href="constancia.php?action=alumno&id=<?php echo $alumno['id_alumno'] ?>">Constancia</a>
                        <a class="btn btn-primary" href="alumno.php?action=edit&id=<?php echo $alumno['id_alumno'] ?>">Modificar</a>
                        <a class="btn btn-danger" href="alumno.php?action=delete&id=<?php echo $alumno['id_alumno'] ?>">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>

        <th scope="col">Se encontraron <?php echo sizeof($data); ?> Alumnos Registrados.</th>
    </tr>
</table>
