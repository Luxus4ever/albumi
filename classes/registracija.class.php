<form method="POST" action="../process/registracija.process.php" enctype="multipart/form-data" name="registracija" id="registracija">
			
	<fieldset>
		<legend><span class="podebljano" style="color: red;">Obavezna polja</span></legend>

		<input type="text" name="ime" id="ime" placeholder="Ime" required><br><br>
		<input type="text" name="prezime" id="prezime" placeholder="Prezime" required><br><br>
		<input type="email" name="email" id="email" placeholder="Email" required><br><br>
		<input type="text" name="username" id="username" placeholder="Korisničko ime" required><br><br>

					
					
					
					<input type="radio" name="pol" id="musko" value="Muško" >
					<label for="Musko">Muško</label><br>
					
					<input type="radio" name="pol" id="zensko" value="Žensko" required>
					<label for="Žensko">Žensko</label> <br><br>

					<label for="država">Država</label><br>
					<select name="drzava" id="drzava">
						<option disabled selected value="">Izaberite državu</option>
						<option>Srbija</option>
						<option>Bosna i Hercegovina</option>
					</select> <br><br>

                    <label for="tip">Tip korisnika</label><br>
					<select name="tipKorisnika" id="tip">
						<option disabled selected value="">Izaberite opciju</option>
						<option>Slušalac</option>
						<option>Izvođač</option>
                        <option>Izdavačka kuća</option>
					</select> <br><br>

					<input type="password" name="password" id="password" placeholder="Šifra" required><br><br>
					<input type="password" name="password2" placeholder="Ponovi šifru" required><br><br>
	</fieldset><br>
					<label for="grad">Grad</label><br>
					<input type="text" name="grad" id="grad" placeholder="Grad"><br><br>
			<fieldset>
				<legend><span class="podebljano" style="color: yellow;">Unesite samo naziv profila (nakon imena sajta)</span></legend>
					<label for="facebookLog">Facebook profil</label><br>
					https://www.facebook.com/<input type="text" name="facebookLog" id="facebookLog" placeholder="Facebook profil"><br><br>

					<label for="instagramLog">Instagram profil</label><br>
					https://www.instagram.com/<input type="text" name="instagramLog" id="instagramLog" placeholder="Instagram profil"><br><br>

					<label for="twitterLog">Twitter profil</label><br>
					https://twitter.com/<input type="text" name="twitterLog" id="twitterLog" placeholder="Twitter profil"><br><br>

					<label for="tiktokLog">Tik-Tok profil</label><br>
					https://www.tiktok.com/@<input type="text" name="tiktokLog" id="tiktokLog" placeholder="Tik-Tok profil"><br><br>

					<label for="sajtLog">Vaš sajt</label><br>
					<label for="sajt">Unesite pun naziv sajta sa početkom kao https:// ili kao www.</label><br>
					<input type="text" name="sajtLog" id="sajtLog" placeholder="Vaš sajt"><br><br>
			</fieldset><br>

					<label for="profilnaSlika">Profilna slika</label><br>
					<input type="file" name="profilnaSlika" id="profilnaSlika"><br><br>
					<input type="submit" name="posalji" value="Pošalji">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="reset" value="Reset">

</form>