<h1>Privilegios de <?php echo $data[0]['rol']; ?></h1>
<a href="rol.php?action=newPrivilegio&&id=<?php echo $data[0]['id_rol']; ?>" class="btn btn-success"> Nuevo </a>
<table class="table" >
    <thead>
        <tr>
            <th scope="col" class="col-md-2">Id</th>
            <th scope="col" class="col-md-6">Rol</th>
            <th scope="col" class="col-md-6">Privilegio</th>
            <th scope="col" class="col-md-4">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_privilegio as $key => $privilegio) : ?>
            <?php 
            ?>
            <tr>
                <th scope="row"><?php echo $privilegio['id_privilegio']; ?></th>
                <td><?php echo $privilegio['rol']; ?></td>
                <td><?php echo $privilegio['privilegio']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-danger" href="rol.php?action=deletePrivilegio&id=<?php echo $data['0']['id_rol'] ?>&id_privilegio=<?php echo $privilegio['id_privilegio']; ?>">Eliminar</a>
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
