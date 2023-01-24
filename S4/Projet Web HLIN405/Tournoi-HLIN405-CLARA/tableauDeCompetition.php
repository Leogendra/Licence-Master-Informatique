
<?php 
$title = 'Tableau de compétition';
include("Joli/header.php");
?>
<link rel="stylesheet" href="css/simulation.css">
<link rel="stylesheet" href="css/equipesinscrites.css"> 

<?php
$servname = "localhost";
$user = "root";
$password = "ilovelinuxnow";
$dbh = "baseDeDonnee";
$conn = new mysqli($servname, $user, $password, $dbh);
if ($conn->connect_error) {
    die("Echec de la connexion: " . $conn->connect_error);
}


?>

<form class="row" method = "POST">
  <div class="col-4 mb-2">
  <select class= "form-select" name ="nomb">
    <option selected>Choisissez le tournoi</option>
    <?php
      $requete= $bdd->prepare("SELECT num_tournoi, nom FROM tournoi");
      $requete->execute();
      
      foreach ($requete->fetchAll() as $res) {
          echo "<option value={$res['num_tournoi']}>" . $res['nom'] . "</option>";
      }
    ?>
  </select>
    </div>

    <div class="col-3 ">
      <button type="submit" class="btn btn-secondary mb-3 w-50" value="OK">OK</button>
    </div>
    <button type="button" class="btn btn-secondary col-3" onclick="launch()">Lancer la simulation</button> 

</form>

<?php
//A partir du moment où on selectionne un tournoi (non aléatoire)
if(isset($_POST["nomb"]))
{
    $tournoisEnCours= $_POST["nomb"];
    //Id importante pour l'innerHTML qui va placer les équipes qui participent au tournoi
    echo '<h1>Participants :</h1> <br><div  id= "equipe" class="row">';



    $eq = mysqli_query($conn, "SELECT num_eq,nom,niveau  FROM participe, equipe WHERE num_eq = num_equipe AND num_tournoi = $tournoisEnCours");
    $tabEquipe_temp = mysqli_fetch_all($eq);
    shuffle($tabEquipe_temp);
    $tabEquipe = array(); // Tableau servant à récupérer toutes les équipes participant au tournoi choisi
    $powa = array(); // Tableau servant à récupérer les puissances de chaque équipe 
    foreach($tabEquipe_temp as $tabl)
    {
        $tabEquipe[] = array($tabl[0], $tabl[1]);
        $powa[] = $tabl[2];
        echo'<div class="col-3 text-center"> <h5>'.$tabl[1].'  </h5></div>';
    }
    echo '</div> <br><br> <p id="containerTABLE">Lancez la simulation !</p>';
    $dateMatch = "2021-04-13 04:00:00";

    $tabPourSimu = array();
    $index=0;

    $scores=array(); // Tableau qui va permettre de stocker les scores de chaque match

    while(count($tabEquipe)>1) // Nous allons maintenant lancer le tournoi
    {
        $tabEquipe = array_values($tabEquipe); //on réindexe les tableaux
        $powa=array_values($powa);
        $copieTabEquipe = $tabEquipe; //On on les copie
        $powacopy=$powa;
        $tabPourSimu = array_merge($tabEquipe, $tabPourSimu);
        for($i = 0; $i < count($copieTabEquipe); $i = $i + 2) 
        {
            $equipe1 = $copieTabEquipe[$i];  //On identifie les deux équipes qui vont s'affronter lors de ce match
            $equipe2 = $copieTabEquipe[$i+1];
            $powaeq1=$powacopy[$i];
            $powaeq2=$powacopy[$i+1];
            /*

              Faire un try catch a chaque entrée dans la base
              prelvl1 = mysqli_querry($conn, "SELECT niveau FROM equipe WHERE num_eq = $equipe1");
              $lvl1 = mysqli_fetch_row($prelvl1);
              prelvl2 = mysqli_querry($conn, "SELECT niveau FROM equipe WHERE num_eq = $equipe2");
              lvl2 = mysqli_fetch_row($prelvl2);
            */


            //Simulation des scores (sans le niveau pour l'instant) dans le cas d'un BO3
            $score1;
            $score2;
            $victoire;
            if (abs($powaeq2-$powaeq1)<15) //Si une équipe est bien plus forte de l'autre le match est gagné par l'équipe la plus forte
            {
                if(rand(1, 2) == 1)
                {
                    $victoire = $equipe1;
                    $score1 = 2;
                    $score2 = rand(0,1);
                    unset($tabEquipe[($i+1)]);
                    unset($powa[($i+1)]);
                    $scores=array_merge($scores,["$score1-$score2"]);
                }
                else
                {
                    $victoire = $equipe2;
                    $score2 = 2;
                    $score1 = rand(0,1);
                    unset($tabEquipe[$i]);
                    unset($powa[$i]);
                    $scores=array_merge($scores,["$score2-$score1"]);
                }
            }
            else
            {
                if($powaeq1>$powaeq2)
                {
                    $victoire=$equipe1;
                    $score1=2;
                    $score2=rand(0,1);
                    unset($tabEquipe[($i+1)]);
                    unset($powa[($i+1)]);
                    $scores=array_merge($scores,["$score1-$score2"]);
                }
                else
                {
                    $victoire = $equipe2;
                    $score2 = 2;
                    $score1 = rand(0,1);
                    unset($tabEquipe[$i]);
                    unset($powa[$i]);
                    $scores=array_merge($scores,["$score2-$score1"]);
                }
            }
            // Insertion de la partie dans la table game
            $stmt = $conn->prepare("INSERT INTO game (date_game, num_tournoi, num_eq1, num_eq2, score_eq1, score_eq2, eq_gagnante) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("siiiiii", $dateMatch, $tournoisEnCours, $equipe1, $equipe2, $score1, $score2, $victoire);
            $stmt->execute();
        }
        $stmt->close();
        $index++;
    }
    $tableauLeVrai=array();
    $scores=array_reverse($scores);   //On renverse la table pour aider à créer notre tableau dans la fonction javascript prévue à cet effet


    $tabEquipe=array_values($tabEquipe); // On réindexe le tableau


    for($i=0; $i <count($tabPourSimu); $i++){
        $tableauLeVrai[] = $tabPourSimu[$i][1]; // on récupère dans le tableau uniquement le nom des équipes,...
        //...leur numéro n'est plus utile pour la suite du programme
    }


    array_unshift($tableauLeVrai, $tabEquipe[0][1]); //On a une chance sur deux pour que me premier élément du tableau soit vide, c'est...
    //...pourquoi on réindexe pour ce cas précis.

    $taille=count($scores);

    for($i=0;$i<count($tableauLeVrai);$i++)
    {
      if ($taille>$i) //On fait en sorte que chaque élément du tableau soit un tableau (pour nous aider lors de la création de la table ...
      //... pour notre programme javascript)
      {
        $tableauLeVrai[$i]=[$tableauLeVrai[$i],$scores[$i]];
      }
      else
      $tableauLeVrai[$i]=[$tableauLeVrai[$i],"0"]; //Et pour le reste, on comble le vide parce que ça ne sous sert à rien pour la suite
    }
}
?>
<br><br>
<p id="team"></p> <!-- cette balise sert pour le innerHTML afin d'y afficher les équipes participants au tournoi-->
<button type="button" class="btn btn-secondary" onclick="launchRandom()">Lancer une simulation automatique</button>
<p id="containerTABLE"></p>

<script>
    function GetTeamRandom()
    {
      <?php
      $TEAM=mysqli_query($conn,"SELECT num_eq,nom,niveau FROM equipe"); //On importe toutes les équipes de la table équipe
      $TEAMTEMP= mysqli_fetch_all($TEAM);
      shuffle($TEAMTEMP); //On les mélange
      $TEAMFINALES=[];
      $POWA=[];
      for ($i=0; $i<4;$i++) //Et on prend les 4 premières équipes du tableau
      {
        $TEAMFINALES[]=$TEAMTEMP[$i];
      }

      ?>
      let TEAM=<?php echo json_encode($TEAMFINALES, JSON_HEX_TAG);?>;
      return TEAM;
    }

    function Tournament()
    {
      <?php
      //On refait ici la même chose qu'au dessus pour jouer tout les matchs
      $tournoisEnCours=0;
      $TEST;
      $dateMatch = "2021-04-13 04:00:00";
      $tabEquipe=array();
      $powa=array();
      $tabPourSimu=array();
      $index=0;
      $SCORES=array();
      foreach($TEAMFINALES as $tabl)
      {
        $tabEq[] = array($tabl[0], $tabl[1]);
        $powa[] = $tabl[2];
      }
      while(count($tabEq)>1)
      {
        $tabEq=array_values($tabEq);
        $powa=array_values($powa);
        $copyEq=$tabEq;
        $powacopy=$powa;
        $tabPourSimu=array_merge($tabEq,$tabPourSimu);
        for($i=0;$i<count($copyEq);$i+=2)
        {
          $eq1=$copyEq[$i];
          $eq2=$copyEq[$i+1];
          $powaEq1=$powacopy[$i];
          $powaEq2=$powacopy[$i+1];
          $score1;
          $score2;
          $vic;
          if(abs($powaEq2-$powaEq1)<15)
          {
            if (rand(1,2)==1)
            {
              $vic=$eq1;
              $score1=2;
              $score2=rand(0,1);
              unset($tabEq[$i+1]);
              unset($powa[$i+1]);
              $SCORES=array_merge($SCORES,["$score1-$score2"]);
            }
            else
            {
              $vic=$eq2;
              $score2=2;
              $score1=rand(0,1);
              unset($tabEq[$i]);
              unset($powa[$i]);
              $SCORES=array_merge($SCORES,["$score2-$score1"]);
            }
          }
          else
          {
            if($powaEq1>$powaEq2)
            {
              $vic=$eq1;
              $score1=2;
              $score2=rand(0,1);
              unset($tabEq[($i+1)]);
              unset($powa[($i+1)]);
              $SCORES=array_merge($SCORES,["$score1-$score2"]);
            }
            else
            {
              $vic=$eq2;
              $score2=2;
              $score1=rand(0,1);
              unset($tabEq[$i]);
              unset($powa[$i]);
              $SCORES=array_merge($SCORES,["$score2-$score1"]);
            }
          }
          $string= <<<EOT
            INSERT INTO game 
             (date_game, num_tournoi, num_eq1, 
            num_eq2, score_eq1, score_eq2, eq_gagnante)
            VALUES
             (?, ?, ?,
            ?, ?, ?, ?)
EOT;
          $stmt = $conn->prepare($string);
          $stmt->bind_param("siiiiii", $dateMatch, $tournoisEnCours, $eq1, $eq2, $score1, $score2, $vic);
          $stmt->execute();
        }
        $stmt->close();
        $index++;
        // $tabEq=[];
      }
      $tableauleVrai=array();
      $tabEq=array_values($tabEq);
      for($i=0; $i <count($tabPourSimu); $i++)
      {
        $tableauleVrai[] = $tabPourSimu[$i][1];
      }
      array_unshift($tableauleVrai, $tabEq[0][1]);
      $TAILLES=count($SCORES);
      for($i=0;$i<count($tableauleVrai);$i++)
      {
        if ($i<$TAILLES)
        {
          $tableauleVrai[$i]=[$tableauleVrai[$i],$SCORES[$i]];
        }
        else
        {
          $tableauleVrai[$i]=[$tableauleVrai[$i],"0"];
        }
      }
      ?>
      let tabEquipe=<?php echo json_encode($tableauleVrai,JSON_HEX_TAG);?>;
      return tabEquipe;
    }

    function getTeam(incr, tableau) //On va ici créer un tableau de façon automatique qui nous servira pour le programme de rendu
    {
      if(incr < Math.floor(tableau.length / 2)) //Ici c'est pour les éléments qui ne seront pas les feuilles de l'arbre 
      {
        let equipes={};
        equipes.name = `<b>⚔</b> ${tableau[incr][0]}  <sub>${tableau[incr][1]}</sub>`;
        equipes.children = [];
        equipes.children.push(getTeam((2*incr)+1,tableau));
        equipes.children.push(getTeam((2*incr)+2,tableau));
        return equipes;
      }
      else //Et là ça sera les feuilles de nos arbre binaire du tournoi
      {
        let equipes={};
        equipes.name=`${tableau[incr][0]}`;
        return equipes;      
      }
    }
  
    function renduHTML(equipes) //Elle permet d'afficher les équipes qui participent au tournoi aléatoire
    {
      let stringrendu=`<br><div class="row">`;
      for (let i=0;i<4;i++)
      {
        stringrendu+=`<div class="col-3 text-center"> <h5> ${equipes[equipes.length-1-i][1]}  </h5></div>`;
      }
      stringrendu+="</div>";
      return stringrendu;
    }

    function createTable(equipes) { //La fonction principale qui permet de faire un rendu sous forme d'arbre binaire afin ...
    //... d'afficher notre tournoi
      let out  =  `<table > 
        <tr>
          <td></td>
          <td class="equipe" colspan="2">
            <div class="nomeq">
              ${equipes.name}
            </div>
            </td>
          <td></td>
        </tr>` //Tout d'abord on crée une table avec le nom de l'équipe qui est prise du tableau représentant un arbre binaire complet
      if (equipes.children && equipes.children.length > 0) {//Et si elle a des fils (donc si "out" n'est pas une feuille) on va alors ...
      //... créer une partie récursive qui va donc utiliser les enfants de notre équipe ci-dessus 
        out += `<tr>
          <td></td>
          <td class="sepl"></td>
          <td class="sepr"></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td class="sep2l"></td>
          <td class="sep2r"></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2">${createTable(equipes.children[0])}</td>
          <td colspan="2">${createTable(equipes.children[1])}</td>
        </tr>
      </table>`;
      } else {
        out += `</table>`;
      }
        return out;
      
    }
    function launch()
    {
        let TABLEAU=<?php if(isset($tableauLeVrai))
        {
          echo json_encode($tableauLeVrai, JSON_HEX_TAG); //Ca permet de récupérer le tableau uniquement quand on a choisit un tournoi
        }
        else
        {
          echo "{}"; //Sinon ça donne un tableau vide
        }
        ?>;
        let Equipes=getTeam(0,TABLEAU);
        document.getElementById("containerTABLE").innerHTML = createTable(Equipes); //On écrase la balise contenant l'id ...
        //... "containerTABLE" pour y afficher notre arbre binaire complet 

    }

    function launchRandom()
    {
      let equipesrendu =GetTeamRandom(); //On récupère les équipes choisit au hasard
      const container=document.getElementById("equipe");
      if (container)
      {
        container.innerHTML=renduHTML(equipesrendu); //Si on a déjà affiché le tableau avec toutes les équipes pour un tournoi voulu...
        //... on écrase le tableau de l'ancien tournoi pour y afficher le nouveau
      }
      else
      {
        document.getElementById("team").innerHTML="<h1> Participants : </h1>"+renduHTML(equipesrendu); //Sinon on affiche le tableau ...
        //... avec en entête un titre pour ce dernier   
      }
      let Equipes=Tournament();
      let equipes=getTeam(0,Equipes);
      document.getElementById("containerTABLE").innerHTML=createTable(equipes); // Et on affiche le rendu de l'arbre binaire complet
    }
</script>

<?php include("Joli/footer.php"); ?>

