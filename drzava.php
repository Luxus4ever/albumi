<?php
include "config/config.php";
include "classes/detaljiAlbum.class.php";
include "functions/master.func.php";
include "header.php";

$imeDrzave= str_replace("-", " ", $_GET["nazivdrzave"]);

?>


	<div id="wrapper">
		<!-- Prikaz albuma -->
		<div class="albumPrikaz">
		<?php 

    $drzAlb= new albumDetalji();
    sviAlbumiPoDrzavi($imeDrzave);

    ?>
                    
    </div> <!-- kraj albumPrikaz -->




<?php
include "footer.php";