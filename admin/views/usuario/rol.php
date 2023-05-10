<h1>Roles de <?php echo $data[0]['correo']; ?></h1>
<a href="usuario.php?action=newRol&&id=<?php echo $data[0]['id_usuario']; ?>" class="btn btn-success"> Nuevo </a>
<table class="table" >
    <thead>
        <tr>
            <th scope="col" class="col-md-2">Id</th>
            <th scope="col" class="col-md-6">Usuario</th>
            <th scope="col" class="col-md-6">Rol</th>
            <th scope="col" class="col-md-4">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_rol as $key => $rol) : ?>
            <?php 
            ?>
            <tr>
                <th scope="row"><?php echo $rol['id_rol']; ?></th>
                <td><?php echo $rol['correo']; ?></td>
                <td><?php echo $rol['rol']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-danger" href="usuario.php?action=deleteRol&id=<?php echo $data['0']['id_usuario'] ?>&id_rol=<?php echo $rol['id_rol']; ?>">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col">Se encontraron <?php echo sizeof($data); ?> registros.</th>
    </tr>
</table>
