<h1>Materia</h1>
<a href="materia.php?action=new" class="btn btn-success"> Nueva Materia </a>
<table class="table" >
    <thead>
        <tr>
            <th scope="col" class="col-md-2">Id</th>
            <th scope="col" class="col-md-3">Materia</th>
            <th scope="col" class="col-md-3">Grado</th>
            <th scope="col" class="col-md-3">Nivel</th>
            <th scope="col" class="col-md-4">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $key => $materia) : ?>
            <?php 
            ?>
            <tr>
                <th scope="row"><?php echo $materia['id_materia']; ?></th>
                <td><?php echo $materia['materia']; ?></td>
                <td><?php echo $materia['grado']; ?></td>
                <td><?php echo $materia['nivel']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-primary" href="materia.php?action=edit&id=<?php echo $materia['id_materia'] ?>">Modificar</a>
                        <a class="btn btn-danger" href="materia.php?action=delete&id=<?php echo $materia['id_materia'] ?>">Eliminar</a>
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