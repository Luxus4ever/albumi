<?php

class albumDetalji{

    public $albumId;
    public $idIzvodjacAlbumi;
    public $idIzvodjaci;
    public $idIzvodjac2;
    public $idAlbum;
    public $nazivAlbuma;
    public $godinaIzdanja;
    public $izdavac;
    public $slikaAlbuma;
    public $drzavaAlbumi;
    public $entitetAlbumi;
    public $tacanDatumIzdanja;
    public $izvodjacMaster;
    public $nadimci;

    //*********************************Metoda za prikaz 5 albuma na početnoj *********************************/
    public function sviAlbumi($idDrzaveParam, $nazivDrzave)
    {
        global $conn;
        //$q= "SELECT * FROM albumi WHERE drzavaAlbumi='{$param}' ORDER BY RAND()";
        $q= "SELECT * FROM albumi JOIN izvodjaci ON izvodjaci.idIzvodjaci= albumi.idIzvodjacAlbumi
        WHERE drzavaAlbumi='{$idDrzaveParam}' ORDER BY RAND() LIMIT 6";
        $select_album= mysqli_query($conn, $q);
        ?>
        <div class="slikeAlbuma">
        <?php
        while($row= mysqli_fetch_assoc($select_album))
        {
            $this->albumId= $row["idAlbum"];
            $this->idIzvodjacAlbumi= $row["idIzvodjacAlbumi"];
            $this->idIzvodjac2= $row["idIzvodjac2"];
            $this->nazivAlbuma= $row["nazivAlbuma"];
            $this->godinaIzdanja= $row["godinaIzdanja"];
            $this->izdavac= $row["izdavac"];
            $this->slikaAlbuma= $row["slikaAlbuma"];
            $this->drzavaAlbumi= $row["drzavaAlbumi"];
            $this->entitetAlbumi= $row["entitetAlbumi"];
            $this->tacanDatumIzdanja= $row["tacanDatumIzdanja"];
            $this->izvodjacMaster= $row["izvodjacMaster"];
            $this->nadimci= $row["nadimciIzvodjac"];
            ?>

            

            
            <?php
            if($this->idIzvodjac2==null)
            {
                ?>
                <a href="oalbumu.php?izv=<?php echo $this->idIzvodjacAlbumi."&album=".$this->albumId."&naziv=".str_replace(" ", "-", $this->izvodjacMaster)."-".str_replace(" ", "-", $this->nazivAlbuma); ?>" >
            <img src="images/albumi/<?php echo $this->slikaAlbuma; ?>" alt="<?php echo $this->slikaAlbuma; ?>" title="<?php echo $this->izvodjacMaster . " - " . $this->nazivAlbuma; ?>">
            </a>
            <?php
            }else{
                ?>
            
            <a href="oalbumu.php?izvodjac=<?php echo $this->idIzvodjacAlbumi."&album=".$this->albumId."&naziv=".str_replace(" ", "-", $this->izvodjacMaster)."-".str_replace(" ", "-", $this->nazivAlbuma); ?>" >
            <img src="images/albumi/<?php echo $this->slikaAlbuma; ?>" alt="<?php echo $this->slikaAlbuma; ?>" title="<?php echo $this->izvodjacMaster . " - " . $this->nazivAlbuma; ?>">
            </a>
            <?php
            }
            
        }/**** end While ****/
            ?>
            </div>
            <?php
    }

    //Metoda pozvana u drugoj metodi nazivDrzave() u functions/nazivDrzava.php

    //--------------------------------------------------------------------------------------------------------------------------------
    
    //********************************* Prikaz detalja albuma izabranog izvodjaca *********************************//
    //public $izvodjacMaster;
    public $idDrzave;
    public $nazivDrzave;
    public $izvodjaciGrupa;

    public function prikazAlbuma($albumId)
    {
        global $conn;
        $q= "SELECT * FROM albumi  
        JOIN izvodjaci ON izvodjaci.idIzvodjaci=albumi.idIzvodjacAlbumi 
        JOIN drzave ON drzave.idDrzave=izvodjaci.drzavaIzvodjac
        WHERE  albumi.idAlbum='{$albumId}'";
	
        $select_album= mysqli_query($conn, $q);
        
        while($row= mysqli_fetch_assoc($select_album))
        {
            $this->idIzvodjaci= $row["idIzvodjaci"];
            $this->idIzvodjacAlbumi= $row["idIzvodjacAlbumi"];
            $this->idIzvodjac2= $row["idIzvodjac2"];
            $this->nazivAlbuma= $row["nazivAlbuma"];
            $this->godinaIzdanja= $row["godinaIzdanja"];
            $this->izdavac= $row["izdavac"];
            $this->slikaAlbuma= $row["slikaAlbuma"];
            $this->drzavaAlbumi= $row["drzavaAlbumi"];
            $this->entitetAlbumi= $row["entitetAlbumi"];
            $this->tacanDatumIzdanja= $row["tacanDatumIzdanja"];
            $this->izvodjacMaster= $row["izvodjacMaster"];
            $this->idDrzave= $row["idDrzave"];
            $this->izvodjaciGrupa= $row["izvodjaciGrupa"];
            $this->nazivDrzave= $row["nazivDrzave"];
            global $idD;
            $idD=$this->idDrzave;
            global $nDr;
            $nDr= $this->nazivDrzave;

            
            ?>
            <!-- Prikaz albuma -->
		    
			<h1 class="drzava"><span class="boja">Država: </span><?php echo $this->nazivDrzave; ?></h1>

			<!-- Celarfix -->
			<div class="pregledAlbuma">
				<!-- Info albuma -->
            <?php
            $q2= "SELECT izvodjacMaster FROM izvodjaci WHERE idIzvodjaci='{$this->idIzvodjac2}'";
            $select_izvodjace=mysqli_query($conn, $q2);

            while($row2= mysqli_fetch_array($select_izvodjace))
            {
                //$izvodjac1= $row2["izvodjacMaster"];
                $izvodjac2= $row2["izvodjacMaster"];
            }

            if(empty($izvodjac2)){
                ?> <div class="info"><h2><span class="boja">Izvođač:</span><a href="izvodjac.php?izvodjac=<?php echo str_replace(" ", "-", $this->izvodjacMaster)?>"> <?php echo $this->izvodjacMaster?> </a></h2> 
                <?php
            }

            elseif($this->izvodjaciGrupa===null || $this->izvodjaciGrupa== "")
            {
                 ?> <div class="info"><h2><span class="boja">Izvođač:</span><a href="izvodjac.php?izvodjac=<?php echo str_replace(" ", "-", $this->izvodjacMaster)?>"> <?php echo $this->izvodjacMaster?> </a> & <a href="izvodjac.php?izvodjac=<?php echo str_replace(" ", "-", $izvodjac2)?>"> <?php echo $izvodjac2?> </a></h2> 
                <?php
            }else
                {
                    ?> <div class="info"><h2><span class="boja">Izvođač:</span><a href="grupe.php?grupa=<?php echo str_replace(" ", "-", $this->izvodjacMaster)?>"> <?php echo $this->izvodjacMaster?> </a></h2>
                    <?php 
                }
            ?>
                <h2><span class="boja">Album:</span> <?php echo $this->nazivAlbuma; ?></h2>
                <?php
                if(empty($this->tacanDatumIzdanja))
                {
                    ?>
                    <h3><span class="boja">Godina izdanja: </span><a href="pogodini.php?godina=<?php echo $this->godinaIzdanja; ?>"><?php echo $this->godinaIzdanja; ?></a></h3>
                    <?php
                }else
                    {
                        ?>
                        <h3><span class="boja">Godina izdanja: </span><a href="pogodini.php?godina=<?php echo $this->godinaIzdanja; ?>"><?php echo $this->tacanDatumIzdanja; ?></a></h3>
                        <?php
                    }
                ?>
                <h3><span class="boja">Izdavač:</span> <?php echo $this->viseIzdavaca($this->izdavac); ?></h3>
            </div> <!-- kraj info -->
            
            <!-- Slike albuma -->
            
            <div class="slikeIzabranogAlbuma ">
            <a href="images/albumi/<?php echo $this->slikaAlbuma; ?>" data-lightbox="slika-1"><img src="images/albumi/<?php echo $this->slikaAlbuma; ?>" alt="<?php echo $this->slikaAlbuma; ?>" title="<?php echo $this->slikaAlbuma; ?>"></a>
            </div> <!-- kraj slikeAlbuma -->
            </div><!-- /.pregledAlbuma -->
            <?php
            //$this->ostaliAlbumi($da);
        } //end while loop
    }// end function prikazAlbuma
    //********************************* Pozvana metoda u oalbumu.php *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------

    //********************************* Prikaz ostalih albuma izabranog izvodjaca *********************************//
    public function ostaliAlbumi() 
    {
        global $conn;
        global $idD;
        global $nDr;
        $q= "SELECT * FROM albumi
        WHERE idIzvodjacAlbumi='{$this->idIzvodjacAlbumi}' OR idIzvodjac2='{$this->idIzvodjacAlbumi}' ORDER BY godinaIzdanja";
	
        $select_album= mysqli_query($conn, $q);
        ?>
        <div class="albumPrikaz">
        <div class="slikeAlbuma">
        <?php
        echo "<hr>";
        echo "<h3>Ostali albumi - <span class='boja'>". $this->izvodjacMaster . "</span></h3>";//-----
        while($row= mysqli_fetch_array($select_album))
        {
            $this->idAlbum= $row["idAlbum"];
            $izvodjacAlbumi_id= $row["idIzvodjacAlbumi"];
            $nazivAlbuma= $row["nazivAlbuma"];
            $godinaIzdanja= $row["godinaIzdanja"];
            $izdavac= $row["izdavac"];
            $slikaAlbuma= $row["slikaAlbuma"];
            $drzavaAlbumi= $row["drzavaAlbumi"];
            $entitetAlbumi= $row["entitetAlbumi"];
            //$idDrzave= $row["idDrzave"];
            //data-lightbox="slika-2" // unutar taga da uveća sliku. Svaki broj posebna galerija
            ?>
            <div class="card">
            <a href="oalbumu.php?izv=<?php echo $this->idIzvodjacAlbumi."&album=".$this->idAlbum."&naziv=".str_replace(" ", "-", $this->izvodjacMaster)."-".str_replace(" ", "-", $this->nazivAlbuma); ?>" ><img src="images/albumi/<?php echo $slikaAlbuma; ?>" alt="<?php echo $nazivAlbuma; ?>" title="<?php echo $nazivAlbuma; ?>"></a>
            </div><!-- end .card -->
            <?php
        }
        ?>
            </div><!-- end .slikeAlbuma -->
            </div><!-- end .albumPrikaz -->
            <hr>
        <?php
    }// end function ostaliAlbumi
    //********************************* Pozvana metoda u oalbumu.php *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------

    //********************************* Prikaz svih albuma objavljenih u nekoj godini *********************************//
    public function poGodini($param){
        global $conn;
        $q= "SELECT godinaIzdanja FROM albumi WHERE godinaIzdanja='{$param}'";
        $select_godinu= mysqli_query($conn, $q);
        
        while($row= mysqli_fetch_assoc($select_godinu))
        {
            $this->godinaIzdanja= $row["godinaIzdanja"];

        
            ?>
            <div class="albumPrikaz">
            <h1><?php echo $this->godinaIzdanja; ?></h1>
            <?php

            $q2= "SELECT * FROM albumi JOIN izvodjaci ON izvodjaci.idIzvodjaci= albumi.idIzvodjacAlbumi WHERE godinaIzdanja='{$param}'";
            $select_godinu= mysqli_query($conn, $q2);

            ?> 
            <div class="slikeAlbumaPregled">
            <?php
            while($row= mysqli_fetch_assoc($select_godinu))
            {
                $this->albumId= $row["idAlbum"];
                $this->idIzvodjacAlbumi= $row["idIzvodjacAlbumi"];
                $this->nazivAlbuma= $row["nazivAlbuma"];
                $this->godinaIzdanja= $row["godinaIzdanja"];
                $this->izdavac= $row["izdavac"];
                $this->slikaAlbuma= $row["slikaAlbuma"];
                $this->drzavaAlbumi= $row["drzavaAlbumi"];
                $this->entitetAlbumi= $row["entitetAlbumi"];
                $this->izvodjacMaster= $row["izvodjacMaster"];
                
                
                ?>
                <div class="card card-size1">
                <a href="oalbumu.php?izv=<?php echo $this->idIzvodjacAlbumi."&album=".$this->albumId."&naziv=".str_replace(" ", "-", $this->izvodjacMaster)."-".str_replace(" ", "-", $this->nazivAlbuma); ?>" >
                <img src="images/albumi/<?php echo $this->slikaAlbuma; ?>" alt="<?php echo $this->slikaAlbuma; ?>" title="<?php echo $this->izvodjacMaster . " - " . $this->nazivAlbuma; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $this->izvodjacMaster . " - " . $this->nazivAlbuma; ?></h5>
                    <p class="card-text2"><?php echo $this->izdavac; ?></p>
                </div><!-- end .card-body -->   
                </a>
                </div><!-- end .card -->
                
                <?php
                
            }/**** end while 2 ****/
         ?> 
         </div><!-- end .slikeAlbuma -->
         </div><!-- end .albumPrikaz -->
         <?php
        }/**** end while 1 ****/
    }

    //********************************* Pozvana metoda u pogodini.php *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------

    //********************************* Prikaz informacija o Grupama *********************************//
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
                echo "Nema podataka o ovoj grupi.";
            }else
                {
                    echo "<h1>$this->nazivGrupe</h1>";
                }
            
                
        }
    }
    //********************************* Pozvana metoda u grupe.php *********************************//
        
    //--------------------------------------------------------------------------------------------------------------------------------
    
    //*********************************Metoda za razdvajanje ako ima više izdavača *********************************/
    public function viseIzdavaca($param)
    {
        $nizIzd= explode(", ", $param);
        $niz4= explode(" & ", $param);
        
        foreach($nizIzd as $ime)
        {
            
                ?>
                    <a href="label.php?izdavac=<?php echo str_replace(" ", "-", $ime); ?>"><?php echo $ime; ?></a><?php
                    if(next($nizIzd))
                    {
                        echo ", ";
                    }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                
            
        }// end foreach loop
    }// end function fit
    //******************************* Pozvana metoda u ovom fajlu (više puta) u metodi prikazAlbuma() *******************************//

}// end class albumDetalji