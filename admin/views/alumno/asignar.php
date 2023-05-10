<h1 ><a href="alumno.php?action=asignar&id=<?php echo $data[0]['id_alumno'] ?>">Asignar grupo a <?php echo $data[0]['nombre_alumno']; ?></a></h1>
<a href="alumno.php?action=get" class="btn btn-success"> Regresar  </a>
<a href="alumno.php?action=newGrupo&&id=<?php echo $data[0]['id_alumno']; ?>" class="btn btn-success"> Nuevo </a>
<table class="table" >
    <thead>
        <tr>
            <th scope="col" class="col-md-6">Alumno</th>
            <th scope="col" class="col-md-6">Grupo</th>
            <th scope="col" class="col-md-4">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_grupo as $key => $grupo) : ?>
            <?php 
            ?>
            <tr>
                <td><?php echo $grupo['nombre_alumno']; ?></td>
                <td><?php echo $grupo['grupo']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-danger" href="alumno.php?action=deleteGrupo&id=<?php echo $data['0']['id_alumno'] ?>&id_grupo=<?php echo $grupo['id_grupo']; ?>">Eliminar</a>
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
