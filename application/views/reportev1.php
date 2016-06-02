<section>
<h1>Seleccione entre que dias quiere generar el reporte</h1>
	<form method="POST" action="<?php echo base_url(); ?>index.php/Reporte/buscar">
			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Selecciona el día de inicio
					<?php 		$edo = date_default_timezone_set ( "America/Mexico_City" ); ?>
					<input type="date" id ="diaini" name="diaini" step="1" onclick="<?php $i = date("Y-m-d"); ?>;" min="<?php echo date("Y-m-d");?>" max="2018-12-31" value="<?php echo date("Y-m-d");?>">
				</div>
			</div>
			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Selecciona el día de fin
					<?php 		$edo = date_default_timezone_set ( "America/Mexico_City" ); ?>
					<input type="date" id ="diafin" name="diafin" step="1" onclick="<?php $i = date("Y-m-d"); ?>;" min="<?php echo date("Y-m-d");?>" max="2018-12-31" value="<?php echo date("Y-m-d");?>">
				</div>
			</div>
			<div class="row uniform 50%">
						<div class="5u 12u$(xsmall)">
						<ul class="actions">
							<li><input type="submit" value="Buscar" class="special" id="btn1"/></li>
						</ul>
						</div>
			</div>


	</form>
</section>


