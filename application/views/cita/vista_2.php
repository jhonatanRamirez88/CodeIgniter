<head> <h1>Cita de pasciente</h1></head>
<section>

	<form method="POST" action="<?php echo base_url(); ?>index.php/Paciente/verNuevo">						
			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Nombre del doctor:					
					<?php foreach ($horas as $doc): ?>
						<label name="nombre" value="<?php echo $doc['cdoc']?>"><?php echo $doc['nom']?> <?php echo $doc['appat']?></label>
					<?php endforeach; ?>					
				</div>		
			</div>


			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Hora inicio de consultas:					
					<?php foreach ($horas as $doc): ?>
						<label name="hini" value=""><?php echo $doc['hini']?></label>
					<?php endforeach; ?>					
				</div>		
			</div>

			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Hora fin de consultas:					
					<?php foreach ($horas as $doc): ?>
						<label name="hfin" value=""><?php echo $doc['hfin']?></label>
					<?php endforeach; ?>					
				</div>		
			</div>

				
	<div class="row uniform 50%">
		<div class="4u 12u$(xsmall)">
			Hora que desea la consulta:<input name="hrcon" type="text"></input>
		</div>
	</div>



<div class="row uniform 50%">
			<div class="5u 12u$(xsmall)">
			<ul class="actions">
				<li><input type="submit" value="Buscar" class="special" /></li>		
			</ul>
			</div>
</div>


	</form>
</section>