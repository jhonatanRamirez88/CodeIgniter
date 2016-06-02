<section>
<h1></h1>		
	<form method="POST" action="">
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
	<div class="12u 12u(medium) 12u$(small)">
		<ul class="actions vertical">
			<li><a href="#" class="button fit">Agregar diagnostico</a></li>
		</ul>
	</div>
	<section>
		<div class="table-wrapper">
			<table>
				<thead>
					<tr>	
						<th>#</th>
						<th>N</th>
						<th>A</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$indice = 0;
						foreach ($data as $item ): 
						?>
						<tr id="row<?php echo $item['cve_usu']; ?>">
							<td><?php echo $indice+=1; ?></td>
							<td id=""><?php echo $item['nom']; ?></td>
							<td id=""><?php echo $item['pat']; ?></td>
							<td id=""><?php echo $item['telpar']; ?></td>
							<td id="">
								<input value="Actualizar" onclick="alertUpdate(<?php echo $item['cve_usu']; ?>)" type="button" />
							</td>
						</tr>	
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</section>	
</section>

<script type="text/javascript">
	
</script>