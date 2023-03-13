<?php
include "../../config/config.php";

if(isset($_POST["ulogujSe"]))
{
    //echo "radi";
    
    $username= strip_tags($_POST["username"]);
    $sifra= strip_tags($_POST["password"]);

    $cleanUsername= removeSimbols($username);
    $cleanSifra= removeSimbols($sifra);

    $sifrovano=md5($cleanSifra);

    $q= "SELECT * FROM korisnici WHERE username='$cleanUsername' AND sifra='$sifrovano'";
    $loginKorisnika= mysqli_query($conn, $q);

    
        while($row= mysqli_fetch_assoc($loginKorisnika))
        {
        $uName= $row["username"];
        $logSifra= $row["sifra"];
        $ime= $row["ime"];
        }
        if($sifrovano=== $logSifra){

        echo $uName . "<br>" . $logSifra; 
        
    }else{
        echo "pogrešna šifra";
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

function removeSimbols($param)
{
    $param= str_replace("'", "", $param);
    $param= str_replace("<", "", $param);
    $param= str_replace(">", "", $param);
    $param= str_replace("-", "", $param);
    $param= str_replace("#", "", $param);
    $param= str_replace("$", "", $param);
    $param= str_replace("*", "", $param);
    $param= str_replace("|", "", $param);
    $param= str_replace("\\", "", $param);
    $param= str_replace("~", "", $param);
    $param= str_replace("ˇ", "", $param);
    $param= str_replace("^", "", $param);
    $param= str_replace("{", "", $param);
    $param= str_replace("}", "", $param);
    $param= str_replace(";", "", $param);

    return $param;
}