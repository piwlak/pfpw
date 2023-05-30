<h1>Grupo</h1>
<a href="grupo.php?action=new" class="btn btn-success"> Nuevo Grupo </a>
<br>
<h2>Se encontraron <?php echo sizeof($data); ?> Grupos.</h2>
<table class="table" >
    <thead>
        <tr>
            <th scope="col" class="col-md-2">Id</th>
            <th scope="col" class="col-md-2">Grado</th>
            <th scope="col" class="col-md-2">Nivel</th>
            <th scope="col" class="col-md-2">Grupo</th>
            <th scope="col" class="col-md-2">Maestro</th>
            <th scope="col" class="col-md-2">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $grupo) : ?>
            <tr>
                <th scope="row"><?php echo $grupo['id_grupo']; ?></th>
                <td><?php echo $grupo['grado']; ?></td>
                <td><?php echo $grupo['nivel']; ?></td>
                <td><?php echo $grupo['grupo']; ?></td>
                <td><?php echo $grupo['nombre']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-primary" href="grupo.php?action=edit&id=<?php echo $grupo['id_grupo'] ?>">Modificar</a>
                        <a class="btn btn-danger" href="grupo.php?action=delete&id=<?php echo $grupo['id_grupo'] ?>">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>