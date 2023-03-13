<?php

//********************************* Prikaz broja dodatih albuma po državam na početnoj *********************************//

function brojAlbuma($idDrzaveParam="")
{
    global $conn;
    $q= "SELECT count(drzavaAlbumi) AS ukupnoAl FROM albumi WHERE drzavaAlbumi= '{$idDrzaveParam}'";
    $brAlb= mysqli_query($conn, $q);

    while($row= mysqli_fetch_assoc($brAlb))
    {
        $brojAl= $row["ukupnoAl"];
    }
    
    /*if($this->drzavaAlbumi==){
        echo 
    }*/
    //echo $this->brojAl;
    return $brojAl;
}
//********************************* Pozvana metoda u ovom fajlu u metodi nazivDrzave() *********************************//


//********************************* Prikaz naziva država na početnoj *********************************//
    //public $idDrzave;
    //public $nazivDrzave;
    function nazivDrzave()
    {
        global $conn;
        $q= "SELECT * FROM drzave";
        $select_drzave= mysqli_query($conn,$q);

        while($row= mysqli_fetch_array($select_drzave))
        {
            $idDrzave= $row['idDrzave'];
            $nazivDrzave= $row['nazivDrzave'];

            ?>
            <div class="naslovna5">
            <h1 class="drzava">
                <span class="boja"></span>
                <a href="drzava.php?nazivdrzave=<?php echo str_replace(" ", "-", $nazivDrzave); ?>"><?php echo $nazivDrzave; ?></a>
            </h1>
            
            <br><?php 
            $sviAlb= new albumDetalji();

            $sviAlb->sviAlbumi($idDrzave, $nazivDrzave); ?>

            <br>
            <p>Trenutno dodatih albuma za državu <?php echo $nazivDrzave . " je " .  brojAlbuma($idDrzave);  ?></p><br>
            </div>
            <hr>
            <?php 
            
            
        }
    }
    //********************************* Pozvana metoda u index.php *********************************//