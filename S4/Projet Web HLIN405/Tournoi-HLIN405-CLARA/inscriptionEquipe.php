<?php
session_start();
if(isset($_SESSION["loggedin"])){
    if((($_SESSION["capitaine"] == 0) and ($_SESSION["admin"] == 0))){
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
$title = 'Inscription équipe';
include("Joli/header.php");
include("test_login.html");
?>

<div class="row">

    <div class="col-md-6">

    <h1>Inscrire une équipe</h1>
    <p> N'oubliez pas de cocher le capitaine à côté du joueur !</p>

    <form class="row" method="POST" action="" enctype="multipart/form-data">

        <div class="col-6">
            <input class="form-control mb-1" type="text" placeholder="Nom de l'équipe" name="nom">
        </div>
        <div class="col-6"></div>

        <div class="col-6">
            <input class="form-control mb-1" type="number" placeholder="Niveau (1-100)" name="niveau" min=1 max=100>
        </div>
        <div class="col-6"></div>

        <div class="col-6">
            <div class="input-group mb-1 col-6">
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="radio" value=1 name="num_cap" checked>
                </div>
                    <input class="form-control " type="text" placeholder="Joueur 1" name="1" >
            </div>
        </div>
        <div class="col-6"></div>

        <div class="col-6">
            <div class="input-group mb-1 col-6">
                <div class="input-group-text ">
                    <input class="form-check-input mt-0" type="radio" value=2 name="num_cap" >
                </div>
                    <input class="form-control" type="text" placeholder="Joueur 2" name="2">
            </div>
        </div>
        <div class="col-6"></div>

        <div class="col-6">
            <div class="input-group mb-1 col-6">
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="radio" value=3 name="num_cap">
                </div>
                    <input class="form-control " type="text" placeholder="Joueur 3" name="3">
            </div>
        </div>
        <div class="col-6"></div>

        <div class="col-6">
            <div class="input-group mb-1 col-6">
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="radio" value=4 name="num_cap">
                </div>
                    <input class="form-control " type="text" placeholder="Joueur 4" name="4">
            </div>
        </div>
        <div class="col-6"></div>

        <div class="col-6">
            <div class="input-group mb-1 col-6">
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="radio" value=5 name="num_cap" >
                </div>
                    <input class="form-control " type="text" placeholder="Joueur 5" name="5">
            </div>
        </div>
        <div class="col-6"></div>

        <div class="col-6 mb-1">
            <input class="form-control" type="file" id="fichier" name="fichier">
        </div>
        <div class="col-6"></div>


        <div class="col-3 mt-3">
            <button type="submit" class="btn btn-secondary mb-3 w-50">OK</button>
        </div>

    </form>

    </div>


    <div class="col-md-6">    
    <h1>Inscrire une équipe à un tournoi</h1>
        <p> Choisissez votre équipe et inscrivez-la au tournoi de votre choix ! </p>

    <form class="row" method="POST" action="" enctype="multipart/form-data">

        <div class="col-6 mb-1 ">
            <select class="form-select" name="nomEquipe">
            <option selected>Nom de l'équipe</option>
                <?php
                    $requete= $bdd->prepare("SELECT num_eq, nom FROM equipe");
                    $requete->execute();
                    
                    foreach ($requete->fetchAll() as $res) {
                        echo "<option value={$res['num_eq']}>" . $res['nom'] . "</option>";
                    }
                ?>
                
            </select>
        </div>
        <div class="col-6"></div>

        <div class="col-6 mb-1">
            <select class="form-select" name="nomTournoi">
            <option selected>Nom du tournoi</option>
                <?php
                    $requete= $bdd->prepare("SELECT num_tournoi, nom FROM tournoi");
                    $requete->execute();
                    
                    foreach ($requete->fetchAll() as $res) {
                        echo "<option value={$res['num_tournoi']}>" . $res['nom'] . "</option>";
                    }
                ?>
                
            </select>
        </div>            
        <div class="col-6"></div>

        <div class="col-3 mt-3">
            <button type="submit" class="btn btn-secondary mb-3 w-50">OK</button>
        </div>
    </form>
    </div>

</div>


<?php include("Joli/footer.php"); ?>

<?php
//echo count($_POST);
//Test
$myPost = array_values($_POST);

//print_r($_POST);



// Création des joueurs
if (isset($_POST["nom"], $_POST["niveau"], $_POST["1"], $_POST["2"], $_POST["3"], $_POST["4"], $_POST["5"], $_POST["num_cap"])) {
    for ($i = 2; $i < count($myPost); $i++) {
        if ($myPost[$i] != $_POST['num_cap']) {
            // echo $i . "\n";
            // echo $_POST[$i] . "\n";
            $requete1 = $bdd->prepare("INSERT INTO joueur(nom) VALUES(?)");
            $requete1->execute(array($myPost[$i]));
        }
    }
    $cal = (5 - $_POST['num_cap']);
    //echo "le joueur capitaine est dans la base $cal";
    $requete2 = $bdd->query("SELECT licence FROM joueur ORDER BY licence DESC LIMIT 1 OFFSET $cal");
    $resultat2 = $requete2->fetchAll(PDO::FETCH_ASSOC);

    // Création de l'équipe (probleme ici)

    //echo "Equipe creation";
    // Upload de l'
    if (isset($_FILES['fichier'])) {
        $directory = __DIR__ . "/image/";
        //print_r($_FILES);
        $extension = strtolower(pathinfo($_FILES["fichier"]["name"], PATHINFO_EXTENSION));
        $checkUpload = 1;
        $_FILES["fichier"]["name"] = $_POST['nom'] . ".$extension";
        $empl_fichier = $directory . basename($_FILES["fichier"]["name"]);

        if (file_exists($empl_fichier)) {
            echo "Sorry, file already exists.";
            $checkUpload = 0;
        }

        if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $checkUpload = 0;
        }

        if ($checkUpload == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $empl_fichier)) {
                $requete = $bdd->prepare("INSERT INTO equipe(nom, niveau, num_cap, img_dir) VALUES(?, ?, ?, ?)");
                $requete->execute(array($_POST['nom'],  $_POST['niveau'], $resultat2[0]['licence'], $empl_fichier));
                echo "The file " . htmlspecialchars(basename($_FILES["fichier"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file" . $_FILES['fichier']['error'];
            }
        }
    } else {
        $requete = $bdd->prepare("INSERT INTO equipe(nom, niveau, num_cap) VALUES(?, ?, ?)");
        if ($requete->execute(array($_POST['nom'],  $_POST['niveau'], $resultat2[0]['licence'])))
        ?>
        <script> alert("L'équipe a bien été inscrite.") </script>
        <?php
    }


    // Récuperation de la dernière équipe crées (SEUL QUI MARCHE -> Pas de probleme ici)
    $num_equipe = $bdd->query('SELECT MAX(num_eq) FROM equipe');
    $num_e = $num_equipe->fetchAll(PDO::FETCH_ASSOC); // il faut utiliser lui $num_e[0]['MAX(num_eq)']

    //echo $num_e;
    // Récuperation des 5 derniers joueurs crées
    $test = $bdd->query("SELECT licence FROM joueur ORDER BY licence DESC LIMIT 5");
    $ok = $test->fetchAll(PDO::FETCH_ASSOC);
    //echo "count ok = " . count($ok) . " ";


    //Intégration des 5 derniers joueurs crées dans la dernière équipe creée (probleme ici)
    for ($j = 0; $j < count($ok); $j++) {
        $var = $ok[$j]['licence'];
        $var1 = $num_e[0]['MAX(num_eq)'];
        //echo "licence $j = " . $var . "\n";
        $bdd->exec("INSERT INTO compoequipe(num_eq, licence) VALUES($var1 , $var)");
    }

    // if (isset($_POST["fichier"])) {
    //     // Upload de l'image
    //     // $directory = __DIR__ . "/image/";
    //     // print_r($_FILES);
    //     // $extension = strtolower(pathinfo($_FILES["fichier"]["name"], PATHINFO_EXTENSION));
    //     // $checkUpload = 1;
    //     //$_FILES["fichier"]["name"] = "Rogue.$extension";
    //     if ($test = $bdd->query("SELECT nom FROM equipe WHERE num_eq=(SELECT MAX(num_eq) FROM equipe)", PDO::FETCH_ASSOC)) {
    //         $test = $test->fetch();
    //         echo " nom = " . $test['nom'];
    //     }
    //     $_FILES["fichier"]["name"] = $test['nom'] . ".$extension";
    //     $empl_fichier = $directory . basename($_FILES["fichier"]["name"]);
    // }
}

// Inscription dans un tournoi
if (isset($_POST["nomEquipe"],$_POST["nomTournoi"])){
    $req = $bdd->prepare("INSERT INTO participe(num_tournoi, num_equipe) VALUES (?, ?)");
    if ($req->execute(array($_POST['nomTournoi'], $_POST['nomEquipe'])))
    ?>
    <script> alert("L'équipe a bien été inscrite dans le tournoi.") </script>
    <?php
}


?>

