<?php

class Slider
{
	public function slider1()
	{
		global $conn;
		$q= "SELECT * FROM albumi JOIN izvodjaci ON izvodjaci.idIzvodjaci= albumi.idIzvodjacAlbumi ORDER BY RAND()";
        $select_album= mysqli_query($conn, $q);
        ?>
		<!-- Image Slider -->
		<div class="slider-container">
            <div class="swiper-container image-slider-1">
                <div class="swiper-wrapper">
        
			<?php
			while($row= mysqli_fetch_assoc($select_album))
			{
				$this->albumId= $row["idAlbum"];
				$this->idIzvodjacAlbumi= $row["idIzvodjacAlbumi"];
				$this->nazivAlbuma= $row["nazivAlbuma"];
				$this->godinaIzdanja= $row["godinaIzdanja"];
				$this->izdavac= $row["izdavac"];
				$this->slikaAlbuma= $row["slikaAlbuma"];
				$this->izvodjacMaster= $row["izvodjacMaster"];

				?>

                        <!-- Slide -->
                        <div class="swiper-slide" >
                            <img class="img-fluid" src="images/albumi/<?php echo $this->slikaAlbuma; ?>" alt="alternative">
                        </div>
                        <!-- end of slide -->
						<?php
			}
			?>
                </div> <!-- end of swiper-wrapper -->
                    
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- end of add arrows -->
                    
            </div> <!-- end of swiper-container -->
		</div> <!-- end of slider-container -->
			 </div> <!-- end of col -->
            </div> <!-- end of row -->
		</div> <!-- end of container -->
        <!--</div>--> <!-- end of outer-container -->
        <!-- end of image slider -->
		<?php
	}
	
	
	////kraj metode slider1
	////---------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function sliderAlbum()
	{
		global $conn;
		$q= "SELECT * FROM albumi JOIN izvodjaci ON izvodjaci.idIzvodjaci= albumi.idIzvodjacAlbumi ORDER BY RAND() LIMIT 3";
        $select_album= mysqli_query($conn, $q);
        ?>
        		<div class="slider-container my-1">
				<div class="swiper-container text-slider">
				<div class="swiper-wrapper">
        <?php
        while($row= mysqli_fetch_assoc($select_album))
        {
            $this->albumId= $row["idAlbum"];
            $this->idIzvodjacAlbumi= $row["idIzvodjacAlbumi"];
            $this->idIzvodjac2= $row["idIzvodjac2"];
            $this->nazivAlbuma= $row["nazivAlbuma"];
            $this->godinaIzdanja= $row["godinaIzdanja"];
            $this->izdavac= $row["izdavac"];
            $this->slikaAlbuma= $row["slikaAlbuma"];
            $this->drzavaAlbumi= $row["drzavaAlbumi"];
            $this->entitetAlbumi= $row["entitetAlbumi"];
            $this->tacanDatumIzdanja= $row["tacanDatumIzdanja"];
			$this->izvodjacMaster= $row["izvodjacMaster"];
            $this->nadimci= $row["nadimciIzvodjac"];
            

            //for($i=0; $i<1; $i++)
			//{
		?>


				
					
					<!-- Slide -->
					<div class="swiper-slide">
					<a href="oalbumu.php?izv=<?php echo $this->idIzvodjacAlbumi."&album=".$this->albumId."&naziv=".$this->izvodjacMaster."-".$this->nazivAlbuma; ?>" >
						<div class="image-wrapper">
							<img class="" src="images/albumi/<?php echo $this->slikaAlbuma; ?>" alt="<?php echo $this->nazivAlbuma; ?>" title="<?php echo $this->nazivAlbuma; ?>">
						</div> <!-- end of image-wrapper -->
						<div class="text-wrapper">
							<div class="testimonial-text"><?php echo $this->nazivAlbuma; ?></div>
							<div class="testimonial-text"><?php echo $this->godinaIzdanja; ?></div>
							<div class="testimonial-author"><?php echo $this->izvodjacMaster; ?></div>
						</div> <!-- end of text-wrapper -->
						</a>
					</div> <!-- end of swiper-slide -->
					<!-- end of slide -->
					<?php
		//}
	}
	?>


				</div> <!-- end of swiper-wrapper -->
				
				<!-- Add Arrows -->
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
				<!-- end of add arrows -->

			</div> <!-- end of swiper-container -->
		</div> <!-- end of slider-container -->
<?php

}
	
	////kraj metode slider2
	////---------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	public function staKazu()
	{
		?>
		<div id="stakazu" class="slider-2 razmak-id">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<br>
						

						<!-- Sladjer 2 -->
						<?php
							$sldr= new Slider();
							$sldr->sliderAlbum();
						?>
						<!-- kraj slajder2 -->
					
						
						

					</div> <!-- end of col -->
				</div> <!-- end of row -->
			</div> <!-- end of container -->
		</div> <!-- kraj div-a id=stakazu -->
		<?php
	}
}