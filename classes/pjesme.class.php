<?php

class pjesme{

    public $izvodjac;
    public $izvodjacMaster;
    public $izvodjaciGrupa;
    public $idPjesme;
    public $redniBroj;
    public $album;
    public $nazivPjesme;
    public $saradnici;
    public $tekstPjesme;
    public $trajanjePjesme;
    public $mixtapeIzvodjac;
    public $feat;

    //*********************************Metoda koja vrši ispis pjesama od albuma *********************************/
    public function listaPjesama($albumId) 
    {
        global $conn;
        $q= "SELECT * FROM pjesme 
        JOIN albumi ON albumi.idAlbum=pjesme.albumId
        JOIN izvodjaci ON izvodjaci.idIzvodjaci=albumi.idIzvodjacAlbumi
        WHERE albumi.idAlbum='{$albumId}'";
	
        
        $select_songs= mysqli_query($conn, $q);
        if(mysqli_num_rows($select_songs)>0)
        {
            while($row= mysqli_fetch_assoc($select_songs))
            {
                $this->idPjesme= $row["idPjesme"];
                $this->redniBroj= $row["redniBroj"];
                $this->nazivPjesme= $row["nazivPjesme"];
                $this->saradnici= $row["saradnici"];
                $this->tekstPjesme= $row["tekstPjesme"];
                $this->trajanjePjesme= $row["trajanjePjesme"];
                $this->album= $row["albumId"];
                $this->feat= $row["feat"];
                $this->izvodjac= $row["izvodjacId"];
                $this->izvodjacMaster= $row["izvodjacMaster"];
                $this->mixtapeIzvodjac= $row["mixtapeIzvodjac"];

                $this->tabelaPjesme($this->idPjesme, $this->redniBroj, $this->nazivPjesme, $this->saradnici, $this->tekstPjesme, $this->trajanjePjesme, $this->feat, $this->izvodjac, $this->mixtapeIzvodjac, $this->izvodjacMaster);                
                    
            }
        }else {echo "Trenutno nema unijetih podataka.";}

    }// end function listaPjesama
    //********************************* Pozvana metoda u oalbumu.php *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------

    //*********************************Metoda koja iscrtava tabelu *********************************/
    public function tabelaPjesme($idPjesme, $redniBroj, $nazivPjesme, $saradnici, $tekstPjesme, $trajanjePjesme, $feat, $izvodjac, $mixtapeIzvodjac, $izvodjacMaster)
    {
        ?>
            
             
                <?php 
                if($this->saradnici==null && ($this->trajanjePjesme==null || $this->trajanjePjesme=="00:00:00") && $this->mixtapeIzvodjac!==null)
                {
                    ?>
                    <tr>
                    <td><?php echo $this->redniBroj; ?></td> 
                    <td><?php echo $this->mixtapeIzvodjac . $this->feat; ?></td> 
                    <td><a href="tekstovi.php?tekst=<?php echo $this->idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                        <?php $this->fit($this->feat)?>
                    </td>
                    </tr>
                    <?php
                }elseif($this->saradnici==null && $this->trajanjePjesme==null)
                {
                    ?>
                    <tr>
                    <td><?php echo $this->redniBroj; ?></td> 
                    <td><?php echo $this->izvodjacMaster; ?></td> 
                    <td><a href="tekstovi.php?tekst=<?php echo $this->idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                        <?php $this->fit($feat)?>
                    </td>
                    </tr>
                    <?php
                }elseif($this->saradnici==null && !empty($this->mixtapeIzvodjac!==null))
                {
                    ?>
                    <tr>
                    <td><?php echo $this->redniBroj; ?></td> 
                    <td><?php echo $this->izvodjacMaster; ?></td> 
                    <td><?php echo $this->mixtape($this->mixtapeIzvodjac) . " " . $this->fit($this->feat); ?></td>
                    <td><a href="tekstovi.php?tekst=<?php echo $this->idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                        <?php ?>
                    </td>
                    <td><?php echo $this->trajanjePjesme; ?></td>
                    </tr>
                    <?php
                }elseif($this->saradnici==null)
                    {
                        ?>
                        <tr>
                        <td><?php echo $this->redniBroj; ?></td> 
                        <td><?php echo $this->izvodjacMaster; ?></td> 
                        <td><a href="tekstovi.php?tekst=<?php echo $this->idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                            <?php $this->fit($this->feat)?>
                        </td>
                        <td><?php echo $this->trajanjePjesme; ?></td>
                        </tr>
                        <?php
                }elseif(($this->trajanjePjesme==null || $this->trajanjePjesme=="00:00:00") && $this->mixtapeIzvodjac!==null)
                {
                    ?>
                    <tr>
                    <td><?php echo $this->redniBroj; ?></td>  
                    <td><?php echo $this->mixtape($this->mixtapeIzvodjac); ?></td>
                    <td><a href="tekstovi.php?tekst=<?php echo $idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                        <?php $this->fit($this->feat)?>
                    </td>
                    <td class="listaPjesama"><?php echo $this->saradnici; ?></td>
                        </tr>
                    <?php
                }elseif($this->trajanjePjesme==null || $this->trajanjePjesme=="00:00:00")
                {
                    ?>
                    <tr>
                    <td><?php echo $this->redniBroj; ?></td> 
                    <td><?php echo $this->izvodjacMaster; ?></td> 
                    <td><a href="tekstovi.php?tekst=<?php echo $idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                        <?php $this->fit($this->feat)?>
                    </td>
                    <td class="listaPjesama"><?php echo $this->saradnici; ?></td>
                    </tr>
                    <?php
                }elseif($this->mixtapeIzvodjac!==null)
                {
                    ?>
                    <tr>
                        <td><?php echo $this->redniBroj; ?></td> 
                        <td><?php echo $this->mixtapeIzvodjac. $this->feat; ?></td> 
                        <td><a href="tekstovi.php?tekst=<?php echo $idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                            <?php $this->fit($this->feat)?>
                        </td>
                        <td class="listaPjesama"><?php echo $this->saradnici; ?></td>
                        <td><?php echo $this->trajanjePjesme; ?></td>
                        </tr>
                        <?php 
                }else
                    {
                        ?>
                        <tr>
                        <td><?php echo $this->redniBroj; ?></td> 
                        <td><?php echo $this->izvodjacMaster; ?></td> 
                        <td><a href="tekstovi.php?tekst=<?php echo $idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                            <?php $this->fit($this->feat)?>
                        </td>
                        <td class="listaPjesama"><?php echo $this->saradnici; ?></td>
                        <td><?php echo $this->trajanjePjesme; ?></td>
                        </tr>
                        <?php 
                    }

    }// end function tabelaPjesme
    //********************************* Pozvana metoda u u ovom fajlu u metodi listaPjesama() *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------

    //*********************************Metoda koja prikazuje detalje o grupama *********************************/
    public $idGrupe;
    public $nazivGrupe;
    public function grupe($param)
    {
        global $conn;
        $q= "SELECT * FROM grupe 
        LEFT JOIN izvodjaci ON izvodjaci.izvodjaciGrupa=grupe.idGrupe
        WHERE grupe.idGrupe=izvodjaci.izvodjaciGrupa LIMIT 1";
	
        $select_grupe= mysqli_query($conn, $q);
        
        while($row= mysqli_fetch_assoc($select_grupe))
        {
            $this->idGrupe= $row["idGrupe"];
            $this->nazivGrupe= $row["nazivGrupe"];
            $this->izvodjaciGrupa= $row["izvodjaciGrupa"];

            if($this->izvodjaciGrupa!= $param)
            {
                echo "Šipak";
            }else
                {
                    echo "<h1>$this->nazivGrupe</h1>";
                }
            
                
        }// end While loop
    }//end function grupe

    //********************************* Pozvana metoda u grupe.php *********************************//
    
    //--------------------------------------------------------------------------------------------------------------------------------
    
    //*********************************Metoda za uklanjanje riječi featuring ili feat. na pjesmi *********************************/
    public function fit($param)
    {
        $niz3= explode(", ", $param);
        $niz4= explode(" & ", $param);
        
        foreach($niz3 as $ime)
        {
            
                //if(strpos($ime, "featuring"))
                if(strpos($param, "featuring")!==false)
                {
                    ?>
                    <a class="feat" href="izvodjac.php?izvodjac=<?php echo str_replace("featuring ", "", $ime) ?>"><?php echo $ime; ?></a><?php
                    if(next($niz3))
                    {
                        echo ", ";
                    }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                }elseif(strpos($param, "Featuring")!==false)
                    {
                        ?>
                        <a class="feat" href="izvodjac.php?izvodjac=<?php echo str_replace("Featuring ", "", $ime) ?>"><?php echo $ime; ?></a><?php
                        if(next($niz3))
                        {
                            echo ", ";
                        }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                    }elseif(strpos($param, "feat. ")!==false)
                        {
                            ?>
                            <a class="feat" href="izvodjac.php?izvodjac=<?php echo str_replace("feat. ", "", $ime); ?>"><?php echo $ime; ?></a><?php
                            if(next($niz3))
                            {
                                echo ", ";
                            }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                        }elseif(strpos($param, "(")!==false && strpos($param, ")")!==false)
                        {
                            ?>
                            <a class="feat" href="izvodjac.php?izvodjac=<?php echo str_replace("(", "", str_replace(")", "", $ime)) ?>"><?php echo $ime; ?></a><?php
                            if(next($niz3))
                            {
                                echo ", ";
                            }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                        }else{
                            ?>
                            <a class="feat" href="izvodjac.php?izvodjac=<?php echo $ime ?>"><?php echo $ime; ?></a><?php
                            if(next($niz3))
                            {
                                echo ", ";
                            }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                        }
            
        }// end foreach loop
    }// end function fit
    //******************************* Pozvana metoda u ovom fajlu (više puta) u metodi tabelaPjesme() *******************************//

    //--------------------------------------------------------------------------------------------------------------------------------
    public function mixtape($param)
    {
        //$string1= str_replace(" feat. ", ", ", $param);
        //$string2= str_replace(" & ", ", ", $string1);
        /*if(strpos($param, "feat.") !== false){
            echo "Word Found!";
        } else{
            echo "Word Not Found!";
        }*/
        global $conn;
        $q= "SELECT izvodjacMaster FROM izvodjaci";
        $upit= mysqli_query($conn, $q);
        $nizMx= explode(", ", $param);
        
        foreach($nizMx as $mxIme)
        {
            
                //if(strpos($ime, "featuring"))
               
                    ?>
                    <a class="feat" href="izvodjac.php?izvodjac=<?php echo $mxIme; ?>"><?php echo $mxIme; ?></a><?php
                    if(next($nizMx))
                    {
                        echo ", ";
                    }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                
            
        }// end foreach loop
    }// end function fit

    //--------------------------------------------------------------------------------------------------------------------------------

    public function nadimak()
    {
        global $conn;
        $q= "SELECT izvodjacMaster, nadimci FROM izvodjaci WHERE id=18";
        $select_nadimak= mysqli_query($conn, $q);

        while($row= mysqli_fetch_assoc($select_nadimak))
        {
            $izvodjacIme= $row["izvodjacMaster"];
            $nadimak= $row["nadimci"];

            echo $izvodjacIme . "<br>" . $nadimak . "<br>";
        }
    }
    
    //--------------------------------------------------------------------------------------------------------------------------------

    //*********************************Metoda za prikaz teksta pjesme *********************************/
    public function tekstPjesme($tekstId) 
    {
        global $conn;

        $q= "SELECT nazivPjesme, tekstPjesme, izvodjacMaster, nazivAlbuma, godinaIzdanja FROM pjesme 
        JOIN izvodjaci ON izvodjaci.idIzvodjaci = pjesme.izvodjacId
        JOIN albumi ON albumi.idAlbum = pjesme.albumId WHERE idPjesme='{$tekstId}'";

        $select_songs= mysqli_query($conn, $q);
        
        while($row= mysqli_fetch_assoc($select_songs))
        {
            $nazivPjesme= $row["nazivPjesme"];
            $tekstPjesme= nl2br($row["tekstPjesme"]);
            $album= $row["nazivAlbuma"];
            $izvodjac= $row["izvodjacMaster"];
            $godinaIzdanja= $row["godinaIzdanja"];

            echo "<h3 class='tekstovi-prikaz'><span class='boja'>Album:</span> $album ($godinaIzdanja.) </h3>";
            echo "<!-- TekstP -->
			<div class='tekstP'>";
            echo "<h2 class='tekstNaziv'>" . $izvodjac . " - " . $nazivPjesme . "</h2>"; 
            echo "<br><br>";
            

            if(empty($tekstPjesme)){
                echo "<h2>Nema dostupnih informacija!</h2>";
            }else{
                echo "<p>$tekstPjesme</p>";
            }
            echo "</div> <!-- kraj tekstP -->";
 
        }

    }// end function tekstPjesme
    //********************************* Pozvana metoda u tekstovi.php *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------

    public function streamovi($idAlbum)
    {
        global $conn;

        $q= "SELECT * FROM streamovi WHERE albumId=$idAlbum";
        $select_streams= mysqli_query($conn, $q);

        while($row= mysqli_fetch_array($select_streams))
        {
            $youtubeL= $row['youtube'];
            $spotifyL= $row['spotify']; 
            $deezerL= $row['deezer']; 
            $appleMusicL= $row['appleMusic'];
            $tidalL= $row['tidal'];
            $youtubeMusicL= $row['youtubeMusic'];
            $amazonMusicL= $row['amazonMusic']; 
            $soundcloudL= $row['soundCloud'];
        
            ?>
            <div class="streams">
                <a href="<?php echo $youtubeL; ?>" target="_blank"><img src="images/streams/Youtube-Logo.webp" title="YouTube" alt="YouTube"></a>
                <a href="<?php echo $spotifyL; ?>" target="_blank"><img src="images/streams/spotify-icon.png" title="Spotify" alt="Spotify"></a>
                <a href="<?php echo $deezerL; ?>" target="_blank"><img src="images/streams/deezer-logo.png" title="Deezer" alt="Deezer"></a>
                <a href="<?php echo $appleMusicL; ?>" target="_blank"><img src="images/streams/Apple_Music_logo.png" title="Apple Music" alt="Apple Music"></a>
                <a href="<?php echo $tidalL; ?>" target="_blank"><img src="images/streams/tidal-icon-png-7.jpg" title="Tidal" alt="Tidal"></a>
                <a href="<?php echo $youtubeMusicL; ?>" target="_blank"><img src="images/streams/Youtube-Music.png" title="YouTube Music" alt="YouTube Music"></a>
                <a href="<?php echo $amazonMusicL; ?>" target="_blank"><img src="images/streams/amazon-music-logo.png" title="Amazon Music" alt="Amazon Music"></a>
                <a href="<?php echo $soundcloudL; ?>" target="_blank"><img src="images/streams/soundcloud-logo.png" title="SoundCloud" alt="SoundCloud"></a>
            </div>
            <?php
        }
    }
    
}//end class pjesme