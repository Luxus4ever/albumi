<?php
include "config/config.php";
include "classes/detaljiAlbum.class.php";
include_once "functions/master.func.php";
include "header.php";

?>
<div id="wrapper">
    <div class="slikeAlbumaPregled sredina">
        <main>
<?php
@$profil= $_GET["username"];
@$lid= $_GET["lid"];;
editUser($profil, $lid);

if(empty($profil) || empty($lid)){
        echo ("<h1>Ne možete da pristupite ovom dijelu bez validnih podataka.</h1>");
    }

?>




        </main>
    </div> <!-- kraj .slikeAlbumaPregled -->
</div> <!-- kraj #wrapper -->

	
	
	
<?php
include "subfolder/footer.php";


//global $conn;



