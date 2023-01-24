<?php 
$title = 'Tableau de compétition';
include("Joli/header.php"); 
?>


<div class="row">
<?php 
    $requete = $bdd->prepare("SELECT equipe.nom, joueur.nom FROM joueur, compoequipe, equipe WHERE joueur.licence = compoequipe.licence AND compoequipe.num_eq = equipe.num_eq");
    $requete->execute();
    $equipes = array();

    foreach ($requete->fetchAll() as $record) {
        $equipes[$record[0]][] = $record[1];
    }

    foreach ($equipes as $record => $joueurs) {
        echo '
        <div class="col-4 "> 
        <div class="card border-secondary mb-3 " style="margin:0 auto; width:90%">
        <div class="card-header"style="background-color:#676767;"><h5>' . $record . '</h5></div>
        <div class="card-body text-secondary" >';

        $cpt=0;
        foreach ($joueurs as $joueur) {
            if ($cpt !== 0){
                echo '<hr>';
            }
            $cpt++;
            echo '<p class="card-text" style="color:black;">'. $joueur .'</p>';
        }
        
        echo '</div> </div> </div>';
    }
    
?>

</div>
        



<?php include("Joli/footer.php"); ?>
