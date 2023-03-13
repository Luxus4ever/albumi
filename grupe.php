<?php 

include "config/config.php";
include "header.php";

?>


	<div id="wrapper">
		<!-- Prikaz albuma -->
		<div class="albumPrikaz">
			
			<h3 class="drzavaTekstovi"><span class="boja">Država:</span> Srbija</h3>
			
			<!-- Celarfix -->
			<div class="clearfix">
				<!-- Info albuma -->
				<?php 

                
				$artist= $_GET["grupa"];
                //$albumId= $_GET["album"];


				//include "functions2.php";
				include "classes/detaljiAlbum.class.php";
				$sviAlb= new albumDetalji();
				$sviAlb->grupe($artist);
                
					?>
				
			</div> <!-- kraj clearfix -->
			
			<br>
			<!--<p class="clear">Struka - Opet Tu EP (2013.)</p>-->

			<!-- TekstP -->
			<div class="tekstP">

					
					<?php
					include "classes/izvodjac.class.php";
					$detIzv= new detaljiIzvodjac();
                    $detIzv->biografija($artist);
					

					?>
					
				
				

			</div> <!-- kraj tekstP -->
				
		</div> <!-- kraj albumPrikaz -->
		
		<!-- Ostali albumi -->
		<div class="ostaliAlbumi">
		<?php 
		//$detAlb->ostaliAlbumi();
					?>
		</div> <!-- kraj ostaliAlbumi -->
<?php
include "footer.php";