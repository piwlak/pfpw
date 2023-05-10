<div class="container">
		<div class="row-fluid">
        <h1><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Maestr@</h1>		
        	<form method="POST" action="maestro.php?action=<?php echo $action; ?>">
				<div class="col-lg-12">
					<br><br>
					<div class="row">
						<div class="col-lg-6">
						<div class="mb-3">
        					<label class="form-label">Nombre del Maestr@</label>
       						 <input type="text" name="data[nombre]" class="form-control" placeholder="Nombre" value="<?php echo isset($data[0]['nombre']) ? $data[0]['nombre'] : ''; ?>" required minlength="3" maxlength="50" />
       					</div>
    					<div class="mb-3">   
        					<label class="form-label">Primer Apellido</label>
       						 <input type="text" name="data[primer_apellido]" class="form-control" placeholder="apellido" value="<?php echo isset($data[0]['primer_apellido']) ? $data[0]['primer_apellido'] : ''; ?>" required minlength="3" maxlength="50" />
       					</div>
   						<div class="mb-3">
        					<label class="form-label">Segundo Apellido</label>
        					<input type="text" name="data[segundo_apellido]" class="form-control" placeholder="apellido" value="<?php echo isset($data[0]['segundo_apellido']) ? $data[0]['segundo_apellido'] : ''; ?>" required minlength="3" maxlength="50" />
        				</div>
    					<div class="mb-3">
        					<label class="form-label">Curp</label>
        					<input type="text" name="data[curp]" class="form-control" placeholder="curp" value="<?php echo isset($data[0]['curp']) ? $data[0]['curp'] : ''; ?>" required minlength="3" maxlength="18" />
        				</div>
    					<div class="mb-3">
        					<label class="form-label">rfc</label>
        					<input type="text" name="data[rfc]" class="form-control" placeholder="rfc" value="<?php echo isset($data[0]['rfc']) ? $data[0]['rfc'] : ''; ?>" required minlength="3" maxlength="13" />
        				</div>
    					<div class="mb-3">
        					<label class="form-label">Fecha Nacimiento</label>
        					<input type="date" name="data[nacimiento]" class="form-control" value="<?php echo isset($data[0]['nacimiento']) ? $data[0]['nacimiento'] : ''; ?>" required />
        				</div>
    					<div class="mb-3">
        					<label class="form-label">Usuario</label>
        					<select name="data[id_usuario]" class="form-control" required>
            					<?php
            						foreach ($datausuario as $key => $user) :
                					$selected = "";
                					if ($user['id_usuario'] == $data[0]['id_usuario']) :
                    					$selected = "selected";
                					endif;
            					?>
                				<option value="<?php echo $user['id_usuario']; ?>" <?php echo $selected; ?>><?php echo $user['correo']; ?> </option>
            					<?php endforeach; ?>
      		  				</select>
		  					</div>
						</div>
                        <div class="mb-3">
        <?php if ($action == 'edit') : ?>
            <input type="hidden" name="data[id_maestro]" value="<?php echo isset($data[0]['id_maestro']) ? $data[0]['id_maestro'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
					</div>
				</div>
			</form>
		</div>
	</div>


