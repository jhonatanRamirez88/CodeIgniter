<section>
	<h1><?php echo $title; 
		?></h1>		

	<form method="POST" action="<?php echo base_url(); ?>index.php/Doctor/executeUpdate">
		<div class="row uniform 50%">
			<div class="4u 12u$(xsmall)">
				Nombre: <input name="nom" type="text" value="<?php echo $datos['nom']; ?>" />
			</div> 	
			<div class="4u 12u$(xsmall)">
				Apellido paterno:<input name="appat" type="text" value="<?php echo $datos['pat']; ?>"/>
			</div>
			<div class="4u 12u$(xsmall)">
				Apellido materno:<input name="apmat" type="text" value="<?php echo $datos['mat']; ?>"/>
			</div>
			<div class="4u 12u$(xsmall)">
				Telefono particular:<input name="telpar" type="text" value="<?php echo $datos['par']; ?>"/>
			</div>
			<div class="4u 12u$(xsmall)">
				Telefono movil:<input name="telmov" type="text" value="<?php echo $datos['mov']; ?>"/>
			</div>
			<div class="4u 12u$(xsmall)">
				Especialidad:
				<div class="select-wrapper">
					<select name="esp" > 
						<?php foreach ($pollos as $item ): ?>
							<?php echo "<option value='".$item['cve']."'>".$item['descripcion']."</option>"; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>		
			<input type="hidden" name="cve_doc" value="<?php echo $datos['cve_doc']; ?>">
			<div class="12u 12u$(xsmall)">
				<ul class="actions">
					<li><input type="submit" value="Guardar" class="special" /></li>
					<li><input type="reset" value="Limpiar" /></li>
				</ul>		
			</div>
		</div>
	</form>
</section>