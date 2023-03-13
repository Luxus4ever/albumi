<?php

//********************************* Metoda za unos komentara/recenzije albuma *********************************//
function dodajKomentar($izvodjacId, $albumId, $naziv, $lid)
{
    global $conn;
    if(isset($_POST["posalji"]))
    {
        if(!empty(["recenzija"]))
        {
            $recenzija= trim($_POST["recenzija"]);
			$q= "INSERT INTO recenzije (recenzija, vrijemeRecenzije, albumId, korisnikId) VALUES ('$recenzija', now(), $albumId, $lid)";
			$command_recenzija= mysqli_query($conn,$q);
			
			if($command_recenzija===TRUE)
			{
				echo "<meta http-equiv='refresh' content='1'; url='oalbumu.php?izv={$izvodjacId}&album={$albumId}&naziv={$naziv}'>";
			}
		}else{
			echo "Greška " . mysqli_error($conn). "<br>";;
		}
	}
    formaDodajKomentar();
}
//********************************* Metoda pozvana na stranici oalbumu.php *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Metoda za prikaz forme za dodavanje komentara/recnzije ispod albuma *********************************//
function formaDodajKomentar()
{
    ?>
    <div class="recenzija">
        <form action="" method="POST" name="recenzija" id="recenzija">
            <label for="recenzija">Napišite recenziju</label><br>
            <textarea name="recenzija" class="recenzija" required></textarea><br>
            <input type="submit" class="submit" name="posalji" value="Posalji">
        </form>
    </div>
    <?php
}

//********************************* Metoda pozvana u ovom fajlu u funkciji dodajKomentar() *********************************//

function prikazKomentara($albumId, $lid)
{
    global $conn;
    $q="SELECT recenzije.*, korisnici.idKorisnici, korisnici.username, korisnici.profilnaSlika FROM recenzije JOIN korisnici ON recenzije.korisnikId=korisnici.idKorisnici WHERE albumId=$albumId";
    $sviKomentari= mysqli_query($conn, $q);

    while($row= mysqli_fetch_array($sviKomentari))
    {
        $recenzija= $row["recenzija"];
        $vrijemeRecenzije= $row["vrijemeRecenzije"];
        $idKorisnici= $row["idKorisnici"];
        $username= $row["username"];
        $profilnaSlika= $row["profilnaSlika"];

        $datumRec= strtotime($vrijemeRecenzije);
        $vrijemeRecenzije= date("d.m.Y. H:i:s", $datumRec);

        ?>
        <div class="sredina">
        <div class="prikazKomentara">
            <div class="razmakIzmedju">
            <?php echo "<img src='images/profilne/{$profilnaSlika}'/> 
            <h4><a href='profile.php?username={$username}&lid={$idKorisnici}'>$username</a></h4>
            <p class='vrijemeRecenzije'>$vrijemeRecenzije</p>
            </div>
            <p>$recenzija</p>";
            ?>
        </div>
    </div><!--sredina-->
        <?php
        
    }

}

//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Metoda za prikaz nekog teksta kao upozorenja *********************************//
function dodajNapomenu($string)
	 {
		echo "<h3 class='sredina warning'>$string</h3>";
	 }

//********************************* Metoda pozvana oalbumu.php, ratings.php *********************************//