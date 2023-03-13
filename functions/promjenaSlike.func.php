<?php
function promjenaSlike($profilnaSlika, $profil, $lid)
{
    global $conn; 
    $whitelist = array(".jpg",".jpeg",".gif",".png", ".svg", ".webp"); 

    $maxVelicinaSlike= 2097152; //2mb
    $size= $_FILES["promjenaProfilneSlike"]["size"];
    //print_r($size) . "<hr>";
    if(($size > $maxVelicinaSlike) || ($size==0))
    {  
        echo "<script>
                    document.getElementById('promSlik').innerHTML='Prevelika slika';
        </script>"; 
    }else
        {
            $putanja = "images/profilne/";
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
                        //$profilnaSlika_tmp= $_FILES["promjenaProfilneSlike"]["tmp_name"];
                        $profilnaSlika= removeSimbolsImg(str_replace($profilnaSlika, "$ukloniEkstenziju[0]$vrijeme.$ekstenzija", str_replace(" ", "_", $_FILES["promjenaProfilneSlike"]["name"])));
                        $profilnaSlika_tmp= $_FILES["promjenaProfilneSlike"]["tmp_name"];
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
                                    $profilnaSlika= removeSimbolsImg(str_replace($profilnaSlika, "$ukloniEkstenziju[0]($i)$vrijeme.$ekstenzija", str_replace(" ", "_", $_FILES["promjenaProfilneSlike"]["name"])));
                                    $profilnaSlika_tmp= $_FILES["promjenaProfilneSlike"]["tmp_name"];

                                    move_uploaded_file($profilnaSlika_tmp, $putanja.$profilnaSlika);
                                    break;
                                }
                            }//end for petlje
                        }//end else !file_exists(($provjeraSlike)

                        //$q= "UPDATE korisnici SET profilnaSlika='$profilnaSlika' WHERE username='{$profil}')";
                        //$ubaciKorisnike= mysqli_query($conn, $q);
                        $putanja = "../images/profilne/";
                        //$q= "UPDATE korisnici SET profilnaSlika='{$profilnaSlika}' WHERE username='{$profil}')";
                        $q="UPDATE korisnici SET profilnaSlika='{$profilnaSlika}' WHERE idKorisnici='{$lid}'";
                        $promjeniSliku= mysqli_query($conn, $q);
                        move_uploaded_file($profilnaSlika_tmp, $putanja.$profilnaSlika);

                                    

                        if($promjeniSliku == TRUE)
                        {
                            echo "<meta http-equiv='refresh' content='0'; url='profileedit.php?{$profil}'>";
                        }else{
                            echo "Greška " . mysqli_error($conn). "<br>";

                        }       
                }//end while loop provjera korisničkog imena i šifre
        }//end provjera ekstenzije
}

