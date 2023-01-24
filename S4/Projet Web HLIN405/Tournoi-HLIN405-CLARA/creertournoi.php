<?php
session_start();
if(isset($_SESSION["loggedin"])){
    if(($_SESSION["admin"] == 0)){
        echo "<script>window.location.href='index.php';</script>";
        // header("index.php");
        exit;
    }
}
else{
    echo "<script>window.location.href='index.php';</script>";
    // header("index.php");
    exit;
}


$title = 'Création tournoi';
include("Joli/header.php");

$requete = $bdd->prepare("SELECT num_o, nom FROM organisateur");
$requete->execute();

$res = array();

foreach ($requete->fetchAll() as $ok) {
    $res[] = array(
    $ok['num_o'],
    $ok['nom']
    );
}

// print_r($res);
// echo "ok";
?>
    <h1>Créer un tournoi</h1>

    <form class="row" method="POST" action="" enctype="multipart/form-data">

        
        <div class="col-4">
            <input class="form-control mb-1" type="text" placeholder="Nom du tournois" name="nom">
        </div>
        <div class="col-8"></div>

        <div class="col-4 mb-1">
        <select class="form-select" name="nomOrg">
        <option selected>Organisateur</option>
            <?php
                for ($i = 0; $i < count($res); $i++) {
                    //print_r($res[$i]);
                    echo "<option value={$res[$i][0]}>" . $res[$i][1] . "</option>";
                }
            ?>
            
        </select>
        </div>
        <div class="col-8"></div>

        <div class="col-4">
            <input class="form-control mb-1" type="date" placeholder="Date de début" name="dateDeb">
        </div>
        <div class="col-8"></div>

        <div class="col-4">
            <input class="form-control mb-1" type="date" placeholder="date de fin" name="dateFin">
        </div>
        <div class="col-8"></div>
        
        <div class="col-3 mt-3">
            <button type="submit" class="btn btn-secondary mb-3 w-50">OK</button>
        </div>
    </form>
    <?php
    if (isset($_POST['nomOrg'], $_POST['nom'], $_POST['dateDeb'], $_POST['dateFin'])) {
        //echo $_POST['nomOrg'];
        $req = $bdd->prepare("INSERT INTO tournoi(nom, num_orga,date_deb,date_fin) VALUES (?, ?, ?, ?)");
        if ($req->execute(array($_POST['nom'], $_POST['nomOrg'],$_POST['dateDeb'],$_POST['dateFin'] )))
        ?> 
        <script> alert("Le tournoi a bien été créé.") </script>
        <?php 
    }
    ?>
 

    



<?php include("Joli/footer.php"); ?>