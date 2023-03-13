<?php
include "../../config/config.php";
include "../../header.php";
//include "../../css/style.css";

$putanja= "../header.php";
echo basename($putanja);
//if(isset($_POST['ime']) && $_POST['prezime'] && $_POST['username'] && $_POST['password'])
if(isset($_POST["posalji"]))
{
    if(!empty($_POST["ime"]) && !empty($_POST["prezime"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["pol"]) && !empty($_POST["drzava"]) && !empty($_POST["tipKorisnika"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) )
    {
        if($_POST["password"]===$_POST["password2"])
        {
            $whitelist = array(".jpg",".jpeg",".gif",".png", ".svg", ".webp"); 
            
            $ime= strip_tags($_POST["ime"]);
            $prezime= strip_tags($_POST["prezime"]);
            $email= strip_tags($_POST["email"]);
            $username= strip_tags($_POST["username"]);
            $pol= strip_tags($_POST["pol"]);
            $drzava= strip_tags($_POST["drzava"]);
            $tipKorisnika= strip_tags($_POST["tipKorisnika"]);
            $sifra= strip_tags($_POST["password"]);
            $sifra2= strip_tags($_POST["password2"]);
            $profilnaSlika= removeSimbolsImg($_FILES["profilnaSlika"]["name"]);

            
            $maxVelicinaSlike= 2097152; //2mb
            $size= $_FILES["profilnaSlika"]["size"];
            //print_r($size) . "<hr>";
            if(($size > $maxVelicinaSlike) || ($size==0))
            {  
                echo "Prevelika slika"; 
            }else
                {
                    $putanja = "../../images/profilne/";
                    $skeniraj= scandir($putanja);
                    //print_r($skeniraj);

                    /*$provjeraEkstenzije1= pathinfo($putanja.$profilnaSlika);
                    $provjeraEkstenzije2= $provjeraEkstenzije1['extension'];*/

                    $imeSlike= $profilnaSlika;
                    $ukloniEkstenziju= explode(".", $imeSlike);
                    $ekstenzija= end($ukloniEkstenziju);
                    $vrijeme= "_im".date("dmY_His", time());

                    //if provjera ekstenzije
                    if (!(in_array(".".$ekstenzija, $whitelist))) 
                    {
                        die('Nepravilan format slike, pokušajte sa drugom slikom');
                    }else
                        {
                            $provjeraSlike= $putanja.$profilnaSlika;
                            if(!file_exists(($provjeraSlike)))
                            {
                                //$profilnaSlika_tmp= $_FILES["profilnaSlika"]["tmp_name"];
                                $profilnaSlika= removeSimbolsImg(str_replace($profilnaSlika, "$ukloniEkstenziju[0]$vrijeme.$ekstenzija", str_replace(" ", "_", $_FILES["profilnaSlika"]["name"])));
                                $profilnaSlika_tmp= $_FILES["profilnaSlika"]["tmp_name"];
                                move_uploaded_file($profilnaSlika_tmp, $putanja.$profilnaSlika);
                            }else
                                {
                                    /*Ovaj blok koda predstavlja da ukoliko se ponovi ime slike prilikom unosa da se doda novi broj npr image.jpg, da sledeća bude image(1).jpg.*/
                                    /*Brojač u for petlji je postavljen na 100 puta jer je pretpostavka da neće biti više od 2-3 unosa slike sa istim imenom ukoliko sami već ne preimenujemo sliku*/
                                    for($i=1; $i<100; $i++)
                                    {
                                        $imeNoveSlike= "$ukloniEkstenziju[0]($i).$ekstenzija";
                                        
                                        if(!in_array($imeNoveSlike, $skeniraj))
                                        {
                                            $profilnaSlika= removeSimbolsImg(str_replace($profilnaSlika, "$ukloniEkstenziju[0]($i)$vrijeme.$ekstenzija", str_replace(" ", "_", $_FILES["profilnaSlika"]["name"])));
                                            $profilnaSlika_tmp= $_FILES["profilnaSlika"]["tmp_name"];

                                            move_uploaded_file($profilnaSlika_tmp, $putanja.$profilnaSlika);
                                            break;
                                        }
                                    }//end for petlje
                                }//end else !file_exists(($provjeraSlike)
                                
                                
                            $cleanIme= removeSimbols($ime);
                            $cleanPrezime= removeSimbols($prezime);
                            $cleanEmail= removeSimbols($email);
                            $cleanUsername= removeSimbols($username);
                            $cleanPol= removeSimbols($pol);
                            $cleanTipKorisnika= removeSimbols($tipKorisnika);
                            $cleanDrzava= removeSimbols($drzava);
                            $cleanSifra= removeSimbols($sifra);
                            $cleanSifra2= removeSimbols($sifra2);

                            $sifrovano= md5($cleanSifra);

                            //echo $cleanTipKorisnika. "<hr>";
                            $q2= "SELECT * FROM korisnici";
                            $provjera= mysqli_query($conn, $q2);
                            //if(mysqli_num_rows($provjera)>0)
                            while($row= mysqli_fetch_array($provjera))
                            {
                                $prov_username= $row["username"];
                                $prov_email= $row["email"];
                                if($prov_username===$cleanUsername){
                                    echo "Korisničko ime je zauzeto, probajte sa nekim drugim";
                                }else
                                if($prov_email===$cleanEmail)
                                    {
                                        echo "Email adresa je zauzeta, probajte sa nekom drugom";
                                    }else{

                            

                            $q= "INSERT INTO korisnici (ime, prezime, email, username, pol, tipKorisnika, drzava, sifra, sifra2, profilnaSlika, datumRegistracije) 
                            VALUES ('$cleanIme', '$cleanPrezime', '$cleanEmail', '$cleanUsername', '$cleanPol', '$cleanTipKorisnika', '$cleanDrzava', '$sifrovano', '$cleanSifra2', '$profilnaSlika', now())";
                            $ubaciKorisnike= mysqli_query($conn, $q);

                            

                            if($ubaciKorisnike == TRUE)
                            {
                                echo "Registracija uspješna!


                                Bićete presumjerni na stranicu da se ulogujete.";
                            /*}else if("email"===$cleanEmail){
                                echo "Ovaj email je već zauzet, probajte neki drugi email";
                            }else if("username"===$cleanUsername){
                                echo "Ovo korisničko ime je već zauzeto, probajte neko drugo.";*/
                            }else{
                                //echo "Greška " . mysqli_error($conn). "<br>";
                                //echo "Greška <br>";
                                /*if(mysqli_num_rows($cleanUsername) > 0)
                                {
                                    echo "Imamo ovo korisničko ime";
                                }*/
                            }

                            /*switch($ubaciKorisnike=== FALSE){
                                case "email===$cleanEmail": echo "Ovaj email je već zauzet, probajte neki drugi email"; break;
                                case "username===$cleanUsername": echo "Ovo korisničko ime je već zauzeto, probajte neko drugo."; break;
                                default: echo "Uspjeh";
                            }*/

                            //echo removeSimbols($ime) . "<br>" . removeSimbols($prezime) . "<br>" . removeSimbols($email) . "<br>" . removeSimbols($username) . "<br>" . removeSimbols($sifra) . "<br>" . removeSimbols($tipKorisnika) . "<br>" . removeSimbols($drzava) . "<br>" . removeSimbols($pol) . "<br>" . $profilnaSlika;
                            /*echo ($cleanIme . "<br>" . $cleanPrezime . "<br>" . $cleanEmail . "<br>" . $cleanUsername . "<br>" . $cleanPol . "<br>" . $cleanTipKorisnika . "<br>" . $cleanDrzava . "<br>" . $sifrovano . "<br>" . $cleanSifra2 . "<br>" . $profilnaSlika . "<br>" . time());*/
                        
                    }
                        }
                        }//end provjera ekstenzije
                }//provjera veličine slike
        }else{
            echo "Nije vam ista šifra u polju jedan i u polju za ponovni unos šifre";
        }//end provjera šifre $password===$password2
    }else{
        echo "Niste unijeli sve podatke!";
        echo '<meta http-equiv="refresh" content="5; url=../../registracija.php">';
    }//end if(!empty([])) provjera unosa svih polja forme
}//end master if()








function removeSimbols($param)
{
    $param= str_replace("  ", " ", $param);
    $param= str_replace("'", "", $param);
    $param= str_replace("<", "", $param);
    $param= str_replace(">", "", $param);
    $param= str_replace("--", "", $param);
    $param= str_replace("#", "", $param);
    $param= str_replace("$", "", $param);
    $param= str_replace("*", "", $param);
    $param= str_replace("/", "", $param);
    $param= str_replace("|", "", $param);
    $param= str_replace("\\", "", $param);
    $param= str_replace("~", "", $param);
    $param= str_replace("ˇ", "", $param);
    $param= str_replace("^", "", $param);
    $param= str_replace("{", "", $param);
    $param= str_replace("}", "", $param);
    $param= str_replace(";", "", $param);


    $slova= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
    $tekst= ""; 
    for($i=0; $i<5; $i++) 
    { 
        $tekst.= $slova[rand(0, strlen($slova)-1)];
    }
    $param= str_replace(".php", "_".$tekst."_", $param);
    $param= str_replace("script", "_".$tekst."_", $param);
    $param= str_replace(".sql", "_".$tekst."_", $param);
    $param= str_replace(".txt", "_".$tekst."_", $param);
    $param= str_replace(".js", "_".$tekst."_", $param);
    $param= str_replace(".htm", "_".$tekst."_", $param);
    $param= str_replace(".cgi", "_".$tekst."_", $param);
    $param= str_replace(".exe", "_".$tekst."_", $param);
    $param= str_replace(".pl", "_".$tekst."_", $param);
    $param= str_replace(".asp", "_".$tekst."_", $param);
    $param= str_replace(".py", "_".$tekst."_", $param);
    $param= str_replace(".jpeg", "_".$tekst."_", $param);
    $param= str_replace(".jpg", "_".$tekst."_", $param);
    $param= str_replace(".gif", "_".$tekst."_", $param);
    $param= str_replace(".png", "_".$tekst."_", $param);
    $param= str_replace(".svg", "_".$tekst."_", $param);
    $param= str_replace(".webp", "_".$tekst."_", $param);
    $param= str_replace(".jfif", "_".$tekst."_", $param);
    $param= str_replace(".apng", "_".$tekst."_", $param);
    $param= str_replace(".avif", "_".$tekst."_", $param);

    
    

    return $param;
}

//********************************* Pozvana metoda u ovom fajlu u funkciji ocjeneProfila *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Uklanjanje odnosno izmjena svih nepotrebnih simbola za slike (više nego za unos običnog teksta) *********************************//
function removeSimbolsImg($param)
{
    $param= str_replace(" ", "_", $param);
    $param= str_replace("'", "", $param);
    $param= str_replace("<", "", $param);
    $param= str_replace(">", "", $param);
    $param= str_replace("--", "", $param);
    $param= str_replace("#", "", $param);
    $param= str_replace("$", "", $param);
    $param= str_replace("*", "", $param);
    $param= str_replace("/", "", $param);
    $param= str_replace("|", "", $param);
    $param= str_replace("\\", "", $param);
    $param= str_replace("~", "", $param);
    $param= str_replace("ˇ", "", $param);
    $param= str_replace("^", "", $param);
    $param= str_replace("{", "", $param);
    $param= str_replace("}", "", $param);
    $param= str_replace(";", "", $param);

    $param= str_replace("ć", "c", $param);
    $param= str_replace("Ć", "C", $param);
    $param= str_replace("č", "c", $param);
    $param= str_replace("Č", "C", $param);
    $param= str_replace("ž", "z", $param);
    $param= str_replace("Ž", "Z", $param);
    $param= str_replace("đ", "dj", $param);
    $param= str_replace("Đ", "Dj", $param);
    $param= str_replace("š", "s", $param);
    $param= str_replace("Š", "S", $param);


    $slova= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
    $tekst= ""; 
    for($i=0; $i<5; $i++) 
    { 
        $tekst.= $slova[rand(0, strlen($slova)-1)];
    }
    $param= str_replace(".php", "_".$tekst."_", $param);
    $param= str_replace("script", "_".$tekst."_", $param);
    $param= str_replace(".sql", "_".$tekst."_", $param);
    $param= str_replace(".txt", "_".$tekst."_", $param);
    $param= str_replace(".js", "_".$tekst."_", $param);
    $param= str_replace(".htm", "_".$tekst."_", $param);
    $param= str_replace(".cgi", "_".$tekst."_", $param);
    $param= str_replace(".exe", "_".$tekst."_", $param);
    $param= str_replace(".pl", "_".$tekst."_", $param);
    $param= str_replace(".asp", "_".$tekst."_", $param);
    $param= str_replace(".py", "_".$tekst."_", $param);
    
    

    return $param;
}

include "../../subfolder/footer.php";