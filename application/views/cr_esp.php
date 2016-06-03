			<section>
				<h1><?php echo $title; ?></h1>		
<form action="<?php echo base_url(); ?>index.php/Especialidad/recibirdatos" method="post">
	<div class="row uniform 50%">
 		<div class="7u 12u$(xsmall)">
			<input type="text" name="descripcion" value="" placeholder="Nombre" />
		</div>
		<div class="5u 12u$(xsmall)">
			<ul class="actions">
				<li><input type="submit" value="Guardar" class="special" /></li>
				<li><input type="reset" value="Limpiar" /></li>			
			</ul>
		</div>
  	</div>
</form>
</section>

