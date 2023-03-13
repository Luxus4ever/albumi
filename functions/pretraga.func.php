<?php
//include "nadjiIzvodjaca.func.php";

function poAlbumima($rezultat)
    { 
        global $conn;
        
        //$q= "SELECT * FROM izvodjaci WHERE izvodjacMaster= '{$rezultat}'"; "%t%k%
        $q= "SELECT * FROM albumi JOIN izvodjaci ON izvodjaci.idIzvodjaci=albumi.idIzvodjacAlbumi WHERE izvodjacMaster LIKE '%$rezultat%' OR nazivAlbuma LIKE '%$rezultat%'";
        $select_rez= mysqli_query($conn, $q);
        if(mysqli_num_rows($select_rez)>0)
        {
            ?>
            <div class="albumPrikaz">
                <h2>Albumi:</h2>
                    <div class="slikeAlbumaPregled">
            <?php
            while($row=mysqli_fetch_array($select_rez))
            {
                $albumId= $row["idAlbum"];
                $izvodjac= $row["izvodjacMaster"];
                $album= $row["nazivAlbuma"];
                $slikaAlbuma= $row["slikaAlbuma"];
                $nazivAlbuma= $row["nazivAlbuma"];

                
                //if(!empty($izvodjac)) {
                    //echo "<hr>";
                    ?>
                    <div class="card">
                    <?php
                    //echo $izvodjac . " - " . $album. "<br>";
                    ?>
                        <a href="oalbumu.php?album=<?php echo $albumId."-".$nazivAlbuma; ?>">
                        <div class="caard-header">
                                <h5 class="card-title"><?php echo $izvodjac . " - " . $nazivAlbuma; ?></h5>
                        </div>
                        <div class="card-body">
                        </div><!-- end .card-body -->   
                            <img src="images/albumi/<?php echo $slikaAlbuma;?>">
                            
                        </a>
                    </div><!-- end .card -->
                    <?php
                    
                //}

            }
            ?>
            
            
        <?php
        }else{
            echo "Nema rezultata pretrage po albumima";
            }
            echo "<hr>";
}
    
//**************************************************************************************************** */
function poIzvodjacima($rezultat)
{ 
    global $conn;
    echo "<h2>Izvođači:</h2>";
    //$dzoker= nadjiIzvodjaca($rezultat);
    $q2= "SELECT * FROM izvodjaci WHERE izvodjacMaster LIKE '%$rezultat%' OR nadimciIzvodjac LIKE '%$rezultat%'";
    $select_rez2= mysqli_query($conn, $q2);
    if(mysqli_num_rows($select_rez2)>0)
    {
        while($row2=mysqli_fetch_array($select_rez2)){
            $izvodjac2= $row2["izvodjacMaster"];

                ?>
                <a href="izvodjac.php?izvodjac=<?php echo $izvodjac2; ?>"><?php echo $izvodjac2; ?></a> <br>
                <?php
            
            
            
        }
    }else
        {
        echo "Nema rezultata pretrage po izvođačima.";
        }
    echo "<hr>";
}
    
//**************************************************************************************************** */

function poPjesmama($rezultat)
{ 
    global $conn;
    echo "<h2>Pjesme:</h2>";
    $q3= "SELECT * FROM pjesme WHERE nazivPjesme LIKE '%$rezultat%' OR feat LIKE '%$rezultat%'";
    $select_rez3= mysqli_query($conn, $q3);
    if(mysqli_num_rows($select_rez3)>0)
    {
        while($row3=mysqli_fetch_array($select_rez3))
        {
            $idPjesme= $row3["idPjesme"];
            $pjesma= $row3["nazivPjesme"];
            $feat= $row3["feat"];

            ?>
            <a href="tekstovi.php?tekst=<?php echo $idPjesme; ?>"><?php echo $pjesma . " " . $feat ?></a> <br>
            <?php
            
        }
    }else
        {
            echo "Nema rezultata po pjesmama.";
        }
        ?>
            </div><!-- end .slikeAlbuma -->
        </div><!-- end .albumPrikaz -->
        <?php
}

//******************************* Sve funkcije su pozvane u search.php *******************************//