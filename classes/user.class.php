<?php
class user{
    //********************************* Metoda koja pokazuje da li je korisnik online *********************************//
    function userOnline($lid)
    {
        global $conn;
        $q="SELECT zadnjiLogin FROM korisnici WHERE idKorisnici=$lid";
        $proba= mysqli_query($conn, $q);

        while($row= mysqli_fetch_array($proba))
        {
            $zadnjiLogin= $row['zadnjiLogin'];

            date_default_timezone_set('Europe/Belgrade');
            $now = date("d-m-Y h:i:s a");

            // calculate the difference
            $difference = strtotime($now) - strtotime($zadnjiLogin);
            $difference_in_minutes = $difference / 60;

            if($difference_in_minutes < 3){
                // set online status
            echo "korisnik je ONLINE";
            } else {
                // set offline status
                echo "Korisnik je offline";
            }
        }
    }

    //********************************* Pozvana metoda u detailsUser.func.php *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------
}