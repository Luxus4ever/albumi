<?php

class header{


    public function __construct()
        {
            global $conn;
            @session_start();
            date_default_timezone_set('Europe/Belgrade');
            $_SESSION["vrijeme"]= date('H:i:s');
            @$sesId= $_SESSION["idKorisnici"];
            
            $q="UPDATE korisnici SET zadnjiLogin=now() WHERE idKorisnici=$sesId";

            if (isset($_SESSION['idKorisnici']))
            {
                $lid= $_SESSION["idKorisnici"];
                $username= $_SESSION["username"];
                ?>
                <nav class='loginNav'>
                    <ul>
                        <li><a href='profile.php?username={$username}&lid={$lid}'>Moj Profil</a></li>
                        <li><a href='process/logout.process.php'>Odjava</a></li>
                    </ul>
                </nav><!-- end .loginNav -->
                <?php
            }else
                {
                    ?>
                    <nav class='loginNav'>
                        <ul>
                            <li><a href='users/login.php'>Prijava</a></li>
                            <li><a href='users/registracija.php'>Registracija</a></li>
                        </ul>
                    </nav><!-- end .loginNav -->
                    <?php
                }
        }


    //Metoda za prikaz menija
    public function meni()
    {
        
    }
}