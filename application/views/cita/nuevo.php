<section>
		
	<header class="major">
		<h1>Selecciona un pasciente</h1>
		<p>
			<select id="opt" >
			<option value=""></option>
			<?php foreach ($pollo as $doc): ?>
				<option class="valor" value="<?php echo $doc['cdoc']?>"><?php echo $doc['nom']?> <?php echo $doc['ape']?></option>
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

