<link href="css/style.css" rel="stylesheet">
<?php
include_once "config/config.php";
global $conn;

$q= "SELECT idDrzave, nazivDrzave, entitet1, entitet2, idEntiteti, entitet FROM drzave JOIN entiteti ON entiteti.idEntiteti=drzave.entitet1 OR entiteti.idEntiteti=drzave.entitet2";
$ispis= mysqli_query($conn, $q);

while($row= mysqli_fetch_array($ispis)){
    $idDrzave= $row['idDrzave'];
    $nazivDrzave= $row['nazivDrzave'];
    $entitet1= $row['entitet1'];
    $entitet2= $row['entitet2']; 
    $idEntiteti= $row['idEntiteti'];
    $entitet= $row['entitet'];

    $nizz= array($idEntiteti);

    echo '<div class="naslovna5">';
    //echo $idDrzave . ". " . $nazivDrzave . $entitet1 . "<br>" . $entitet2 . sviAlbumi($idDrzave) ."<hr>";
    ?>
    <h1 class="drzava">
        <span class="boja"></span>
        <a href="drzava.php?nazivdrzave=<?php echo str_replace(" ", "-", $nazivDrzave); ?>"><?php echo $nazivDrzave; ?></a><br>
    </h1>
    <?php
    /*for($i=0; $i<count($nizz); $i++)
    {
        echo $entitet;
        echo $idEntiteti;
    }*/
    ?>
        <h3><a href="drzava.php?nazivdrzave=<?php echo str_replace(" ", "-", $entitet1); ?>"><?php echo $entitet; ?></a></h3>
        <h3><a href="drzava.php?nazivdrzave=<?php echo str_replace(" ", "-", $entitet2); ?>"><?php echo $entitet; ?></a></h3>
    
    <?php 
    sviAlbumi($idEntiteti);
    echo '</div><hr>';

}

//echo $idDrzave;

function sviAlbumi($idDrzaveParam)
{
    global $conn;
$q= "SELECT * FROM albumi 
        JOIN izvodjaci ON izvodjaci.idIzvodjaci= albumi.idIzvodjacAlbumi
        JOIN drzave ON drzave.idDrzave= izvodjaci.drzavaIzvodjac
        WHERE entitetAlbumi='{$idDrzaveParam}' ORDER BY RAND() LIMIT 6";
        $select_album= mysqli_query($conn, $q);
        ?>
        <div class="slikeAlbuma">
        <?php
        while($row= mysqli_fetch_assoc($select_album))
        {
            $albumId= $row["idAlbum"];
            $idIzvodjacAlbumi= $row["idIzvodjacAlbumi"];
            $idIzvodjac2= $row["idIzvodjac2"];
            $nazivAlbuma= $row["nazivAlbuma"];
            $godinaIzdanja= $row["godinaIzdanja"];
            $izdavac= $row["izdavac"];
            $slikaAlbuma= $row["slikaAlbuma"];
            $drzavaAlbumi= $row["drzavaAlbumi"];
            $entitetAlbumi= $row["entitetAlbumi"];
            $tacanDatumIzdanja= $row["tacanDatumIzdanja"];
            $izvodjacMaster= $row["izvodjacMaster"];
            $nadimci= $row["nadimciIzvodjac"];
            $entitet1= $row["entitet1"];
            $entitet2= $row["entitet2"];
            ?>

            

            
            <?php
            if($idIzvodjac2==null)
            {
                ?>
                <a href="oalbumu.php?izv=<?php echo $idIzvodjacAlbumi."&album=".$albumId."&naziv=".str_replace(" ", "-", $izvodjacMaster)."-".str_replace(" ", "-", $nazivAlbuma); ?>" >
            <img src="images/albumi/<?php echo $slikaAlbuma; ?>" alt="<?php echo $slikaAlbuma; ?>" title="<?php echo $izvodjacMaster . " - " . $nazivAlbuma; ?>">
            </a>
            <?php
            }
        }
}