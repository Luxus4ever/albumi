<?php 

include "config/config.php";
include "header.php";
include "classes/detaljiIzvodjac.class.php";
include "classes/detaljiAlbum.class.php";
include "functions/master.func.php";

?>
<div id="wrapper">

<!-- Prikaz detalja o izvođaču -->
<div class="slikeAlbumaPregled">
	<?php                 
	$artist= $_GET["izvodjac"];

	//<!-- Info albuma -->
	$detIzv= new izvodjacDetalji();
	?>
		<div class="tekstP">
				<?php
					nadjiIzvodjaca($artist);
					$detIzv->biografija($artist);
				?>
		</div> <!-- kraj tekstP -->
				
</div> <!-- kraj .o-izvodjacu -->

<?php
include "footer.php";