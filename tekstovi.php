<?php 

include "config/config.php";
include "header.php";

?>


	<div id="wrapper">
		<div  class="bojaTekstovi">

	<?php 

	
	$tekstId= $_GET["tekst"];
	//$albumId= $_GET["album"];


	include "classes/pjesme.class.php";
	$detPj= new pjesme();
	$detPj->tekstPjesme($tekstId);

	?>
   </div>
	<?php
					

include "footer.php";