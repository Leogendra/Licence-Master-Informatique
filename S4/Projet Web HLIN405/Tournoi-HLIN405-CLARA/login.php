<?php
session_start();
try {
	$bdd = new PDO("mysql:host=localhost;dbname=baseDeDonnee", "root", "ilovelinuxnow", array(PDO::ATTR_PERSISTENT => true));
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Échec lors de la connexion : ' . $e->getMessage();
}


// Vérifie si les champs du pseudo et du mot de passes ont bien été saisis
if (!isset($_POST["username"], $_POST["password"])) {
	exit("Les champs n'ont pas été remplit correctement");
}
if ($stmt  = $bdd->prepare('SELECT * FROM users WHERE username = ?')) {
	// $stmt->bindParam(1, $_POST["username"], PDO::PARAM_STR, 12);
	$stmt->execute(array($_POST["username"]));
	//Verification de l'existance du compte dans la base de données
	if ($stmt->rowCount() > 0) {
		// $id = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
		// $username = $stmt->fetchAll(PDO::FETCH_COLUMN, 1);
		$res = $stmt->fetch(PDO::FETCH_ASSOC);

		if($_POST["password"] == $res["password"]){
			session_regenerate_id();
			$_SESSION["loggedin"] = TRUE;
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["id"] = $res["id"];
			$_SESSION["capitaine"] = $res["capitaine"];
			$_SESSION["admin"] = $res["admin"];
			$_SESSION["organisateur"] = $res["organisateur"];
			// print_r($_SESSION);
			header("Location: index.php");
		}
		else{			
			header('Location:connexion.php');
			$_SESSION["failToConnect"]=TRUE;									
		}
	} else {
		header('Location:connexion.php');
			$_SESSION["failToConnect"]=TRUE;			
	}

	// $stmt->close();
}
