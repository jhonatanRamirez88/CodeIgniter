<section>
<h1><?php echo $title; ?></h1>		

<form method="POST" action="<?php echo base_url(); ?>index.php/Doctor/recibirVerNuevo">
	<div class="row uniform 50%">
		<div class="4u 12u$(xsmall)">
			Nombre: <input name="nom" type="text"/>
		</div>
		<div class="4u 12u$(xsmall)">
			Apellido paterno:<input name="appat" type="text"></input>
		</div>
		<div class="4u 12u$(xsmall)">
			Apellido materno:<input name="apmat" type="text"></input>
		</div>
		<div class="4u 12u$(xsmall)">
			Telefono particular:<input name="telpar" type="text"></input>
		</div>
		<div class="4u 12u$(xsmall)">
			Telefono movil:<input name="telmov" type="text"></input>
		</div>
		<div class="4u 12u$(xsmall)">
			Especialidad:
			<div class="select-wrapper">
				<select name="esp"> 
					<?php foreach ($pollo as $item ): ?>
						<?php echo "<option value='".$item['cve']."'>".$item['descripcion']."</option>"; ?>
					<?php endforeach; ?>
				</select>
			</div>
		</div>	

		<!-- trabajando con los horarios -->
		<div class="12u 12u$(xsmall)">
			<h4>Horarios de atención:</h4>
		</div>


		<div class="12u 12u$(xsmall)">
			<div class="table-wrapper">
				<table>
					<tbody>
						<?php foreach ($dias as $dia): ?>
							<tr>
								<td><?php echo $dia['descripcion']?></td>
								<td><input name="ini_<?php echo $dia['cve']?>" type="time"></td>
								<td><input name="fin_<?php echo $dia['cve']?>" type="time"></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
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