<?php
include "../config/config.php";
include "../subfolder/header.php";
include_once "../functions/removeSymbols.func.php";

?>
<div class="wrapper">
    <div class="slikeAlbumaPregled sredina">
        <?php
if(isset($_POST["ulogujSe"]))
{
    //echo "radi";
    
    $username= strip_tags($_POST["username"]);
    $logSifra= strip_tags($_POST["password"]);

    $cleanUsername= removeSimbols($username);
    $cleanSifra= removeSimbols($logSifra);

    $sifrovano=md5($cleanSifra);

    $q= "SELECT * FROM korisnici WHERE username='$cleanUsername' AND sifra='$sifrovano'";
    $loginKorisnika= mysqli_query($conn, $q);

    
        while($row= mysqli_fetch_assoc($loginKorisnika))
        {
        $uName= $row["username"];
        $logSifra= $row["sifra"];
        $ime= $row["ime"];
        $lid= $row["idKorisnici"];
        }
        if($cleanUsername===@$uName && $sifrovano=== $logSifra){

        //echo $uName . "<br>" . $logSifra ."<br>" . $lid; 

        $q2= "UPDATE korisnici SET zadnjiLogin=now() WHERE username='{$cleanUsername}'";
        $zl= mysqli_query($conn, $q2);

        @session_start();
        $_SESSION["idKorisnici"]= $lid;
        $_SESSION["username"]= $cleanUsername;
        date_default_timezone_set('Europe/Belgrade');
        $_SESSION["vrijeme"]= date('d-m-Y H:i:s');
        
        //$_SESSION["password"]= $sifrovano;
        ?> 
        
        <meta http-equiv="refresh" content="0; url=../profile.php?username=<?php echo $uName . '&lid=' . $lid; ?>">
        <?php
        
    }else{
        echo "<h1>Pogrešna šifra</h1>";
    ?>        
        
        <meta http-equiv="refresh" content="3; url=../users/login.php">
    <?php
    }
    
    

}
 
//print_r($ime);
/*print_r(hash_algos());
echo "<br>";

echo md5(123);

echo "<br>";

echo hash("gost", 123);
echo "<br>";
echo hash("gost-crypto", 123);*/



?>
        </div><!--  kraj .slikeAlbumaPregled -->
    </div><!-- kraj #wrapper -->

    <?php

include "../subfolder/footer.php";