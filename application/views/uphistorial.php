<section>
<h1><?php echo $title; ?></h1>		

	<form method="POST" action="<?php echo base_url(); ?>index.php/Historial/update">
		<div class="row uniform 50%">
			

			<div class="4u 12u$(xsmall)">
				 Diagnostico: <input name="diag" type="text" value="<?php echo $historial['diagnostico'] ?>"></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Descripcion consulta:<input name="desc" type="text" value="<?php echo $historial['desc_consulta'] ?>"></input>
			</div>
			<div class="4u 12u$(xsmall)">
				Observaciones:<input name="obser" type="text" value="<?php echo $historial['observaciones'] ?>" required></input>
			</div>
				<input name="cve" type="hidden" value="<?php echo $historial['cve'] ?>" required></input>
			<div class="12u 12u$(xsmall)">
				<ul class="actions">
					<li><input type="submit" value="Guardar" class="special" /></li>
					<li><input type="reset" value="Limpiar" /></li>
				</ul>		
			</div>
		</div>
	</form>
</section>