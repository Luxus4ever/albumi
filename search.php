<?php 

include "config/config.php";
//include "functions.php";
include "classes/detaljiAlbum.class.php";
include "header.php";
include "functions/master.func.php";

?>


	<div id="wrapper">
    <div class="slikeAlbumaPregled">
<form method="POST" action="" name="pretraga" class="pretragaForma">

<input type="text" name="pretraga" id="pretraga" placeholder="Unesite pojam za pretragu" required="required">

<input type="submit" id="pretraziButton" name="pretrazi" value="Pretraži">

</form>
<?php

include "config/config.php";

if(isset($_POST["pretrazi"]))
{
    $rezultat= $_POST["pretraga"];
    
    poAlbumima($rezultat);
    poIzvodjacima($rezultat);
    poPjesmama($rezultat);
}


?>
</div><!-- end .slikeAlbumaPregled -->
<?php


include "footer.php";