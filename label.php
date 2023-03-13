<?php 

include "config/config.php";
include "header.php";

?>


	<div id="wrapper">

	<?php 

	
	$izdavac= str_replace("-", " ", $_GET["izdavac"]);

	include "classes/izdavaci.class.php";
	$detLab= new detaljiLabel();

	?>
	<div class="albumPrikaz">
	<h3 class=""><span class="boja">Izdavač:</span> <?php echo $izdavac; ?></h3>
	<?php
	$detLab->izdavaci($izdavac);

	?>
	</div><!-- end .albumPrikaz -->

<?php
include "footer.php";