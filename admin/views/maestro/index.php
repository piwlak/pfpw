<h1>Maestros</h1>
<a href="maestro.php?action=new" class="btn btn-success"> Nuevo maestr@ </a>
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
            <th scope="col" class="col-md-2">Opciones</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $maestro) : ?>
            <?php 
            ?>
            <tr>
                <th scope="row"><?php echo $maestro['id_maestro']; ?></th>
                <td><?php echo $maestro['nombre']; ?></td>
                <td><?php echo $maestro['primer_apellido']; ?></td>
                <td><?php echo $maestro['segundo_apellido']; ?></td>
                <td><?php echo $maestro['rfc']; ?></td>
                <td><?php echo $maestro['curp']; ?></td>
                <td><?php echo $maestro['nacimiento']; ?></td>
                <td><?php echo $maestro['correo']; ?></td>

                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-primary" href="maestro.php?action=edit&id=<?php echo $maestro['id_maestro'] ?>">Modificar</a>
                        <a class="btn btn-danger" href="maestro.php?action=delete&id=<?php echo $maestro['id_maestro'] ?>">Eliminar</a>
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
