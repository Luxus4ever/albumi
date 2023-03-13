<?php

class ocjene{

    //*********************************Metoda za ocjenjivanje albuma *********************************/
    public function ocjeni($albumId)
    {
        global $conn; 
        //global $albumId;
        
            if(isset($_POST["odabrano"]))
            {

                $broj= $_POST["odabrano"];
                $albumId= $_POST["album"];
                $izvodjac= $_POST["izvodjac"];
                $lid= $_SESSION["idKorisnici"];
                $whiteList= array(1,2,3,4,5,6,7,8,9,10);
                //echo $broj;
                if(is_numeric($broj) && in_array($broj,$whiteList) && is_numeric($albumId)){

                    
                json_encode($broj, $albumId, $izvodjac, $lid);
            
                $q= "INSERT INTO ocjene (ratedIndex, vrijeme, albumId, izvodjacId, korisniciId) VALUES ('$broj', now(), $albumId, $izvodjac, $lid)";
                mysqli_query($conn,$q);
                }else{
                    die("NIJE BROJ!!!!");
                }
            }

        $this->trenutnaOcjena($albumId);
        

    }//end function ocjeni
    //********************************* Pozvana metoda u oalbumu.php *********************************//

    //*********************************Metoda za IZMJENU ocjene albuma *********************************/
    public function updateOcjena($albumId, $idOcjene)
    {
        global $conn; 
        //global $albumId;
        
            if(isset($_POST["odabrano"]))
            {

                $broj= $_POST["odabrano"];
                $albumId= $_POST["album"];
                $izvodjac= $_POST["izvodjac"];
                $lid= $_SESSION["idKorisnici"];
                $whiteList= array(1,2,3,4,5,6,7,8,9,10);
                //echo $broj;
                if(is_numeric($broj) && in_array($broj,$whiteList) && is_numeric($albumId)){

                    
                json_encode($broj, $albumId, $izvodjac, $lid);
            
                //$q= "INSERT INTO ocjene (ratedIndex, vrijeme, albumId, izvodjacId, korisniciId) VALUES ('$broj', now(), $albumId, $izvodjac, $lid)";
                $q= "UPDATE ocjene SET ratedIndex='{$broj}' WHERE id='{$idOcjene}'";
                $izmOcj= mysqli_query($conn,$q);
                
                if($izmOcj == TRUE)
                            {
                                echo "Uspjeh";
                            }else{
                               die( "Greška " . mysqli_error($conn). "<br>");
                            }
            
            }else{
                    die("NIJE BROJ!!!!");
                }
            }

        $this->trenutnaOcjena($albumId);
        

    }//end function ocjeni

    
    //--------------------------------------------------------------------------------------------------------------------------------
    
    //*********************************Metoda za prikaz trenutne ocjene *********************************/
    public function trenutnaOcjena($albumId)
    {
        global $conn;
        //if(isset($_POST["trenOcjena"]))
        //{
        $q2= "SELECT SUM(ratedIndex) AS total FROM ocjene WHERE albumId='{$albumId}'";
        $trenutno= mysqli_query($conn, $q2);

        while($row= mysqli_fetch_array($trenutno))
        {
            $ukupno= $row["total"];
        }
        $q3= "SELECT COUNT(albumId) AS brgl FROM ocjene WHERE albumId='{$albumId}'";
        $brojgl= mysqli_query($conn, $q3);

        while($row= mysqli_fetch_array($brojgl))
        {
            $zbir= $row["brgl"];
        }
        //$prosijek= $ukupno / $zbir;
        //}

        

        $this->zvjezdice();
        if(!empty($ukupno))
        {
            

            echo "<h3>Trenutna ocijena: <span id='trenOcjena'>" . round($ukupno / $zbir,2) . "</span></h3> <br>";
            echo "Trenutni broj glasova: " . $zbir;
        }else
            {
                echo "<h3>Trenutna ocijena: 0 </h3>  <br>";
                echo "Trenutni broj glasova: " . $zbir;
            }
            return;
    }
    //********************************* Pozvana metoda u ovom fajlu u metodi ocjeni() *********************************//
    
    //--------------------------------------------------------------------------------------------------------------------------------

    //*********************************Metoda za prikaz ocjenjivanja *********************************/
    public function zvjezdice()
    {
        ?>
        <!-- Ratings/ocjene -->
		<div class="ratings">
				<p>Ocijeni album:</p>
        <div class="container">
            <div class="post">
                <div class="text">Hvala na ocjeni!</div>
                <div class="edit">Izmeni ocjenu</div>
            </div><!-- end .post -->
            <div class="star-widget" id="proba">
                <input type="radio" name="rate" class="ocena" id="rate-10" value="10">
                <label for="rate-10" class="fas fa-microphone"></label>
                <input type="radio" name="rate" class="ocena" id="rate-9" value="9">
                <label for="rate-9" class="fas fa-microphone"></label>
                <input type="radio" name="rate" class="ocena" id="rate-8" value="8">
                <label for="rate-8" class="fas fa-microphone"></label>
                <input type="radio" name="rate" class="ocena" id="rate-7" value="7">
                <label for="rate-7" class="fas fa-microphone"></label>
                <input type="radio" name="rate" class="ocena" id="rate-6" value="6">
                <label for="rate-6" class="fas fa-microphone"></label>
                <input type="radio" name="rate" class="ocena" id="rate-5" value="5">
                <label for="rate-5" class="fas fa-microphone"></label>
                <input type="radio" name="rate" class="ocena" id="rate-4" value="4">
                <label for="rate-4" class="fas fa-microphone"></label>
                <input type="radio" name="rate" class="ocena" id="rate-3" value="3">
                <label for="rate-3" class="fas fa-microphone"></label>
                <input type="radio" name="rate" class="ocena" id="rate-2" value="2">
                <label for="rate-2" class="fas fa-microphone"></label>
                <input type="radio" name="rate" class="ocena" id="rate-1" value="1">
                <label for="rate-1" class="fas fa-microphone"></label>
                <form action="#">
                <header></header>
                <div class="btn">
                    <button type="submit" name="ocijeni">Ocijeni</button>
                </div>
                </form>
            </div><!-- end .star-widget -->
        </div><!-- end .container -->

        <script src="./js/ratings.js"></script>
        <?php
    }//end function zvjezdice
    //********************************* Pozvana metoda u ovom fajlu u metodi trenutnaOCjena() *********************************//

    //--------------------------------------------------------------------------------------------------------------------------------

    //*********************************Metoda za prikaz ocjena bez logina *********************************/
    public function trenutniRezultat($albumId)
    {
        global $conn;
        //if(isset($_POST["trenOcjena"]))
        //{
        $q2= "SELECT SUM(ratedIndex) AS total FROM ocjene WHERE albumId='{$albumId}'";
        $trenutno= mysqli_query($conn, $q2);

        while($row= mysqli_fetch_array($trenutno))
        {
            $ukupno= $row["total"];
        }
        $q3= "SELECT COUNT(albumId) AS brgl FROM ocjene WHERE albumId='{$albumId}'";
        $brojgl= mysqli_query($conn, $q3);

        while($row= mysqli_fetch_array($brojgl))
        {
            $zbir= $row["brgl"];
        }
        ?>
        <!-- Ratings/ocjene -->
		<div class="ratings sredina">
				<p>Ocijeni album:</p>
        
            <?php
            dodajNapomenu("Morate biti ulogovani da ocijenite album!");
            if(!empty($ukupno))
            {
                echo "<h3>Trenutna ocijena: <span id='trenOcjena'>" . round($ukupno / $zbir,2) . "</span></h3> <br>";
                echo "Trenutni broj glasova: " . $zbir;
            }else
                {
                    echo "<h3>Trenutna ocijena: 0 </h3>  <br>";
                    echo "Trenutni broj glasova: " . $zbir;
                }
                return;
            ?>
        </div><!-- end .container -->

        <script src="./js/ratings.js"></script>
        <?php
    }//end function zvjezdice
    //********************************* Pozvana metoda u ovom fajlu u metodi trenutnaOCjena() *********************************//

}//end class ocjene