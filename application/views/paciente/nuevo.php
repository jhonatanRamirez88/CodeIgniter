<section>
<h1><?php echo $title; ?></h1>		

	<form method="POST" action="<?php echo base_url(); ?>index.php/Paciente/crearPaciente">
		<div class="row uniform 50%">
			<div class="4u 12u$(xsmall)">
				Nombre: <input name="nom" type="text" required/>
			</div>
			<div class="4u 12u$(xsmall)">
				Apellido paterno:<input name="appat" type="text" required></input>
			</div>
			<div class="4u 12u$(xsmall)">	
				Apellido materno:<input name="apmat" type="text" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Telefono particular:<input name="telpar" type="tel" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Fecha de Nacimiento:<input name="fnac" type="date" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Direccion:<input name="dir" type="text" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				<select name="sex" required>
					<option value="true">Mujer</option>
					<option value="false">Hombre</option>
				</select>
			</div>

			<div class="12u 12u$(xsmall)">
				<ul class="actions">
					<li><input type="submit" value="Guardar" class="special" /></li>
					<li><input type="reset" value="Limpiar" /></li>
				</ul>		
			</div>
		</div>
	</form>
</section>