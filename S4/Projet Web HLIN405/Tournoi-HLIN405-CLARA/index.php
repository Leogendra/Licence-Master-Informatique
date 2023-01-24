<?php
$title = 'Page d\'accueil';
include("Joli/header.php");
?>


<div id="carousel" class="carousel slide text-center" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="Joli/Images/Carousel/Lol5.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <p>Inscrivez-vous pour la victoire !</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Joli/Images/Carousel/Lol4 (3).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <p>Bienvenue dans la faille de l'invocateur !</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Joli/Images/Carousel/TourLol (2).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <p>Supportez vos équipes préférées !</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<br>
<br>

<div class="container">
     <div class="row">
        <div class="col-md-6 text-center">
            <h2 class="lead" style="font-size: 2rem"> <b>Vous êtes capitaine d'équipe</b></h2>
            <p >Créez un compte sans oublier de préciser que vous êtes capitaine, connectez-vous et inscrivez vos équipe dans un tournoi dans la page inscription -> <a class="ref" href="inscriptionEquipe.php"> inscrire une équipe</a> !</p>
        </div>
        <div class="col-md-6 text-center" >
            <h2 class="lead" style="font-size: 2rem"><b>Vous êtes gestionnaire de tournoi</b></h2>
            <p >Acceptez les équipes dans votre tournoi et lancez-le dans la plage <a class="ref" href="tableauDeCompetition.php"> tableau de compétition !</a></p>            
        </div>
    </div> 

    <br>

    <div class="row">
        <div class="col-md-6 text-center">
            <h2 class="lead" style="font-size: 2rem"><b>Vous êtes joueur</b></h2>
            <p >Jouez vos matchs et gagnez !</p>
        </div>
        <div class="col-md-6 text-center" >
            <h2 class="lead" style="font-size: 2rem"><b>Vous êtes visiteur</b></h2>
            <p >Vous pouvez voir les tournois passés et à venir dans la page <a class="ref" href="tableauDeCompetition.php">tableau de compétition</a> !</p>
        </div>
    </div> 
</div>

<br>
<br>

<div class="container text-center">
  <h2 class="lead" style="font-size: 2rem"><b> Présentation du jeu :</b></h2>
  <div class="row">
    <div class="col-2"></div> 
      <div class="col-8" >
       League of Legends est un jeu de stratégie de type arène de bataille en ligne, c'est un free to play sorti en 2009 par Riot Games. Depuis, le jeu compte plus de 67 millions de joueurs qui jouent à League of Legends chaque mois et jusqu'à 7,5 millions de joueurs simultanément tout les jours. <br>

        La Faille de l'invocateur est le mode de jeu principal de League of Legends, le joueur se retrouve dans une des deux équipes de cinq champions qui s'affrontent, ils gagnent en puissance au fil de la partie en amassant des points d'expérience ainsi qu'en achetant des objets, dans le but de battre l'équipe adverse. <br>
       L'objectif d'une partie est de détruire le « Nexus » ennemi, sachant que les parties sont disjointes. 
       Il y a le choix parmi plus de 150 champions disponibles qui disposent de compétences uniques et d'un style de jeu qui leur est propre. <br>
       Ce mode de jeu dispose d'une scène compétitive professionnelle. <br>
       Les compétitions de LoL sont constituées d'équipes de 5 joueurs assistés par un coach et plusieurs analystes. Au championnat du monde, les équipes ne peuvent avoir qu'un seul remplaçant, mais dans les championnats, un nombre plus ou moins libre de remplaçants est toléré. Il existe une multitude de championnats nationaux ou continentaux à travers le monde. Les matchs se décident en 3 parties, l'équipe avec 2 victoires gagne. <br>
        Le tout regardé par des millions de téléspéctateurs. Pour les championnat du monde 2020 (en), Riot Games totalise 1 051 871 885 d'heures regardées si l'on cumule les durées de visionnage de chaque spectateur.       
      </div>

  </div>
</div>
<br>

<?php include("Joli/footer.php"); ?>
