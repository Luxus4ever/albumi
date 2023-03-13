<?php

class izvodjacDetalji{

    public $idIzvodjaci;
    public $izvodjacMaster;
    public $ime;
    public $prezime;
    public $slikaIzvodjac;
    public $biografija;
    public $nazivDrzave;
    public $nadimci;

    public function biografija($param)
    {
        global $conn;
        //$q= "SELECT * FROM izvodjaci WHERE izvodjacMaster='{$param}'";
        $q= "SELECT idIzvodjaci, izvodjacMaster, ime, prezime, slikaIzvodjac, izvodjaciGrupa, biografija, nazivDrzave, entitetIzvodjac, nadimciIzvodjac FROM izvodjaci JOIN drzave ON drzave.idDrzave=izvodjaci.drzavaIzvodjac WHERE izvodjacMaster='{$param}'";
        $select_artist= mysqli_query($conn, $q);
        include "functions/master.func.php";
        while($row= mysqli_fetch_assoc($select_artist))
        {
            $this->idIzvodjaci= $row["idIzvodjaci"];
            $this->izvodjacMaster= $row["izvodjacMaster"];
            $this->ime= $row["ime"];
            $this->prezime= $row["prezime"];
            $this->slikaIzvodjac= $row["slikaIzvodjac"];
            $this->biografija= nl2br($row["biografija"]);
            /*$album= $row["albumId"];
            $izvodjac= $row["izvodjacId"];*/
            $this->nazivDrzave= $row["nazivDrzave"];
            $this->nadimci= $row["nadimciIzvodjac"];
            $idIzvodjacAlbumi= $this->idIzvodjaci;
            
            
            echo "<h3 class='drzavaTekstovi'><span class='boja'>Država:</span> " . $this->nazivDrzave . "</h3>"; 
            echo "<h2 class='tekstNaziv'>" . $this->izvodjacMaster . "</h2><br>"; 
            echo "<h2><span class='tekstNaziv'>Ime i prezime: </span>" . $this->ime . " " . $this->prezime . "</h2>";
            echo "<h3><span class='tekstNaziv'>Ostala imena: </span>" . $this->nadimci . "</h3><br>";  
            echo "<div class='slikaIzvodjac'><img src='images/izvodjaci/srbija/{$this->slikaIzvodjac}'></div>"; 
            echo "<br><br>";

            if(empty($this->biografija)){
                echo "<h2>Nema dostupnih informacija!</h2>";
            }else{
                echo "<p class='o-izvodjacu-tekst'>$this->biografija</p>";
            }

            sviAlbumi($this->idIzvodjaci, $this->izvodjacMaster);

        }
        
    }
    //********************************* Pozvana metoda u izvodjac.php *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------

    public $albumId;
    public $idIzvodjacAlbumi;
    public $nazivAlbuma;
    public $godinaIzdanja;
    public $izdavac;
    public $slikaAlbuma;
    public $drzavaAlbumi;
    public $entitetAlbumi;

    public function izdavaci($param)
    {
        global $conn;
        $q= "SELECT * FROM albumi WHERE izdavac='{$param}'";
        $select_artist= mysqli_query($conn, $q);

        while($row= mysqli_fetch_assoc($select_artist))
        {
            $this->albumId= $row["idAlbum"];
            $this->idIzvodjacAlbumi= $row["idIzvodjacAlbumi"];
            $this->nazivAlbuma= $row["nazivAlbuma"];
            $this->godinaIzdanja= $row["godinaIzdanja"];
            $this->izdavac= $row["izdavac"];
            $this->slikaAlbuma= $row["slikaAlbuma"];
            $this->drzavaAlbumi= $row["drzavaAlbumi"];
            $this->entitetAlbumi= $row["entitetAlbumi"];
            ?>

            <div class="slikeAlbuma">
            <a href="oalbumu.php?izvodjac=<?php echo $this->idIzvodjacAlbumi; ?>&album=<?php echo $this->albumId; ?>" >
            <img src="images/albumi/<?php echo $this->slikaAlbuma; ?>" alt="<?php echo $this->slikaAlbuma; ?>" title="<?php echo $this->nazivAlbuma; ?>">
            </a>
            </div>
            <?php
        }
    }

    //--------------------------------------------------------------------------------------------------------------------------------

    
}