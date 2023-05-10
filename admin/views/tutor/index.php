<h1>Tutor</h1>
<a href="tutor.php?action=new" class="btn btn-success"> Nuevo Tutor@ </a>
<table class="table" >
    <thead>
        <tr>
            <th scope="col" class="col-md-1">Id</th>
            <th scope="col" class="col-md-1">Nombre</th>
            <th scope="col" class="col-md-1">Primer Apellido</th>
            <th scope="col" class="col-md-1">Segundo Apellido</th>
            <th scope="col" class="col-md-1">RFC</th>
            <th scope="col" class="col-md-2">CRUP</th>
            <th scope="col" class="col-md-1">Fecha de Nacimiento</th>
            <th scope="col" class="col-md-2">Usuario</th>
            <th scope="col" class="col-md-1">Rol</th>
            <th scope="col" class="col-md-2">Opciones</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $tutor) : ?>
            <?php 
            ?>
            <tr>
                <th scope="row"><?php echo $tutor['id_tutor']; ?></th>
                <td><?php echo $tutor['nombre']; ?></td>
                <td><?php echo $tutor['primer_apellido']; ?></td>
                <td><?php echo $tutor['segundo_apellido']; ?></td>
                <td><?php echo $tutor['rfc']; ?></td>
                <td><?php echo $tutor['curp']; ?></td>
                <td><?php echo $tutor['nacimiento']; ?></td>
                <td><?php echo $tutor['correo']; ?></td>
                <td><?php echo $tutor['rol_tutor']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-primary" href="tutor.php?action=edit&id=<?php echo $tutor['id_tutor'] ?>">Modificar</a>
                        <a class="btn btn-danger" href="tutor.php?action=delete&id=<?php echo $tutor['id_tutor'] ?>">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col">Se encontraron <?php echo sizeof($data); ?> registros.</th>
    </tr>
</table>
