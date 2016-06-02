<section>
<h1><?php echo $title; ?></h1>		

	<form method="POST" action="">
		<div class="row uniform 50%">
			<input type="hidden" name="oculto" value="<?php echo $paciente['cve_usu']; ?>">
			<div class="4u 12u$(xsmall)">
				Nombre: <input name="nom" type="text" value="<?php echo $paciente['nom'];  ?>" required/>
			</div>
			<div class="4u 12u$(xsmall)">
				Apellido paterno:<input name="appat" type="text" required><?php echo $paciente['pat'];  ?></input>
			</div>
			<div class="4u 12u$(xsmall)">	
				Apellido materno:<input name="apmat" type="text" required><?php echo $paciente['mat'];  ?></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Telefono particular:<input name="telpar" type="tel" required><?php echo $paciente['telpar'];  ?></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Fecha de Nacimiento:<input name="fnac" type="date" required><?php echo $paciente['nac'];  ?></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Direccion:<input name="dir" type="text" required><?php echo $paciente['dir'];  ?></input>
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