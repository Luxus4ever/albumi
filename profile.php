<?php 
include "config/config.php";
include "classes/detaljiAlbum.class.php";
include "classes/user.class.php";
include "functions/master.func.php";
include "header.php";
?>
<div id="wrapper">
<div class="slikeAlbumaPregled sredina">
    <main>
<?php

@$profil= $_GET["username"];
@$lid=$_GET["lid"];
@$sesId= $_SESSION["idKorisnici"];
@$sesVrijeme= $_SESSION["vrijeme"];

//print_r(hash_algos());

echo "<br><br>";

//echo hash("gost-crypto",$lid)."<br>";


//echo $lid . " " . $sesId;
//echo $sesVrijeme;
//echo "<br>";
//echo $sesId;

//global $conn;
$q="SELECT zadnjiLogin FROM korisnici WHERE idKorisnici=$lid";
$proba= mysqli_query($conn, $q);

while($row= mysqli_fetch_array($proba))
{
    $zadnjiLogin= $row['zadnjiLogin'];

    date_default_timezone_set('Europe/Belgrade');
    $now = date("d-m-Y h:i:s a");
    //echo "<br>$now<br>";
    //echo $zona;
    // calculate the difference
    $difference = strtotime($now) - strtotime($zadnjiLogin);
    $difference_in_minutes = $difference / 60;

    //echo "<br>$difference<br>";
    //echo "<br>$difference2<br>";

    //echo "<br>$difference_in_minutes<br>";

    if($difference_in_minutes < 3){
        // set online status
    //$updateStatus = 'UPDATE Users SET Status="online" WHERE lastOnline="'.$user['lastOnline'].'"';
    echo "korisnik je ONLINE";
    } else {
        // set offline status
        //$updateStatus = 'UPDATE Users SET Status="offline" WHERE lastOnline="'.$user['lastOnline'].'"';
        echo "Korisnik je offline";
    }
}

    
$d= time();
echo "<br>";

    


if(empty($profil) || empty($lid)){
    echo ("<h1>Ne možete da pristupite ovom dijelu bez validnih podataka.</h1>");
}else{
    detailsUser($profil, $lid, $sesId);
}

?>
        </main>
    </div> <!-- kraj .slikeAlbumaPregled -->
</div> <!-- kraj #wrapper -->
<?php
include "footer.php";


