<!DOCTYPE html>
<html lang="sr">
<head>
<title>Дискографија</title>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="../css/style.css" rel="stylesheet">

<link href="../css/rating.css" rel="stylesheet">
<!--<link href="css/lightbox.css" rel="stylesheet">
<link href="css/swiper.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<!--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600,700,700i&display=swap" rel="stylesheet">-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>



</head>

<body oncontextmenu="return false;">
<header class="mainHeader">
    <div id="slogan">
        <a href="index.php"><p>Balkan Rep Diskografija</p></a>
    </div>
    <div id="logoRadio">
    <a href="index.php"><img src="../images/bhhr-logo.jpg" alt="Balkan Hip-Hop Radio" title="Balkan Hip-Hop Radio"></a>
    </div>
</header>
<nav class="glavniNav">

    <ul>
        <li><a href="../index.php">Početna</a></li>
        <li><a href="../index.php">Po godinama</a></li>
        <li><a href="../index.php">Početna</a></li>
        <li><a href="../search.php">Pretraga</a></li>
    </ul>
    
</nav>

<?php
require "../classes/header.class.php";
$h= new Header;
$h->meni();
include "../classes/slider.class.php";

/*-----------------------------------------------------------------------------------------------------------------------
Ovaj fajl služi da bih mogao da inkludujem potrbne fajlove (kao npr. style.css) u podfoldere kao što su users i slično. 
-------------------------------------------------------------------------------------------------------------------------*/
?>