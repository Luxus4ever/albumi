<?php 

include "config/config.php";
include "classes/detaljiAlbum.class.php";
include "functions/master.func.php";
include "header.php";
?>


	<div id="wrapper" class="">
		<article class="slider-pocetna">

		</article>

		<section id="uvod" class="col-lg-12">
			<img src="https://images.unsplash.com/photo-1659980346614-30e3bce4c157?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2069&q=80" id="uvod-slika" title="" alt="">
			<article id="uvod-tekst" class="">
				<h1 class="naslov-centar">Par uvodnih riječi</h1>
				<p>Ovo nije tekst o crnoj teniserki plave kose, nego o diskografiji domaćih rep albuma, odnosno albuma sa prostora Ex-Yu. Ovo nije neki novi pokušaj bratstva i jedinstva ovo je samo pokušaj da ostanu upamćena Rep izdanja kao i kvalitetni izvođači na ovim prostorima zbog sličnosti jezika. Pošto je ovo ogroman projekat, koji je sa tehničke strane izgurala jedna osoba, ali nema šanse da jedna osoba popuni svu diskografiju, očekujemo od vas da doprinesete i sa detaljnim podatcima koji albumi nedostaju. Da dodate linkove gdje se može slušati ova muzika ili eventualno besplatno legalno skinuti ova muzika. Nadamo se da će i sami izvođači, kao i izdavačke kuće prepoznati potencijal ovog sajta i samim ti doprinijeti njegovom daljem razvoju. Predviđeno je da se sajt nadograđuje novim idejama, pa s'vremena na vrijeme će biti dodavane nove mogućnosti. Za sada nije predviđeno da obični korisnici mogu dodavati albume ali i to će vjerovatno biti omogućeno u skorijem periodu. Širite dobru muziku.</p>
			</article>
		</section>



		<!-- Prikaz albuma -->
		<div class="albumPrikaz">
		
		<?php 
		/*
		$sldr= new Slider();
		//$sldr->slider1();
		$sldr->staKazu();*/

		
		//$sviAlb= new albumDetalji();
		//$sviAlb->brojalbuma(1);
		//$sviAlb->nazivDrzave();
		nazivDrzave();
		?>
				
		</div> <!-- kraj albumPrikaz -->
	</div> <!-- kraj wrapper -->
<?php
include "footer.php";
		

