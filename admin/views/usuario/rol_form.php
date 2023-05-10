<h1 class="text-center"> <?php echo ($action == 'editRol') ? 'Modificar ' : 'Nuevo ' ?> rol del Usuario:
    <?php echo $data[0]['correo']; ?></h1>
<form method="POST" action="usuario.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_usuario']) ?>">
    <div class="mb-3">
    <label class="form-label">Rol</label>
        <select name="data[id_rol]" class="form-control" required>
            <?php
            foreach ($data_rol as $key => $roles) :
                $selected = "";
                if ($roles['id_rol'] == $data[0]['id_rol']) :
                    $selected = " selected";
                endif;
            ?>
                <option value="<?php echo $roles['id_rol']; ?>" <?php echo $selected; ?>><?php echo $roles['rol']; ?> </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <input type="hidden" name="data[id_usuario]" value="<?php echo ($data[0]['id_usuario']) ?>">
        <?php if ($action == 'editRol') : ?>
            <input type="hidden" name="data[id_rol]" value="<?php echo isset($data_rol[0]['id_rol']) ? $data_rol[0]['id_rol'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
</form>
