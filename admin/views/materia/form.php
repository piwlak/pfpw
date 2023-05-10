<h1>
    <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Materias
</h1>
<form method="POST" action="materia.php?action=<?php echo $action; ?>">
    <div class="mb-3">
        <label class="form-label">Nombre del materia</label>
        <input type="text" name="data[materia]" class="form-control" placeholder="materia" value="<?php echo isset($data[0]['materia']) ? $data[0]['materia'] : ''; ?>" required minlength="3" maxlength="50" />
        <label class="form-label">Grado</label>
        <select name="data[id_grado]" class="form-control" required>
        <optgroup label="Preescolar">
        <?php
        foreach ($datagrado1 as $key => $grad) :
           $selected = "";
           if ($grad['id_grado'] == $data[0]['id_grado']) :
               $selected = "selected";
           endif;
        ?>
        <option value="<?php echo $grad['id_grado']; ?>" <?php echo $selected; ?>><?php echo $grad['grado']; ?> </option>
        <?php endforeach; ?>
        </optgroup>
        <optgroup label="Primaria">
        <?php
        foreach ($datagrado2 as $key => $grad) :
           $selected = "";
           if ($grad['id_grado'] == $data[0]['id_grado']) :
               $selected = "selected";
           endif;
        ?>
        <option value="<?php echo $grad['id_grado']; ?>" <?php echo $selected; ?>><?php echo $grad['grado']; ?> </option>
        <?php endforeach; ?>
        </optgroup>
        <optgroup label="Secundaria">
        <?php
        foreach ($datagrado3 as $key => $grad) :
           $selected = "";
           if ($grad['id_grado'] == $data[0]['id_grado']) :
               $selected = "selected";
           endif;
        ?>
        <option value="<?php echo $grad['id_grado']; ?>" <?php echo $selected; ?>><?php echo $grad['grado']; ?> </option>
        <?php endforeach; ?>
        </optgroup>
        </select>
    </div>
    <div class="mb-3">
        <?php if ($action == 'edit') : ?>
            <input type="hidden" name="data[id_materia]" value="<?php echo isset($data[0]['id_materia']) ? $data[0]['id_materia'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
</form>
