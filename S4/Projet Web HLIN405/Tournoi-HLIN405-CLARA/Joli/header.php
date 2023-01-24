<!DOCTYPE html>
<?php

if(session_status() != PHP_SESSION_ACTIVE) session_start();

try {
  $bdd = new PDO("mysql:host=localhost;dbname=baseDeDonnee", "root", "ilovelinuxnow", array(PDO::ATTR_PERSISTENT => true));
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Échec lors de la connexion : ' . $e->getMessage();
}

?>

<html>

<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="Joli/joli.css"> <!-- CSS -->
  <link href="Joli/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- bootstrap -->
  <script src="Joli/bootstrap/js/jquery.js"></script> <!-- bootstrap -->
  <script src="Joli/bootstrap/js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="js/register-login.js"></script>
  <!--script pour le popup du formulaire de connexion -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>

<body style="background-color:#676767;">
  <div id="main">
    <!-- sert dans ls CSS pour la mise en page -->


    <!-- <div class="container-fluid" id="images">
          
        images
          
      </div>  A VOIR SI ON LE FAIT-->

    <div class="container-fluid" id="textetourne">
      <marquee>
        <FONT color="red">
          À cause du coronavirus et de la crise mondiale actuelle les matchs ne se dérouleront pas dans des stades, merci de votre compréhension
        </FONT>
      </marquee>
    </div>

    <!-- bar de naviguation -->
    <header class="row" id="myHeader">
      <div class="col">
        <nav class="navbar navbar-expand-lg navbar-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="color:#ffff46;text-shadow: black 0.1em 0.1em 0.2em;font-size:140%">Accueil</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="carte.php">Carte</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Inscription
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: rgb(145,145,145)">
                    <li><a class="dropdown-item" onclick="verif('capitaine')" href="inscriptionEquipe.php">Inscrire une équipe</a></li>
                    <li><a class="dropdown-item" onclick="verif('admin')" href="creertournoi.php">Créer un tournoi</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="joueur.php">Joueurs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="tableauDeCompetition.php">Tableau de compétition</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">À propos</a>
                </li>
              </ul>
            </div>
            <!-- Log in : -->
            <div class="col-2-md-1 px-1 ">
              <a class="btn btn-outline-secondary" type="button" href="connexion.php">Connexion</a>
            </div>

            <div class="col-2-md-1 px-1 ">
              <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profil" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="Joli/Images/user.png" height="40px">
                </a>
                <ul class="dropdown-menu " id="log" aria-labelledby="navbarDropdown" style="background-color: rgb(145,145,145);">
                  <li><a class="dropdown-item" onclick="verif('ok')" href="profil.php">Mon Profil</a></li>
                  <li><a class="dropdown-item" href="deco.php">Déconnexion</a></li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- FIN bar de naviguation -->

    <section class="container" id="contenu" style="background-color:#9b9b9b; ">
      <br>

      <?php
      // if (isset($_SESSION["loggedin"])) {
      //   echo "Vous êtes connecté";
      // } else {
      //   echo "Vous n'êtes pas connecté";
      // }
      // include("test_login.html");
      ?>

      <script>
        function verif(type) {
          <?php
          if(!isset($_SESSION['loggedin'])){
            ?>
            alert("Il faut être connecté pour avoir accès a cette page");
            <?php
          }
          else{
          ?>
          var admin = <?php echo $_SESSION["admin"]; ?>;
          console.log(admin);
          if (type == "capitaine") {
            var cap = <?php echo $_SESSION["capitaine"]; ?>;
            console.log(cap);
            if ((admin == 0) & (cap == 0) ) {
              alert("Il faut être capitaine pour avoir accès a cette page");
              window.location.href = "index.php";
            }
          } else if (type == "admin") {
            if (admin == 0) {
              alert("Il faut être administrateur pour avoir accès a cette page");
            }
          } else if (type == "orga") {
            var orga = <?php echo $_SESSION["organisateur"]; ?>;
            console.log(orga);
            if ((orga == 0) | (admin == 0)) {
              alert("Il faut être organisateur pour avoir accès a cette page");
            }
          }
          <?php
          }
          ?>
        }
        
          </script>
    <!-- début du texte-->