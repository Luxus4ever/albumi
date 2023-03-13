<?php 

include "config/config.php";
include "header.php";
//include "functions2.php";

?>
<div id="wrapper">
	
	<?php 

	$godina= $_GET["godina"];

	include "classes/detaljiAlbum.class.php";
	$detAlb= new albumDetalji();
	$detAlb->poGodini($godina);
	
	?>
				
		
		
		
<?php
include "footer.php";