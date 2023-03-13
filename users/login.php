<?php
include "../config/config.php";
include "../subfolder/header.php";
?>
<div class="slikeAlbumaPregled sredina">
    <fieldset>
        <legend>Ulogujte se</legend>
    <form method="POST" action="../process/login.process.php" name="login">

    <input type="text" name="username" id="uname" placeholder="Korisničko ime" required="required"><br><br>
    <input type="password" name="password" id="password" placeholder="Šifra" required="required"><br><br>

    <input type="submit" name="ulogujSe" value="Uloguj Se">

    </form>
    </fieldset>
</div>
<?php
include "../subfolder/footer.php";