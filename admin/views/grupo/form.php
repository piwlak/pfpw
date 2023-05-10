<h1>
    <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Grupos
</h1>
<form method="POST" action="grupo.php?action=<?php echo $action; ?>">
    <div class="mb-3">
        <label class="form-label">Nombre del grupo</label>
        <input type="text" name="data[grupo]" class="form-control" placeholder="grupo" value="<?php echo isset($data[0]['grupo']) ? $data[0]['grupo'] : ''; ?>" required maxlength="50" />
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
    <label class="form-label">Maesrtro</label>

    <select name="data[id_maestro]" class="form-control" required>
            				<?php
            					foreach ($datamaestro as $key => $user) :
                				$selected = "";
                				if ($user['id_maestro'] == $data[0]['id_maestro']) :
                					$selected = "selected";
            					endif;
        					?>
            				<option value="<?php echo $user['id_maestro']; ?>" <?php echo $selected; ?>><?php echo $user['nombre']; ?> </option>            					<?php endforeach; ?>
      		  				</select>
    </div>
    <div class="mb-3">
        <?php if ($action == 'edit') : ?>
            <input type="hidden" name="data[id_grupo]" value="<?php echo isset($data[0]['id_grupo']) ? $data[0]['id_grupo'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
</form>
