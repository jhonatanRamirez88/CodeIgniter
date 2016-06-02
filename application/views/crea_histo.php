<section>
<h1><?php echo $title; ?></h1>		

	<form method="POST" action="<?php echo base_url(); ?>index.php/Historial/crearhisto">
		<div class="row uniform 50%">
			<div class="4u 12u$(xsmall)">
				 <input name="cvecita" type="hidden" value="<?php echo $cvecita ?>"></input>
			</div>
			<?php 
				//var_dump($pac);
				//var_dump($pac['nom']);
			?>
			<div class="4u 12u$(xsmall)">
				 <input name="nombre" type="text" value="<?php echo $pac['nom'] .$pac['pat'] ?>"></input>
			</div>
			
			<div class="4u 12u$(xsmall)">
				Diagnostico:<input name="diag" type="text" required></input>
			</div>
			<div class="4u 12u$(xsmall)">	
				Descripcion consulta:<input name="desc" type="text" required></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Observaciones:<input name="obser" type="text" required></input>
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