<h1 class="text-center"> <?php echo ($action == 'editGrupo') ? 'Modificar ' : 'Asignar ' ?>Grupo del Alumno:
    <?php echo $data[0]['nombre_alumno']; ?></h1>
<form method="POST" action="alumno.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_alumno']) ?>">
    <div class="mb-3">
    <label class="form-label">Grupo</label>
        <select name="data[id_grupo]" class="form-control" required>
            <?php
            foreach ($data_grupo as $key => $grupos) :
                $selected = "";
                if ($grupos['id_grupo'] == $data[0]['id_grupo']) :
                    $selected = " selected";
                endif;
            ?>
                <option value="<?php echo $grupos['id_grupo']; ?>" <?php echo $selected; ?>><?php echo $grupos['grupo']; ?> </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <input type="hidden" name="data[id_alumno]" value="<?php echo ($data[0]['id_alumno']) ?>">
        <?php if ($action == 'editGrupo') : ?>
            <input type="hidden" name="data[id_grupo]" value="<?php echo isset($data_grupo[0]['id_grupo']) ? $data_grupo[0]['id_grupo'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
</form>
