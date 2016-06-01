<section>
<h1>Modificar datos del paciente.</h1>		
	<form method="POST" action="<?php echo base_url(); ?>index.php/Paciente/doUpdate">
		<div class="row uniform 50%">
			<input type="hidden" name="oculto" value="<?php echo $data['cve_usu'] ?>">
			<div class="4u 12u$(xsmall)">
				Nombre: <input name="nom" type="text" value="<?php echo $data['nom'] ?>" required/>
			</div>
			<div class="4u 12u$(xsmall)">
				Apellido paterno:<input name="appat" type="text" value="<?php echo $data['pat'] ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">	
				Apellido materno:<input name="apmat" type="text" value="<?php echo $data['mat'] ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Telefono particular:<input name="telpar" type="tel" value="<?php echo $data['telpar'] ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Fecha de Nacimiento:<input name="fnac" type="date" value="<?php echo $data['nac'] ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Direccion:<input name="dir" type="text" value="<?php echo $data['dir'] ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				<select name="sex" required>
					<option value="">Elije un valor.</option>
					<option value="t">Mujer</option>
					<option value="f">Hombre</option>
				</select>
			</div>

			<div class="12u 12u$(xsmall)">
				<ul class="actions">
					<li><input type="submit" value="Guardar" class="special" /></li>
					<li><input type="reset" value="Limpiar"/></li>
				</ul>		
			</div>
		</div>
	</form>
</section>