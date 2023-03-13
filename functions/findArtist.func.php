<?php
function nadjiIzvodjaca($rezultat)
{ 
    global $conn;
/*    echo "<h2>Izvođači:</h2>";
    //$dzoker= nadjiIzvodjaca($rezultat);
    $q2= "SELECT * FROM izvodjaci WHERE izvodjacMaster LIKE '%$rezultat%' OR nadimciIzvodjac LIKE '%$rezultat%'";
    $select_rez2= mysqli_query($conn, $q2);
    if(mysqli_num_rows($select_rez2)===TRUE)
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

*/

    $q2= "SELECT izvodjacMaster FROM izvodjaci WHERE izvodjacMaster LIKE '%$rezultat%' OR nadimciIzvodjac LIKE '%$rezultat%'";
    $select_rez2= mysqli_query($conn, $q2);
    
        while($row2=mysqli_fetch_array($select_rez2)){
            $izvodjac2= $row2["izvodjacMaster"];
        ?>
            <a href="izvodjac.php?izvodjac=<?php echo $izvodjac2; ?>"><?php echo $izvodjac2; ?></a> <br>
            <?php
        
        
        }
    
        echo "<hr>";

}