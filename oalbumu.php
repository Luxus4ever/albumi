<?php 

include "config/config.php";
include "header.php";
include "classes/ratings.class.php";
include "functions/master.func.php";

//include "functions2.php";

?>
<div id="wrapper" class="oalbumu">
	
	<?php 
	$izvodjacId= $_GET['izv'];
	$albumId= $_GET["album"];
	$naziv= $_GET["naziv"];
	@$lid= $_SESSION["idKorisnici"];

	include "classes/detaljiAlbum.class.php";
	$detAlb= new albumDetalji();
	$detAlb->prikazAlbuma($albumId);

	include "classes/pjesme.class.php";
	$pj= new pjesme();
			$pj->streamovi($albumId);

	?>
	
		<table>
			
			<?php

			
			
			
			$pj->listaPjesama($albumId);
			

			?>
			
		</table>
			
		<?php
		//global $conn;
		$izvodjacOcjena= isset($_GET["izvodjac"]);
		$albumOcjena= isset($_GET["album"]);
			$rt= new ocjene();
		@$ses= $_SESSION["idKorisnici"];
			echo $ses;

			/*$q= "SELECT * FROM ocjene WHERE albumId='{$albumId}'";
			$ocjeniAlbum= mysqli_query($conn, $q);

			while($row= mysqli_fetch_assoc($ocjeniAlbum))
			{
				$idOcjene= $row["id"];
				$idAlbum= $row["albumId"];
				$korisnik= $row["korisniciId"];
				$ratedIndex= $row["ratedIndex"];
echo $idOcjene;
				//echo "$idAlbum <br> $korisnik <br> $ratedIndex";

				/*if($idAlbum===$albumId && $korisnik===$ses)
				{
					//echo "isto je";
					$rt->updateOcjena($albumId, $idOcjene);
				}else{
					//echo "nije isto";
					$rt->ocjeni($albumId);
				}*/
			//}

			//$rt->ocjeni($albumId);
			//$rt->trenutniRezultat($albumId);
			$ses2= ($lid===null) ? $rt->trenutniRezultat($albumId) : $rt->ocjeni($albumId);
		?>
			
	</div> <!-- kraj prikaz-albuma -->
	
	
	<!-- Ostali albumi -->
	<div class="ostaliAlbumi">
		<?php 
		$detAlb->ostaliAlbumi();
		?>
	</div> <!-- kraj ostaliAlbumi -->

	<?php
	
	//$forma= dodajKomentar($izvodjacId, $albumId, $naziv, $lid);
	//echo $lid . "ili nešto";
	 
	$ses= ($lid===null) ? dodajNapomenu("Morate biti ulogovani da ostavite komentar!") :  dodajKomentar($izvodjacId, $albumId, $naziv, $lid);
	prikazKomentara($albumId, $lid);
	?>

	
	
<?php
include "footer.php";