<?php

//********************************* Prikaz svih albuma po izabranoj državi *********************************//
function sviAlbumiPoDrzavi($imeDrzave)
{
    global $conn;
    $q= "SELECT * FROM drzave JOIN albumi ON albumi.drzavaAlbumi=drzave.idDrzave
    JOIN izvodjaci ON izvodjaci.idIzvodjaci= albumi.idIzvodjacAlbumi
    WHERE nazivDrzave='{$imeDrzave}' ORDER BY RAND()";
    $select_albumi= mysqli_query($conn, $q);

    echo "<h1>$imeDrzave</h1>";
    ?>
    
    <div class="slikeAlbuma">
        <?php 
    while($row=mysqli_fetch_array($select_albumi))
    {
        $idAlbum= $row["idAlbum"];
        $idIzvodjacAlbumi= $row["idIzvodjacAlbumi"];
        $nazivAlbuma= $row["nazivAlbuma"];
        $godinaIzdanja= $row["godinaIzdanja"];
        $izdavac= $row["izdavac"];
        $slikaAlbuma= $row["slikaAlbuma"];
        $drzavaAlbumi= $row["drzavaAlbumi"];
        $entitetAlbumi= $row["entitetAlbumi"];
        $izvodjacMaster= $row["izvodjacMaster"];
        $idDrzave= $row["idDrzave"];
        $nazivDrzave= $row["nazivDrzave"];
        $entitet1= $row["entitet1"];
        $entitet2= $row["entitet2"];

        ?>
        
        <div class="card card-size2">
            <a href="oalbumu.php?izv=<?php echo $idIzvodjacAlbumi."&album=".$idAlbum."&naziv=".str_replace(" ", "-", $izvodjacMaster)."-".str_replace(" ", "-", $nazivAlbuma); ?>" >
                <img class="card-img-top" src="images/albumi/<?php echo $slikaAlbuma; ?>" alt="<?php echo $slikaAlbuma; ?>" title="<?php echo $izvodjacMaster . " - " . $nazivAlbuma; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $izvodjacMaster . " - " . $nazivAlbuma; ?></h5>
                    <p class="card-text1"><span class="godinaIzd"><?php echo $godinaIzdanja . "</span>"; ?></p>
                    <p class="card-text2"><?php echo $izdavac; ?></p>
                </div><!-- end .card-body -->    
            </a>
        </div><!-- end .card -->
            
        

        
        <?php
    }
    ?>
        </div><!-- end .slikeAlbuma -->

<?php

}

//********************************* Metoda pozvana u drzava.php *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

