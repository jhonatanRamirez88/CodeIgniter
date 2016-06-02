<section>
<h1></h1>		
	<form method="POST" action="<?php echo base_url(); ?>index.php/Paciente/doUpdateParaDoctorMenu">
		<div class="row uniform 50%">
			<input type="hidden" name="oculto" value="<?php echo $paciente['cve_usu']; ?>">
			<div class="4u 12u$(xsmall)">
				Nombre: <input name="nom" type="text" value="<?php echo $paciente['nom'];  ?>" required/>
			</div>
			<div class="4u 12u$(xsmall)">
				Apellido paterno:<input name="appat" type="text" value="<?php echo $paciente['pat']; ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">	
				Apellido materno:<input name="apmat" type="text" value="<?php echo $paciente['mat']; ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">	
				Telefono particular:<input name="telpar" type="tel" value="<?php echo $paciente['telpar']; ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Fecha de Nacimiento:<input name="fnac" type="date" value="<?php echo $paciente['nac']; ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Direccion:<input name="dir" type="text" value="<?php echo $paciente['dir']; ?>" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
			Selecciones sexo:
				<select name="sex" required>
					<option value="true">Mujer</option>
					<option value="false">Hombre</option>
				</select>
			</div>

			<div class="12u 12u$(xsmall)">
				<ul class="actions">
					<li><input type="submit" value="Guardar" class="button alt fit" /></li>
					<li><input type="reset" value="Limpiar" class="button alt fit" /></li>
				</ul>		
			</div>
		</div>
	</form>
	<div class="12u 12u(medium) 12u$(small)">
		<ul class="actions vertical">
			<li><a href="<?php echo base_url(); ?>index.php/Historial/nuevo_historial/<?php echo $paciente['cve_usu']?>" class="button fit">Agregar Nuevo diagnostico</a></li>
		</ul>
	</div>
	<section>
		<div class="table-wrapper">
			<table>
				<thead>
					<tr>	
						<th>#</th>
						<th>Fecha</th>
						<th>Diagnostico</th>
						<th>Descripción</th>
						<th>Observaciones</th>
						<th>Actualizar</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$indice = 0;
						foreach ($historial as $item ): 
						?>
						<tr id="">
							<td><?php echo $indice+=1; ?></td>
							<td id=""><?php echo $item['fecha']; ?></td>
							<td id=""><?php echo $item['diag']; ?></td>
							<td id=""><?php echo $item['desc']; ?></td>
							<td id=""><?php echo $item['obs']; ?></td>
							<td id="">
								<input value="Actualizar" onclick="cambiar(<?php echo $item['cvediag']; ?>)" type="button" />
							</td>
						</tr>	
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</section>	
</section>

<script type="text/javascript">
	function cambiar(cita){
	    location.href="<?php echo base_url();?>index.php/Historial/uphisto/"+cita;
	}
</script>