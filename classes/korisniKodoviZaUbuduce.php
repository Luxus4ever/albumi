<?php

//********************************* Prolazak kroz sve podfoldere (pisanje koda v1) *********************************//
$glavniFolder = "images/albumi/";
if (is_dir($glavniFolder)) {
    $fajlovi = opendir($glavniFolder); {
        // CHECKING FOR SMOOTH OPENING OF DIRECTORY
        if ($fajlovi) {
            //READING NAMES OF EACH ELEMENT INSIDE THE DIRECTORY
            while (($podFolderi = readdir($fajlovi)) !== FALSE) {
                // CHECKING FOR FILENAME ERRORS
             if ($podFolderi != '.' && $podFolderi != '..') {
                    echo "<strong>Podfolder: " .$podFolderi . "</strong><br>
                    "."Fajlovi u ".$podFolderi."--<br>";
                     
                $dirpath = "images/albumi/" . $podFolderi . "/";
                    // GETTING INSIDE EACH SUBFOLDERS
                    if (is_dir($dirpath)) {
                        $file = opendir($dirpath); {
                            if ($file) {
                //READING NAMES OF EACH FILE INSIDE SUBFOLDERS
               while (($imeFajla = readdir($file)) !== FALSE) {
                if ($imeFajla != '.' && $imeFajla != '..') {
                        //echo "<img src='images/albumi/" . $podFolderi . "/". $imeFajla . "'><br>";
                        echo $imeFajla . "<br>";
                           }//end if($imeFajla)
                         }//end while 2
                      }//end if($file)
                   }//end $file opendir
               }//end if (is_dir)
                    echo "<br>";
                }//end if($podfolderi)
            }//end while 1
        }//end If($fajlovi)
    }//end $fajlovi opendir
}//end glavnog if-a


//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Prolazak kroz sve podfoldere (pisanje koda v2) *********************************//
$glavniFolder = "images/albumi/";
if (is_dir($glavniFolder)) 
{
    $fajlovi = opendir($glavniFolder); 
	{
        // CHECKING FOR SMOOTH OPENING OF DIRECTORY
        if ($fajlovi) 
		{
            //READING NAMES OF EACH ELEMENT INSIDE THE DIRECTORY
            while (($podFolderi = readdir($fajlovi)) !== FALSE) 
			{
                // CHECKING FOR FILENAME ERRORS
				if ($podFolderi != '.' && $podFolderi != '..') 
				{
                    echo "<strong>Podfolder: " .$podFolderi . "</strong><br>
                    "."<strong><i>Fajlovi u ".$podFolderi."</i></strong><br>";
                     
                	$dirpath = "images/albumi/" . $podFolderi . "/";
                    // GETTING INSIDE EACH SUBFOLDERS
                    if (is_dir($dirpath)) 
					{
                        $file = opendir($dirpath); 
						{
                            if ($file) 
							{
								//READING NAMES OF EACH FILE INSIDE SUBFOLDERS
								while (($imeFajla = readdir($file)) !== FALSE) 
								{
									if ($imeFajla != '.' && $imeFajla != '..') 
									{
										echo $imeFajla . "<br>";
                           			}//end if($imeFajla)
                         		}//end while 2
                      		}//end if($file)
                   		}//end $file opendir
               		}//end if (is_dir)
                    echo "<br>";
                }//end if($podfolderi)
            }//end while 1
        }//end If($fajlovi)
    }//end $fajlovi opendir
}//end glavnog if-a


//--------------------------------------------------------------------------------------------------------------------------------
//*********************************Metoda za uklanjanje riječi featuring ili feat. na pjesmi *********************************/

//****************** razlika u odnosnu na već ugrađenu metodu je ta što ovdje idu 2 parametra ******************/
public function fit($redniBroj, $idPjesme)
{
   global $conn;

   $q= "SELECT feat FROM pjesme WHERE redniBroj='{$redniBroj}' AND idPjesme='{$idPjesme}'";
   $select_feat= mysqli_query($conn, $q);
   if(mysqli_num_rows($select_feat)>0)
   {
   while($row=mysqli_fetch_array($select_feat))
   {
       $feat= $row["feat"];
   
    $niz3= explode(", ", $feat);
    $niz4= explode(" & ", $feat);
    
    foreach($niz3 as $ime)
    {
        
            //if(strpos($ime, "featuring"))
            if(strpos($feat, "featuring")!==false)
            {
                ?>
                <a class="feat" href="izvodjac.php?izvodjac=<?php echo str_replace("featuring ", "", $ime) ?>"><?php echo $ime; ?></a><?php
                if(next($niz3))
                {
                    echo ", ";
                }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
            }elseif(strpos($feat, "Featuring")!==false)
                {
                    ?>
                    <a class="feat" href="izvodjac.php?izvodjac=<?php echo str_replace("Featuring ", "", $ime) ?>"><?php echo $ime; ?></a><?php
                    if(next($niz3))
                    {
                        echo ", ";
                    }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                }elseif(strpos($feat, "feat. ")!==false)
                    {
                        ?>
                        <a class="feat" href="izvodjac.php?izvodjac=<?php echo str_replace("feat. ", "", $ime); ?>"><?php echo $ime; ?></a><?php
                        if(next($niz3))
                        {
                            echo ", ";
                        }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                    }elseif(strpos($feat, "(")!==false && strpos($feat, ")")!==false)
                    {
                        ?>
                        <a class="feat" href="izvodjac.php?izvodjac=<?php echo str_replace("(", "", str_replace(")", "", $ime)) ?>"><?php echo $ime; ?></a><?php
                        if(next($niz3))
                        {
                            echo ", ";
                        }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                    }else{
                        ?>
                        <a class="feat" href="izvodjac.php?izvodjac=<?php echo $ime ?>"><?php echo $ime; ?></a><?php
                        if(next($niz3))
                        {
                            echo ", ";
                        }// Dodaje zarez (tj. neki simbol), nakon svakog člana niza, osim zadnjeg
                    }
        
    }// end foreach loop
   }// end while loop
}else {echo "Nema ništa";}
}// end function fit

//--------------------------------------------------------------------------------------------------------------------------------

//*********************************Metoda koja iscrtava tabelu *********************************/

//****************** razlika u odnosnu na već ugrađenu metodu je ta što prilikom pozivanje prethodne metode fit() unosimo 2 parametra ******************/
public function tabelaPjesme($idPjesme, $redniBroj, $nazivPjesme, $saradnici, $tekstPjesme, $trajanjePjesme, $feat, $izvodjac, $mixtapeIzvodjac, $izvodjacMaster)
{
    ?>
        
        <tr> 
            <?php 
            if($this->saradnici==null && ($this->trajanjePjesme==null || $this->trajanjePjesme=="00:00:00") && $this->mixtapeIzvodjac!==null)
            {
                ?>
                <td><?php echo $this->redniBroj; ?></td> 
                <td><?php echo $this->mixtapeIzvodjac . $this->feat; ?></td> 
                <td><a href="tekstovi.php?tekst=<?php echo $this->idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                    <?php $this->fit($this->redniBroj, $this->idPjesme); ?>
                </td>
                <?php
            }elseif($this->saradnici==null && $this->trajanjePjesme==null)
            {
                ?>
                
                <td><?php echo $this->redniBroj; ?></td> 
                <td><?php echo $this->izvodjacMaster; ?></td> 
                <td><a href="tekstovi.php?tekst=<?php echo $this->idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                    <?php $this->fit($redniBroj, $this->idPjesme)?>
                </td>
                <?php
            }elseif($this->saradnici==null && !empty($this->mixtapeIzvodjac!==null))
            {
                ?>
                <td><?php echo $this->redniBroj; ?></td> 
                <td><?php echo $this->izvodjacMaster; ?></td> 
                <td><?php echo $this->mixtape($this->mixtapeIzvodjac) . " " . $this->fit($this->redniBroj, $this->idPjesme); ?></td>
                <td><a href="tekstovi.php?tekst=<?php echo $this->idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                    <?php ?>
                </td>
                <td><?php echo $this->trajanjePjesme; ?></td>
                <?php
            }elseif($this->saradnici==null)
                {
                    ?>
                    <td><?php echo $this->redniBroj; ?></td> 
                    <td><?php echo $this->izvodjacMaster; ?></td> 
                    <td><a href="tekstovi.php?tekst=<?php echo $this->idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                        <?php $this->fit($this->redniBroj, $this->idPjesme)?>
                    </td>
                    <td><?php echo $this->trajanjePjesme; ?></td>
                    <?php
            }elseif(($this->trajanjePjesme==null || $this->trajanjePjesme=="00:00:00") && $this->mixtapeIzvodjac!==null)
            {
                ?>
                <td><?php echo $this->redniBroj; ?></td>  
                <td><?php echo $this->mixtape($this->mixtapeIzvodjac); ?></td>
                <td><a href="tekstovi.php?tekst=<?php echo $idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                    <?php $this->fit($this->redniBroj, $this->idPjesme)?>
                </td>
                <td class="listaPjesama"><?php echo $this->saradnici; ?></td>
                <?php
            }elseif($this->trajanjePjesme==null || $this->trajanjePjesme=="00:00:00")
            {
                ?>
                <td><?php echo $this->redniBroj; ?></td> 
                <td><?php echo $this->izvodjacMaster; ?></td> 
                <td><a href="tekstovi.php?tekst=<?php echo $idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                    <?php $this->fit($this->redniBroj, $this->idPjesme)?>
                </td>
                <td class="listaPjesama"><?php echo $this->saradnici; ?></td>
                <?php
            }elseif($this->mixtapeIzvodjac!==null)
            {
                ?>
                    <td><?php echo $this->redniBroj; ?></td> 
                    <td><?php echo $this->mixtapeIzvodjac. $this->feat; ?></td> 
                    <td><a href="tekstovi.php?tekst=<?php echo $idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                        <?php $this->fit($this->redniBroj, $this->idPjesme)?>
                    </td>
                    <td class="listaPjesama"><?php echo $this->saradnici; ?></td>
                    <td><?php echo $this->trajanjePjesme; ?></td>
                    </tr>
                    <?php 
            }else
                {
                    ?>
                    <td><?php echo $this->redniBroj; ?></td> 
                    <td><?php echo $this->izvodjacMaster; ?></td> 
                    <td><a href="tekstovi.php?tekst=<?php echo $idPjesme ?>"><?php echo $this->nazivPjesme; ?></a>
                        <?php $this->fit($this->redniBroj, $this->idPjesme)?>
                    </td>
                    <td class="listaPjesama"><?php echo $this->saradnici; ?></td>
                    <td><?php echo $this->trajanjePjesme; ?></td>
                    </tr>
                    <?php 
                }

}// end function tabelaPjesme
//********************************* Pozvana metoda u u ovom fajlu u metodi listaPjesama() *********************************//

//--------------------------------------------------------------------------------------------------------------------------------
