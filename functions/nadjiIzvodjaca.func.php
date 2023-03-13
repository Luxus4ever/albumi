<?php

//********************************* Pronalazi izvodjaca ukoliko koristi drugo ime *********************************//
function nadjiIzvodjaca($izvodjac) 
{
    global$conn; 
    $q= "SELECT izvodjacMaster, nadimciIzvodjac FROM izvodjaci WHERE izvodjacMaster='{$izvodjac}'";
					$select_izvodjac= mysqli_query($conn, $q);
					if(mysqli_num_rows($select_izvodjac)>0)
					{
						
					}else
						{
							//echo $izvodjac;
							$q= "SELECT izvodjacMaster, nadimciIzvodjac FROM izvodjaci";
							$select_izvodjac= mysqli_query($conn, $q);
							
							while($row=mysqli_fetch_array($select_izvodjac))
							{
								$izvodjacM= $row["izvodjacMaster"];
								$nadimakIzvodjac= $row["nadimciIzvodjac"];
								$izvodjacNiz= explode(" ",$izvodjac);
								$nadimakIzvodjacNiz= explode(", ",$nadimakIzvodjac);

								if($nasao= in_array($izvodjac, $nadimakIzvodjacNiz))
								{
									$q= "SELECT * FROM izvodjaci WHERE izvodjacMaster='{$izvodjacM}'";
									$select_izvodjac2= mysqli_query($conn, $q);
									while($row=mysqli_fetch_array($select_izvodjac2))
									{
										$izvodjacM2= $row["izvodjacMaster"];
										?>
										<p>Ovaj izvođač je poznatiji pod nazivom: </p>
										<a class="feat" href="izvodjac.php?izvodjac=<?php echo str_replace(" ", "-", $izvodjacM2);?>"><?php echo $izvodjacM2; ?></a>
										<?php
									}//end while loop 2
								}else {echo "";}

							}//end while loop 1

							if(empty($izvodjacM2))
							{
								echo "U bazi podataka nema izvodjača pod ovim imenom. <br>
								Idite na pretragu i pokušajte da pronađete pod drugim ali sličnim imenom <br> 
								npr. ako piše Skajvikler vi pokušajte SkyWikluh.<br><br>";
							}
							
						}//end else -> mysqli_num_rows
}

//********************************* Pozvana funkcija u izvodjac.php *********************************//

//--------------------------------------------------------------------------------------------------------------------------------
