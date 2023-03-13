<?php

//********************************* Prikaz svih albuma izabranog izvodjaca *********************************//
function sviAlbumi($idIzvodjacAlbumi, $izvodjacMaster) 
{
    global $conn;
    $q= "SELECT * FROM albumi
    WHERE idIzvodjacAlbumi='{$idIzvodjacAlbumi}' OR idIzvodjac2='{$idIzvodjacAlbumi}' ORDER BY godinaIzdanja";

    $select_album= mysqli_query($conn, $q);
    ?>
    <div class="ostaliAlbumi">
    <div class="slikeAlbuma">
    <?php
    echo "<hr>";
    echo "<h3>Ostali albumi - <span class='boja'>". $izvodjacMaster . "</span></h3>";//-----
    while($row= mysqli_fetch_array($select_album))
    {
        $idAlbum= $row["idAlbum"];
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
        <a href="oalbumu.php?izv=<?php echo $idIzvodjacAlbumi."&album=".$idAlbum."&naziv=".$izvodjacMaster."-".$nazivAlbuma; ?>" ><img src="images/albumi/<?php echo $slikaAlbuma; ?>" alt="<?php echo $nazivAlbuma; ?>" title="<?php echo $nazivAlbuma; ?>"></a>
        </div><!-- end .card -->
        <?php
    }
    ?>
        </div><!-- end .slikeAlbuma -->
        </div><!-- end .albumPrikaz -->
    <?php
}// end function ostaliAlbumi
//********************************* Pozvana metoda u izvodjac.php *********************************//