<?php
session_start();
try {
	$bdd = new PDO("mysql:host=localhost;dbname=baseDeDonnee", "root", "ilovelinuxnow", array(PDO::ATTR_PERSISTENT => true));
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Échec lors de la bddexion : ' . $e->getMessage();
}
// Vérifie si les champs du pseudo et du mot de passes ont bien été saisis
print_r($_POST);
if(!isset($_POST["username"], $_POST["password"], $_POST["checkpwd"]) or $_POST["checkpwd"]!=$_POST["password"]){
    exit("Les champs n'ont pas été remplit correctement");
}
if($stmt = $bdd->prepare("SELECT * FROM users WHERE username = ?")){
  $stmt->execute(array($_POST["username"]));

  if($stmt->rowCount()==0){
    if(strlen($_POST["password"])>= 6){
      // Insertion du compte dans la base de données
      $inser = $bdd->prepare("INSERT INTO users(username, password, mail, capitaine) VALUES(?, ?, ?, ?)");
      $inser->execute(array($_POST["username"], $_POST["password"],$_POST["mail"],intval(isset($_POST['capitaine']))));
      // Logged in la personne après la création du compte
      $queryId = $bdd->prepare("SELECT * FROM users WHERE username = ?");
      $queryId->execute(array($_POST["username"]));
      $res = $queryId->fetch(PDO::FETCH_ASSOC);

      //Initialisation des variables de sessions
      session_regenerate_id();
			$_SESSION["loggedin"] = TRUE;
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["id"] = $res["id"];
			$_SESSION["capitaine"] = $res["capitaine"];
			$_SESSION["admin"] = $res["admin"];
			$_SESSION["organisateur"] = $res["organisateur"];
      header("Location: index.php");
      print_r($_SESSION);
    }
    else{
      header('Location:connexion.php');
			$_SESSION["mdpPetit"]=TRUE;
    }
  }
  else{
    header('Location:connexion.php');
			$_SESSION["pseudoUse"]=TRUE;
  }
}
else{
  echo "";
}
