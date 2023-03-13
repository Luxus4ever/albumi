<?php


//********************************* Prikaz dobrodošlice na osnovu pola *********************************//
function prikazDobrodoslice($pol){
	if($pol==="Muško"){
		echo "Dobrodošao ";
	}else if($pol==="Žensko"){
		echo "Dobrodošla ";
	}
}

//********************************* Pozvana metoda u ovom fajlu u metodi detailsUser *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Prikaz detalja o profilu *********************************//
function detailsUser($profil, $lid, $sesId)
{

    if(!isset($_SESSION['username']) && !isset($_SESSION['idKorisnici']))
    {
        echo "<h1>Nemate prava pristupa!</h1>";
    }else{
    global $conn;
    
    
    $q2= "SELECT * FROM korisnici WHERE username='{$profil}' AND idKorisnici='{$lid}'";
    $pregledajPodatke= mysqli_query($conn, $q2);
    

    while($row= mysqli_fetch_assoc($pregledajPodatke))
    {
        $idKorisnici= $row["idKorisnici"];
        $ime= $row["ime"];
        $prezime= $row["prezime"];
        $email= $row["email"];
        $username= $row["username"];
        $datumRegistracije= $row["datumRegistracije"];
        $pol= $row["pol"];
        $tipKorisnika= $row["tipKorisnika"];
        $drzava= $row["drzava"];
        $profilnaSlika= $row["profilnaSlika"];
        $grad= $row["grad"];
        $facebookPr= $row["facebookPr"];
        $instagramPr= $row["instagramPr"];
        $twitterPr= $row["twitterPr"];
        $tiktokPr= $row["tiktokPr"];
        $sajt= $row["websajt"];
        $zadnjiLogin= $row["zadnjiLogin"];
        
        
        $datum1= strtotime($datumRegistracije);
        $noviDatum=date("d.m.Y. H:i:s", $datum1);

        $datum2= strtotime($zadnjiLogin);
        $noviZadnjiLogin= date("d.m.Y. H:i:s", $datum2);
        /*$formatDatuma= date_format(now(), "%d.%m.%Y");
        date_format(now(), ' Датум: %d.%m.%Y. ');
        now();*/

        ?>
        <div id="wrapper">
            <div class="slikeAlbumaPregled">
                <main>
                <aside class="profilBocno">
                    <div>
                        <img src="images/profilne/<?php echo $profilnaSlika;?>" alt="<?php echo $username;?>" title="<?php echo $username;?>">
                        <h2><?php prikazDobrodoslice($pol); echo $username;?></h2>
                        <p>Na sajtu od <?php echo $noviDatum; ?></p><hr>
                        <p>Zadnja aktivnost <br> <?php echo $noviZadnjiLogin; ?></p>
                        <?php
                            $usr= new User();
                            $usr->userOnline($lid);
                        ?>
                        <hr>
                        <p><?php echo $drzava; ?></p>
                        <p><?php echo $grad; ?></p>
                        
                        <?php 
                            if(!empty($facebookPr))
                            {
                                ?>
                            <span class="fa-stack">
                                <a href="<?php echo "https://www.facebook.com/".$facebookPr; ?>" target="_blank">
                                    <i class="fa fa-circle fa-2x" aria-hidden="true"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x"></i>
                                </a>
                            </span>
                            <?php
                            }else{echo "";}
                            ?>

                            <?php 
                            if(!empty($instagramPr))
                            {
                                ?>
                            <span class="fa-stack">
                                <a href="<?php echo "https://www.instagram.com/".$instagramPr; ?>" target="_blank">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-instagram fa-stack-1x"></i>
                                </a>
                            </span>
                            <?php
                            }else{echo "";}
                            ?>

                            <?php 
                            if(!empty($twitterPr))
                            {
                                ?>
                            <span class="fa-stack">
                                <a href="<?php echo "https://twitter.com/".$twitterPr; ?>" target="_blank">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x"></i>
                                </a>
                            </span>
                            <?php
                            }else{echo "";}
                            ?>

                            <?php 
                            if(!empty($tiktokPr))
                            {
                                ?>
                            <span class="fa-stack">
                                <a href="<?php echo "https://www.tiktok.com/@".$tiktokPr; ?>" target="_blank">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-tiktok fa-stack-1x"></i>
                                </a>
                            </span>
                            <?php
                            }else{echo "";}
                            ?>
        
                        
                        <p><a href="<?php echo $sajt; ?>" target="_blank"><?php echo $sajt; ?></a></p>
                        <?php
                        if($sesId===$idKorisnici){
                            ?>
                            <hr>
                            <a href="profileedit.php?username=<?php echo $profil."&lid=".$lid; ?>">Izmjena profila</a>
                            <?php
                        }else {echo "";}
                        ?>
                    </div>
                </aside>
                    <?php
                        //bocniprofil($profilnaSlika, $username);
                        ocjeneProfila($lid);
                    ?>
                </main>  
		    </div> <!-- kraj slikeAlbumaPregled -->
        </div> <!-- kraj #wrapper -->
        <?php
    }
}
    
}
//********************************* Pozvana metoda u profil.php *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Prikaz ocjene albuma i komentara izabranog profila *********************************//
function ocjeneProfila($lid)
{
    ?>
    <section class="profilCentar">
    
        
        
        <div class="ocjenjeniAlbumi">
            <h4>Ocijenjeni albumi</h4>
            <ol>
                <?php
                global $conn;

    $q="SELECT ocjene.*, izvodjaci.idIzvodjaci, izvodjaci.izvodjacMaster, albumi.nazivAlbuma FROM ocjene 
    JOIN izvodjaci ON ocjene.izvodjacId=izvodjaci.idIzvodjaci 
    JOIN albumi ON albumId=idAlbum 
    WHERE korisniciId='{$lid}'";
    $izvuciOcjene= mysqli_query($conn, $q);
    while($row= mysqli_fetch_assoc($izvuciOcjene))
    {
        $ocjena= $row["ratedIndex"];
        $vrijeme= $row["vrijeme"];
        $izvodjac= $row["izvodjacMaster"];
        $nazivAlbuma= $row["nazivAlbuma"];
        //$nazivAlbuma= $row["nazivAlbuma"];
        ?>
    
                <li><?php echo "$izvodjac - $nazivAlbuma (<span class='fas fa-microphone'></span> $ocjena)" ?></li>
          <?php
            }
        ?>
            </ol>
        </div>
        
        <div class="komentarisaniAlbumi">
            <h4>Komentarisani albumi</h4>
            <ol>
            <?php
                global $conn;

    $q="SELECT recenzije.*, albumi.nazivAlbuma, albumi.idIzvodjacAlbumi, izvodjaci.idIzvodjaci, izvodjaci.izvodjacMaster FROM recenzije 
	JOIN albumi ON albumId=idAlbum 
    JOIN izvodjaci ON albumi.idIzvodjacAlbumi= izvodjaci.idIzvodjaci
    WHERE korisnikId='{$lid}'";
    $izvuciKomentare= mysqli_query($conn, $q);
    while($row= mysqli_fetch_assoc($izvuciKomentare))
    {
        $recenzija= $row["recenzija"];
        $vrijeme= $row["vrijemeRecenzije"];
        $izvodjac= $row["izvodjacMaster"];
        $nazivAlbuma= $row["nazivAlbuma"];
        //$nazivAlbuma= $row["nazivAlbuma"];
        ?>
    
                <li><?php echo "$izvodjac - $nazivAlbuma <br>($recenzija)" ?></li>
          <?php
            }
            ?>
            </ol>
        </div>
    </section>
    <?php
}
//********************************* Pozvana metoda u ovom fajlu u metodi detailsUser *********************************//