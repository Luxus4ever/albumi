<?php
include "../config/config.php";
include "../subfolder/header.php";
//include "../../css/style.css";
include "../functions/removeSymbols.func.php";
?>
<div class="slikeAlbumaPregled sredina">
    <main>

<?php

$putanja= "../header.php";
//echo basename($putanja);
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
            $sifra2= removeSimbols($_POST["password2"]);
            $grad= removeSimbols($_POST["grad"]);
            $facebookPr= removeLinksSocialMedia($_POST["facebookLog"]);
            $instagramPr= removeLinksSocialMedia($_POST["instagramLog"]);
            $twitterPr= removeLinksSocialMedia($_POST["twitterLog"]);
            $tiktokPr= removeLinksSocialMedia($_POST["tiktokLog"]);
            $sajt= checkLinks($_POST["sajtLog"]);
            $profilnaSlika= removeSimbolsImg($_FILES["profilnaSlika"]["name"]);

            
            $regex = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$/';
            if (preg_match($regex, $email)) 
            {

            $maxVelicinaSlike= 2097152; //2mb
            $size= $_FILES["profilnaSlika"]["size"];
            //print_r($size) . "<hr>";
            if(($size > $maxVelicinaSlike) || ($size==0))
            {  
                echo "Prevelika slika"; 
            }else
                {
                    $putanja = "../images/profilne/";
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
                            $cleanGrad= removeSimbols($grad);
                            $cleanFacebookPr= removeSimbols($facebookPr);
                            $cleanInstagramPr= removeSimbols($instagramPr);
                            $cleanTwitterPr= removeSimbols($twitterPr);
                            $cleanTiktokPr= removeSimbols($tiktokPr);
                            


                            $cleanSifra= removeSimbols($sifra);
                            $cleanSifra2= removeSimbols($sifra2);

                            $sifrovano= md5($cleanSifra);

                            //echo $cleanTipKorisnika. "<hr>";
                            $q2= "SELECT username, email FROM korisnici";
                            $provjera= mysqli_query($conn, $q2);
                            //if(mysqli_num_rows($provjera)>0)
                            while($row= mysqli_fetch_array($provjera))
                            {
                                $prov_username= $row["username"];
                                $prov_email= $row["email"];
                                if($prov_username===$cleanUsername){
                                    echo "<h1>Korisničko ime je zauzeto, probajte sa nekim drugim</h1>";
                                    ?> 
                                    <?php
                                }else
                                if($prov_email===$cleanEmail)
                                    {
                                        echo "<h1>Email adresa je zauzeta, probajte sa nekom drugom</h1>";
                                    }else
                                        {

                            

                                            $q= "INSERT INTO korisnici (ime, prezime, email, username, pol, tipKorisnika, drzava, sifra, sifra2, grad, facebookPr, instagramPr, twitterPr, tiktokPr, websajt, profilnaSlika, datumRegistracije) 
                                            VALUES ('$cleanIme', '$cleanPrezime', '$cleanEmail', '$cleanUsername', '$cleanPol', '$cleanTipKorisnika', '$cleanDrzava', '$sifrovano', '$cleanSifra2', '$cleanGrad', '$cleanFacebookPr', '$cleanInstagramPr', '$cleanTwitterPr', '$cleanTiktokPr', '$sajt', '$profilnaSlika', now())";
                                            $ubaciKorisnike= mysqli_query($conn, $q);

                                        

                                            if($ubaciKorisnike == TRUE)
                                            {
                                                echo "<h1>Registracija uspješna!<br><br>


                                                Bićete presumjerni na stranicu da se ulogujete.<h1>";
                                                //echo "<meta http-equiv='refresh' content='5'; url='https://google.com'>";
                                                ?>
                                                <script>
                                                        setTimeout(function () {
                                                        window.location.href = "../users/login.php"; //will redirect to your blog page (an ex: blog.html)
                                                        }, 5000)
                                                    
                                                    </script>
                                                <?php
                                            }else{
                                                echo "Greška " . mysqli_error($conn). "<br>";
                                                //echo "Greška <br>";
                                            }
                                
                                        }//end else INSERT
                            }//end while loop provjera korisničkog imena i šifre
                        }//end provjera ekstenzije
                }//nastavak unosa nakon provjere veličine slike
            }//end provjera emaila
        }else{
            echo "Nije vam ista šifra u polju jedan i u polju za ponovni unos šifre";
        }//end provjera šifre $password===$password2
    }else{
        echo "Niste unijeli sve podatke!";
        echo '<meta http-equiv="refresh" content="5; url=../../registracija.php">';
    }//end if(!empty([])) provjera unosa svih polja forme
}//end master if()






?>
    </main>
</div>
<?php
include "../subfolder/footer.php";




