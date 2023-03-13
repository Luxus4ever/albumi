<?php
//********************************* Prikaz profila desne strane profila *********************************//
function bocnaForma($profil, $lid)
{
    global $conn;
    
    if(isset($_POST["promjeniSliku"]))
    {
        if(!empty($_FILES["promjenaProfilneSlike"]))
        {
            $profilnaSlika= removeSimbolsImg($_FILES["promjenaProfilneSlike"]["name"]);

            promjenaSlike($profilnaSlika, $profil, $lid);
            
        }else{
            echo "Niste izabrali sliku.";
        }
            
    }//end master if()


    if(isset($_POST["obrisi"]))
    {
        $delete_query="UPDATE korisnici SET profilnaSlika='' WHERE username='{$profil}'";
        mysqli_query($conn, $delete_query);
        echo "<meta http-equiv='refresh' content='0'; url='profileedit.php?{$profil}'>";
    }
    ?>
        <form action="" method="POST" enctype="multipart/form-data" name="promjenaSlike" id="promjenaSlike">
        
        <input type="file" name="promjenaProfilneSlike"><br><br>
        <button type="submit" name="promjeniSliku" value="izmjeni">Izmjeni</button>

        <button type="submit" name="obrisi" value="obrisi">Obriši</button>
        
        </form>

        <script>
            document.getElementById('buttonid').addEventListener('click', openDialog);

            function openDialog() {
            document.getElementById('promjenaProfilneSlike').click();
            }
        </script>
				
    <?php
}
//********************************* Pozvana metoda u ovom fajlu u metodi editUser *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Izmjena podataka o profilu *********************************//
function editUser($profil,$lid)
{
    if(!isset($_SESSION['username']) && !isset($_SESSION['idKorisnici']))
    {
        echo "<h1>Nemate prava pristupa!</h1>";
    }else{

    
    global $conn;
    $q2= "SELECT * FROM korisnici WHERE username='{$profil}'";
    $pregledajPodatke= mysqli_query($conn, $q2);

    while($row= mysqli_fetch_assoc($pregledajPodatke))
    {
        $ime= $row["ime"];
        $prezime= $row["prezime"];
        $email= $row["email"];
        $username= $row["username"];
        $datumRegistracije= $row["datum2"];
        $pol= $row["pol"];
        $tipKorisnika= $row["tipKorisnika"];
        $drzava= $row["drzava"];
        $grad= $row["grad"];
        $profilnaSlika= $row["profilnaSlika"];
        $facebookPr= $row["facebookPr"];
        $instagramPr= $row["instagramPr"];
        $twitterPr= $row["twitterPr"];
        $tiktokPr= $row["tiktokPr"];
        $sajt= $row["websajt"];
        $sifra= $row["sifra"];
        $sifra2= $row["sifra2"];


        ?>
        <div id="wrapper">
            <div class="slikeAlbumaPregled">
                <main>
                <aside class="profilBocno">
                    <div>
                        <img src="images/profilne/<?php echo $profilnaSlika;?>" alt="<?php echo $username;?>" title="<?php echo $username;?>">
                        <p id="promSlik">Promjeni sliku</p>
                        <?php
                            bocnaForma($profil, $lid);
                        ?>
                        <hr>
                        <a href="profile.php?username=<?php echo $profil."&lid=".$lid; ?>">Pregled profila</a>
                    </div>
                </aside>
                    <?php
                    
                    formaEditUser($username, $ime, $prezime, $pol, $tipKorisnika, $email, $drzava, $grad, $facebookPr, $instagramPr, $twitterPr, $tiktokPr, $sajt, $profil, $lid);
                    ?>
                </main>  
		    </div> <!-- kraj slikeAlbumaPregled -->
        </div> <!-- kraj #wrapper -->
        <?php
    }
}
}

//********************************* Pozvana metoda u ovom fajlu  *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Funkcija za prikaz forme za izmjenu *********************************//
function formaEditUser($username, $ime, $prezime, $pol, $tipKorisnika, $email, $drzava, $grad, $facebookPr, $instagramPr, $twitterPr, $tiktokPr, $sajt, $profil, $lid)
{
    if(!isset($_SESSION['username']) && !isset($_SESSION['idKorisnici']))
    {
        echo "<h1>Nemate prava pristupa!</h1>";
    }else{
    global $conn;
    
    if(isset($_POST["izmjeni"]))
    {
        if(!empty(["grad"]))
        {
            $email= $_POST["email"];
            $grad= $_POST["grad"];
            $drzava= $_POST["drzava"];
            $facebookPr= removeLinksSocialMedia($_POST["facebook"]);
            $instagramPr= removeLinksSocialMedia($_POST["instagram"]);
            $twitterPr= removeLinksSocialMedia($_POST["twitter"]);
            $tiktokPr= removeLinksSocialMedia($_POST["tiktok"]);
            $sajt= checkLinks($_POST["sajt"]);

            
            $regex = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$/';
            if (preg_match($regex, $email)) 
            {
                $update_query="UPDATE korisnici SET email='{$email}', drzava='{$drzava}', grad='{$grad}', facebookPr='{$facebookPr}', instagramPr='{$instagramPr}', twitterPr='{$twitterPr}', tiktokPr='{$tiktokPr}', websajt='{$sajt}' WHERE idKorisnici='{$lid}'";
                $command_update= mysqli_query($conn, $update_query);

                if($command_update == TRUE)
                {
                    echo "<meta http-equiv='refresh' content='1'; url='profileedit.php?{$profil}'>";
                }else{
                    echo "Greška " . mysqli_error($conn). "<br>";
                }
            } else { 
                // Invalid email
                echo "<h4 class='warning'>Nije dobar format email-a.</h4>";
            }//end provjera emaila

        }
    }
    ?>
            <section class="profilCentar">
				<p><span class="podebljano">Korisničko me:</span> <?php echo $username;?></p>
				<p><span class="podebljano">Ime i prezime</span> <?php echo $ime . " " . $prezime;?></p>
				<p><span class="podebljano">Pol:</span> <?php echo $pol;?></p>
				<p><span class="podebljano">Tip korisnika:</span> <?php echo $tipKorisnika;?></p>
				
				<p>Da bi ste izmjenili podatke iznad, kontaktirajte administratora</p>
				<hr>
			
				<form action="" enctype="multipart/form-data" method="POST" name="editProfile" id="editProfile">
                    <input type="text" name="email" placeholder="Email" value="<?php echo $email;?>" required><br><br>
                    <label for="država">Država</label><br>
                    <select name="drzava" id="država">
                        <option value="Srbija" selected="selected">Srbija</option>
                        <option value="Bosna i hercegovina">Bosna i Hercegovina</option>
                    </select> <br><br>
                    <input type="text" name="grad" placeholder="Grad" value="<?php echo $grad; ?>"><br><br>
                    https://www.facebook.com/<input type="text" name="facebook" placeholder="Facebook profil" value="<?php echo $facebookPr; ?>"><br><br>
                    https://www.instagram.com/<input type="text" name="instagram" placeholder="Instagram profil" value="<?php echo $instagramPr; ?>"><br><br>
                    https://twitter.com/<input type="text" name="twitter" placeholder="Twitter profil" value="<?php echo $twitterPr; ?>"><br><br>
                    https://www.tiktok.com/@<input type="text" name="tiktok" placeholder="Tik-tok profil" value="<?php echo $tiktokPr; ?>"><br><br>
                    
                    <label for="sajt">Unesite pun naziv sajta sa početkom kao https:// ili kao www.</label><br>
                    <input type="text" name="sajt" placeholder="Vaš sajt" value="<?php echo $sajt; ?>"><br><br>
                    
                    
                    
                    <button type="submit" name="izmjeni" value="izmjeni">Izmjeni</button>
			    </form>
                <hr>
                <?php 
                if(isset($_POST["novaSifra"]))
                {
                    if(!empty(["pass1"]) || !empty(["pass2"]))
                    {
                        $password1= removeSimbols($_POST["pass1"]);
                        $password2= removeSimbols($_POST["pass2"]);

                        if($password1===$password2)
                        {
                            $sifrovano= md5($password1);
                            $update_password="UPDATE korisnici SET sifra='{$sifrovano}', sifra2='{$password2}' WHERE idKorisnici='{$lid}'";
                            $command_update_password= mysqli_query($conn, $update_password);

                            if($command_update_password == TRUE)
                            {
                                echo "<meta http-equiv='refresh' content='1'; url='profileedit.php?{$profil}'>";
                            }else{
                                echo "Greška " . mysqli_error($conn). "<br>";
                            }
                        }else{
                            echo "<h4 class='warning'>Šifra nije ista</h4>";
                        }

                        
                    }
                }

                    ?>
                    <section class="sredina">
                        
                        <form action="" method="POST" name="editProfile" id="editProfile">
                            <h3>Promjena šifre</h3>
                            <label for="pass1">Unesite novu šfiru</label><br>
                            <input type="password" name="pass1" placeholder="Šifra" ><br><br>
                            <label for="pass2">Ponovite novu šfiru</label><br>
                            <input type="password" name="pass2" placeholder="Ponovi šifru"><br><br>
                            <input type="submit" name="novaSifra">
                        </form>
                    </section>
            </section>
    <?php
    }
    
}
