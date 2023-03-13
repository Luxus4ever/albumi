<?php
//********************************* Provjerava da unos sajta bude validan sa https:// ili www i slično *********************************//
function checkLinks($param){
    $expression = '/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,7}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,7}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,7}|www\.[a-zA-Z0-9]+\.[^\s]{2,7})$/';
    if (!empty(preg_match($expression, $param))) {
        return $param;
    }else if(!empty($param)){
        echo "<h1 class='warning'>Nepravilan link sajta.</h1>";
    }
}
//********************************* Pozvana metoda u ovom fajlu u funkciji ocjeneProfila *********************************//

//--------------------------------------------------------------------------------------------------------------------------------


//********************************* Uklanjanje odnosno izmjena svih nepotrebnih simbola za input polja u formi *********************************//
function removeSimbols($param)
{
    $param= str_replace("  ", " ", $param);
    $param= str_replace("'", "", $param);
    $param= str_replace("<", "", $param);
    $param= str_replace(">", "", $param);
    $param= str_replace("--", "", $param);
    $param= str_replace("#", "", $param);
    $param= str_replace("$", "", $param);
    $param= str_replace("*", "", $param);
    $param= str_replace("/", "", $param);
    $param= str_replace("|", "", $param);
    $param= str_replace("\\", "", $param);
    $param= str_replace("~", "", $param);
    $param= str_replace("ˇ", "", $param);
    $param= str_replace("^", "", $param);
    $param= str_replace("{", "", $param);
    $param= str_replace("}", "", $param);
    $param= str_replace(";", "", $param);
    $param= str_replace("(", "", $param);
    $param= str_replace(")", "", $param);
    $param= str_replace("?", "", $param);
    $param= str_replace(":", "", $param);


    $slova= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
    $tekst= ""; 
    for($i=0; $i<5; $i++) 
    { 
        $tekst.= $slova[rand(0, strlen($slova)-1)];
    }
    $param= str_replace(".php", "_".$tekst."_", $param);
    $param= str_replace("script", "_".$tekst."_", $param);
    $param= str_replace(".sql", "_".$tekst."_", $param);
    $param= str_replace(".txt", "_".$tekst."_", $param);
    $param= str_replace(".js", "_".$tekst."_", $param);
    $param= str_replace(".htm", "_".$tekst."_", $param);
    $param= str_replace(".cgi", "_".$tekst."_", $param);
    $param= str_replace(".exe", "_".$tekst."_", $param);
    $param= str_replace(".pl", "_".$tekst."_", $param);
    $param= str_replace(".asp", "_".$tekst."_", $param);
    $param= str_replace(".py", "_".$tekst."_", $param);
    $param= str_replace(".jpeg", "_".$tekst."_", $param);
    $param= str_replace(".jpg", "_".$tekst."_", $param);
    $param= str_replace(".gif", "_".$tekst."_", $param);
    $param= str_replace(".png", "_".$tekst."_", $param);
    $param= str_replace(".svg", "_".$tekst."_", $param);
    $param= str_replace(".webp", "_".$tekst."_", $param);
    $param= str_replace(".jfif", "_".$tekst."_", $param);
    $param= str_replace(".apng", "_".$tekst."_", $param);
    $param= str_replace(".avif", "_".$tekst."_", $param);

    
    

    return $param;
}

//********************************* Pozvana metoda u ovom fajlu u funkciji ocjeneProfila *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Uklanjanje odnosno izmjena svih nepotrebnih simbola za slike (više nego za unos običnog teksta) *********************************//
function removeSimbolsImg($param)
{
    $param= str_replace(" ", "_", $param);
    $param= str_replace("'", "", $param);
    $param= str_replace("<", "", $param);
    $param= str_replace(">", "", $param);
    $param= str_replace("--", "", $param);
    $param= str_replace("#", "", $param);
    $param= str_replace("$", "", $param);
    $param= str_replace("*", "", $param);
    $param= str_replace("/", "", $param);
    $param= str_replace("|", "", $param);
    $param= str_replace("\\", "", $param);
    $param= str_replace("~", "", $param);
    $param= str_replace("ˇ", "", $param);
    $param= str_replace("^", "", $param);
    $param= str_replace("{", "", $param);
    $param= str_replace("}", "", $param);
    $param= str_replace(";", "", $param);
    $param= str_replace("?", "", $param);
    $param= str_replace(":", "", $param);

    $param= str_replace("ć", "c", $param);
    $param= str_replace("Ć", "C", $param);
    $param= str_replace("č", "c", $param);
    $param= str_replace("Č", "C", $param);
    $param= str_replace("ž", "z", $param);
    $param= str_replace("Ž", "Z", $param);
    $param= str_replace("đ", "dj", $param);
    $param= str_replace("Đ", "Dj", $param);
    $param= str_replace("š", "s", $param);
    $param= str_replace("Š", "S", $param);


    $slova= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
    $tekst= ""; 
    for($i=0; $i<5; $i++) 
    { 
        $tekst.= $slova[rand(0, strlen($slova)-1)];
    }
    $param= str_replace(".php", "_".$tekst."_", $param);
    $param= str_replace("script", "_".$tekst."_", $param);
    $param= str_replace(".sql", "_".$tekst."_", $param);
    $param= str_replace(".txt", "_".$tekst."_", $param);
    $param= str_replace(".js", "_".$tekst."_", $param);
    $param= str_replace(".htm", "_".$tekst."_", $param);
    $param= str_replace(".cgi", "_".$tekst."_", $param);
    $param= str_replace(".exe", "_".$tekst."_", $param);
    $param= str_replace(".pl", "_".$tekst."_", $param);
    $param= str_replace(".asp", "_".$tekst."_", $param);
    $param= str_replace(".py", "_".$tekst."_", $param);
    
    

    return $param;
}

//********************************* Pozvana metoda u ovom fajlu u funkciji ocjeneProfila *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

//********************************* Uklanjanje svih nepotrebnih simbola za društvene mreže *********************************//
function removeLinksSocialMedia($param)
{
    $param= str_replace("https://www.facebook.com/", "", $param);
    $param= str_replace("www.facebook.com/", "", $param);
    $param= str_replace("https://www.facebook.com", "", $param);
    $param= str_replace("www.facebook.com", "", $param);
    $param= str_replace("https://www.instagram.com/", "", $param);
    $param= str_replace("www.instagram.com/", "", $param);
    $param= str_replace("https://www.instagram.com", "", $param);
    $param= str_replace("www.instagram.com", "", $param);
    $param= str_replace("https://twitter.com/", "", $param);
    $param= str_replace("https://twitter.com", "", $param);
    $param= str_replace("https://www.tiktok.com/", "", $param);
    $param= str_replace("www.tiktok.com/", "", $param);
    $param= str_replace("https://www.tiktok.com", "", $param);
    $param= str_replace("www.tiktok.com", "", $param);

    $param= str_replace(" ", "_", $param);
    $param= str_replace("'", "", $param);
    $param= str_replace("<", "", $param);
    $param= str_replace(">", "", $param);
    $param= str_replace("--", "", $param);
    $param= str_replace("#", "", $param);
    $param= str_replace("$", "", $param);
    $param= str_replace("*", "", $param);
    $param= str_replace("/", "", $param);
    $param= str_replace("|", "", $param);
    $param= str_replace("\\", "", $param);
    $param= str_replace("~", "", $param);
    $param= str_replace("ˇ", "", $param);
    $param= str_replace("^", "", $param);
    $param= str_replace("{", "", $param);
    $param= str_replace("}", "", $param);
    $param= str_replace(";", "", $param);
    $param= str_replace("@", "", $param);
    $param= str_replace("?", "", $param);
    $param= str_replace(":", "", $param);

    $param= str_replace("ć", "c", $param);
    $param= str_replace("Ć", "C", $param);
    $param= str_replace("č", "c", $param);
    $param= str_replace("Č", "C", $param);
    $param= str_replace("ž", "z", $param);
    $param= str_replace("Ž", "Z", $param);
    $param= str_replace("đ", "dj", $param);
    $param= str_replace("Đ", "Dj", $param);
    $param= str_replace("š", "s", $param);
    $param= str_replace("Š", "S", $param);


    $slova= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
    $tekst= ""; 
    for($i=0; $i<5; $i++) 
    { 
        $tekst.= $slova[rand(0, strlen($slova)-1)];
    }
    $param= str_replace(".php", "_".$tekst."_", $param);
    $param= str_replace("script", "_".$tekst."_", $param);
    $param= str_replace(".sql", "_".$tekst."_", $param);
    $param= str_replace(".txt", "_".$tekst."_", $param);
    $param= str_replace(".js", "_".$tekst."_", $param);
    $param= str_replace(".htm", "_".$tekst."_", $param);
    $param= str_replace(".cgi", "_".$tekst."_", $param);
    $param= str_replace(".exe", "_".$tekst."_", $param);
    $param= str_replace(".pl", "_".$tekst."_", $param);
    $param= str_replace(".asp", "_".$tekst."_", $param);
    $param= str_replace(".py", "_".$tekst."_", $param);
    
    

    return $param;
}

//********************************* Pozvana metoda u ovom fajlu u funkciji ocjeneProfila *********************************//

//--------------------------------------------------------------------------------------------------------------------------------

