<h1>Calificaciones de <?php echo $data[0]['nombre_alumno']; ?></h1>
<form method="POST" action="alumno.php?action=guardar">

<table class="table" >
    <thead>
        <tr>
            <th scope="col" class="col-md-1">Id del alumno</th>
            <th scope="col" class="col-md-1">Materia </th>
            <th scope="col" class="col-md-1">Primer Periodo</th>
            <th scope="col" class="col-md-1">Segundo Periodo</th>
            <th scope="col" class="col-md-1">Tercer Periodo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datacalificacion as $key => $calificacion) : ?>
            <?php 
            ?>
            <tr>
                <th scope="row"><?php echo $calificacion['id_alumno']; ?></th>
                <td><?php echo $calificacion['materia']; ?></td>
                <td><input type="text" name="calificacion[periodo_1]" class="form-control" value="<?php echo isset($calificacion['periodo_1']) ? $calificacion['periodo_1'] : ''; ?>"></td>
                <td><input type="text" name="calificacion[periodo_2]" class="form-control" value="<?php echo isset($calificacion['periodo_2']) ? $calificacion['periodo_2'] : ''; ?>"></td>
                <td><input type="text" name="calificacion[periodo_3]" class="form-control" value="<?php echo isset($calificacion['periodo_3']) ? $calificacion['periodo_3'] : ''; ?>"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <input type="hidden" name="data[id_alumno]" value="<?php echo isset($data[0]['id_alumno']) ? $data[0]['id_alumno'] : ''; ?>">                
    <input type="submit" name="enviar" value="Guardar" class="btn btn-info" />
    <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>

        <th scope="col">Se encontraron <?php echo sizeof($data); ?> Alumnos Registrados.</th>
    </tr>
</table>
</form>


