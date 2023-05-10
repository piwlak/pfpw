<div class="container">
		<div class="row-fluid">
        <h1><?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Alumno</h1>		
        	<form method="POST" action="alumno.php?action=<?php echo $action; ?>">
				<div class="col-lg-12">
					<br><br>
					<div class="row">
						<div class="col-lg-6">
						<div class="mb-3">
        					<label class="form-label">Nombre del Alumno</label>
       						 <input type="text" name="data[nombre_alumno]" class="form-control" placeholder="Nombre" value="<?php echo isset($data[0]['nombre_alumno']) ? $data[0]['nombre_alumno'] : ''; ?>" required minlength="3" maxlength="50" />
       					</div>
    					<div class="mb-3">   
        					<label class="form-label">Primer Apellido</label>
       						 <input type="text" name="data[primer_apellido_alumno]" class="form-control" placeholder="apellido" value="<?php echo isset($data[0]['primer_apellido_alumno']) ? $data[0]['primer_apellido_alumno'] : ''; ?>" required minlength="3" maxlength="50" />
       					</div>
   						<div class="mb-3">
        					<label class="form-label">Segundo Apellido</label>
        					<input type="text" name="data[segundo_apellido_alumno]" class="form-control" placeholder="apellido" value="<?php echo isset($data[0]['segundo_apellido_alumno']) ? $data[0]['segundo_apellido_alumno'] : ''; ?>" required minlength="3" maxlength="50" />
        				</div>
    					<div class="mb-3">
        					<label class="form-label">Curp</label>
        					<input type="text" name="data[curp_alumno]" class="form-control" placeholder="curp" value="<?php echo isset($data[0]['curp_alumno']) ? $data[0]['curp_alumno'] : ''; ?>" required minlength="3" maxlength="18" />
        				</div>
    					<div class="mb-3">
        					<label class="form-label">Fecha Nacimiento</label>
        					<input type="date" name="data[nacimiento_alumno]" class="form-control" value="<?php echo isset($data[0]['nacimiento_alumno']) ? $data[0]['nacimiento_alumno'] : ''; ?>" required />
        				</div>
						<div class="mb-3">
        					<label class="form-label">Inscrito  </label>
							<select name="data[id_status]" class="form-control" required>
            					<?php
            						foreach ($datastatus as $key => $user) :
                					$selected = "";
                					if ($user['id_status'] == $data[0]['id_status']) :
                    					$selected = "selected";
                					endif;
            					?>
                				<option value="<?php echo $user['id_status']; ?>" <?php echo $selected; ?>><?php echo $user['status']; ?> </option>
            					<?php endforeach; ?>
      		  				</select>        				</div>
    					<div class="mb-3">
        					<label class="form-label">Tutor</label>
        					<select name="data[id_tutor]" class="form-control" required>
            					<?php
            						foreach ($datatutor as $key => $user) :
                					$selected = "";
                					if ($user['id_tutor'] == $data[0]['id_tutor']) :
                    					$selected = "selected";
                					endif;
            					?>
                				<option value="<?php echo $user['id_tutor']; ?>" <?php echo $selected; ?>><?php echo $user['nombre']; ?> </option>
            					<?php endforeach; ?>
      		  				</select>
						</div>
						<div class="mb-3">
        					<label class="form-label">Calle</label>
							<input type="text" name="data[calle]" class="form-control" value="<?php echo isset($data[0]['calle']) ? $data[0]['calle'] : ''; ?>" required />
                                <label class="form-label">Localidad</label>
                                <select name="data[id_localidad]" class="form-control" required>
            					<?php
            						foreach ($datalocalidad as $key => $loc) :
                					$selected = "";
                					if ($loc['id_localidad'] == $data[0]['id_localidad']) :
                    					$selected = "selected";
                					endif;
            					?>
                				<option value="<?php echo $loc['id_localidad']; ?>" <?php echo $selected; ?>><?php echo $loc['localidad']; ?> </option>
            					<?php endforeach; ?>
      		  				</select>
        				</div>
                        <div class="mb-3">
        <?php if ($action == 'edit') : ?>
            <input type="hidden" name="data[id_alumno]" value="<?php echo isset($data[0]['id_alumno']) ? $data[0]['id_alumno'] : ''; ?>">
        <?php endif; ?>
        <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
					</div>
				</div>
			</form>
		</div>
	</div>


