<section>
		
	<header class="major">
		<h1>Selecciona un paciente</h1>
		<p>
			<select id="paciente" >
			<option value=""></option>
			<?php foreach ($paciente as $pac): ?>
				<option class="valor" value="<?php echo $pac['cve']?>"><?php echo $pac['nombre']?> <?php echo $pac['appat']?> <?php echo $pac['apmat']?></option>
			<?php endforeach; ?>			
			</select>
		</p>
	</header>

	<h1>Selecciona un doctor</h1>
		<p>
			<select id="opt" >
			<option value=""></option>
			<?php foreach ($pollo as $doc): ?>
				<option class="valor" value="<?php echo $doc['cdoc']?>"><?php echo $doc['nom']?> <?php echo $doc['ape']?></option>
			<?php endforeach; ?>			
			</select>
		</p>
</section>

