<?php

class detaljiLabel{
    
    public $albumId;
    public $idIzvodjacAlbumi;
    public $izvodjacMaster;
    public $nazivAlbuma;
    public $godinaIzdanja;
    public $izdavac;
    public $slikaAlbuma;
    public $drzavaAlbumi;
    public $entitetAlbumi;
    protected $label;

    public function izdavaci($param)
    {
        global $conn;
       
            $q= "SELECT * FROM albumi JOIN izvodjaci ON izvodjaci.idIzvodjaci= albumi.idIzvodjacAlbumi WHERE albumi.izdavac LIKE '%{$param}%'";
            $select_izdavac=$conn->query($q);
          
            if(mysqli_num_rows($select_izdavac)>0)
                {
            ?>
            <div class="slikeAlbumaPregled">
                <?php
            while ($row= mysqli_fetch_array($select_izdavac))
            {
                $this->label= $row["izdavac"];
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
            <img src="images/albumi/<?php echo $this->slikaAlbuma; ?>" alt="<?php echo $this->slikaAlbuma; ?>" title="<?php echo $this->nazivAlbuma; ?>">
            <div class="card-body">
                    <h5 class="card-title"><?php echo $this->izvodjacMaster . " - " . $this->nazivAlbuma; ?></h5>
                    <p class="card-text1"><?php echo $this->godinaIzdanja; ?></p>
                </div><!-- end .card-body -->   
            </a>
            </div><!-- end .card -->
            <?php
        }
        ?>
        </div><!-- end .slikeAlbuma -->
        <?php
    }else{
        echo "Nema podataka";
    }
    }// end function izdavaci

    //********************************* Metoda pozvana u label.php *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------

    //*********************************Metoda za razdvajanje više izdavača *********************************/
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
    //******************************* Pozvana metoda u ovom fajlu (više puta) u metodi tabelaPjesme() *******************************//

}