<?php
session_start();
if (!(isset($_SESSION["loggedin"]))) {
  echo "<script>window.location.href='index.php';</script>";
  // header("index.php");
  exit;
}
$title = 'Mon profil';
include("Joli/header.php");
?>

<?php
$stmt = $bdd->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute(array($_SESSION['id']));
$info = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<h3>Voici vos informations personnelles et les détails de votre compte : </h3> <br> <div class=\"col-4\"><ul class=\"list-group\"> ";

echo "<li class=\"list-group-item\">Mail : " . $info['mail'] . "</li>";
echo "<li class=\"list-group-item\">Pseudo : " . $info['username'] . "</li>";
if (boolval($info['admin'])) {
  echo "<li class=\"list-group-item\">Admin : oui </li>";
} else {
  echo "<li class=\"list-group-item\">Admin : non </li>";
}

if (boolval($info['organisateur'])) {
  echo "<li class=\"list-group-item\">Organisateur : oui </li>";
} else {
  echo "<li class=\"list-group-item\">Organisateur : non </li>";
}

if (boolval($info['capitaine'])) {
  echo "<li class=\"list-group-item\">Capitaine : oui </li>";
} else {
  echo "<li class=\"list-group-item\">Capitaine : non </li>";
}
echo"</ul></div><br> <br>";

if ($_SESSION["organisateur"] == 1) {
?>
  <div class="row">
    <div class="col-md-6">
      <h3>Acceptez les équipes pour votre tournoi :</h3>

      <form class="row" method="POST" action="" enctype="multipart/form-data">

        <div class="col-6 mb-1 mt-3">
          <select class="form-select" id="select1" name="nomTournoi" onchange="selection(this.value)">
            <option selected>Nom du tournoi</option>
            <?php
            $requete = $bdd->prepare("SELECT num_tournoi, nom FROM tournoi WHERE num_orga = ?");

            $requete->execute(array($_SESSION["id"]));

            foreach ($requete->fetchAll() as $res) {
              echo "<option value={$res['num_tournoi']}>" . $res['nom'] . "</option>";
            }
            ?>

          </select>
        </div>
        <div class="col-6"></div>

        <div class="col-6 mb-3 ">
          <select class="form-select" id="select2" name="nomEquipe">
            <option selected>Nom de l'équipe</option>
            <?php
            $requete = $bdd->prepare("SELECT num_eq, nom, num_tournoi FROM equipe, participe WHERE num_eq = num_equipe AND valide = 0");
            $requete->execute();

            foreach ($requete->fetchAll() as $res) {
              echo "<option data-option=" . $res['num_tournoi'] . " value={$res['num_eq']}>" . $res['nom'] . "</option>";
              // 
            }
            ?>

          </select>
        </div>
        <div class="col-6"></div>
            
            
        <div class="row ">
          <div class="col-3 ">
            <button type="submit" class="btn btn-secondary" value="click" name="valider">Valider</button>
            </div>
            <div class="col-3 ">
            <button type="submit" class="btn btn-secondary" value="click" name="refuser">Refuser</button>
          </div> 
          <div class="col-6"></div>      
        </div>
      </form>
    </div>

  </div>
<?php
}

?>
<script>
  var select1 = document.querySelector('#select1');
  var select2 = document.querySelector('#select2');
  var options2 = select2.querySelectorAll('option');

  function selection(value) {
    select2.innerHTML = '';
    for (var i = 0; i < options2.length; i++) {
      if (options2[i].dataset.option === value) {
        select2.appendChild(options2[i]);
      }
    }
  }
  selection(select1.value);
</script>
<?php
function valider($bdd){
  $req = $bdd->prepare("UPDATE participe SET valide = 1 WHERE num_tournoi = ? AND num_equipe = ?");
  $req->execute(array($_POST['nomTournoi'], $_POST['nomEquipe']));
}

function refuser($bdd){
  $req1 = $bdd->prepare("DELETE FROM participe WHERE num_tournoi = ? AND num_equipe = ?");
  $req1->execute(array($_POST['nomTournoi'], $_POST['nomEquipe']));
}

if(isset($_POST['valider'])){
  valider($bdd);
}

if(isset($_POST['refuser'])){
  refuser($bdd);
}
?>


<?php include("Joli/footer.php"); ?>