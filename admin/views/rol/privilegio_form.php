<h1 class="text-center"> <?php echo ($action == 'editprivilegio') ? 'Modificar ' : 'Nuevo ' ?> Privilegios del Rol:
    <?php echo $data[0]['rol']; ?></h1>
<form method="POST" action="rol.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_rol']) ?>">
    <div class="mb-3">
    <label class="form-label">Privilegio</label>
        <select name="data[id_privilegio]" class="form-control" required>
            <?php
            foreach ($data_privilegio as $key => $priv) :
                $selected = "";
                if ($priv['id_privilegio'] == $data[0]['id_privilegio']) :
                    $selected = " selected";
                endif;
            ?>
                <option value="<?php echo $priv['id_privilegio']; ?>" <?php echo $selected; ?>><?php echo $priv['privilegio']; ?> </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <input type="hidden" name="data[id_rol]" value="<?php echo ($data[0]['id_rol']) ?>">
        <?php if ($action == 'editprivilegio') : ?>
            <input type="hidden" name="data[id_privilegio]" value="<?php echo isset($data_privilegio[0]['id_privilegio']) ? $data_privilegio[0]['id_privilegio'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
</form>
