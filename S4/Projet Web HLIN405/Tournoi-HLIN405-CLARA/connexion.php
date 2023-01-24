<?php
session_start();

if (isset($_SESSION["loggedin"])) {
    header("Location:index.php");
    exit;    
  }

  $title = 'Connexion';
  include("Joli/header.php");

if (isset($_SESSION["failToConnect"]) and ($_SESSION["failToConnect"])){
    ?> <script> alert("Pseudo ou mot de passe incorrect") </script>
    <?php 
    unset($_SESSION["failToConnect"]);    
}

if (isset($_SESSION["pseudoUse"]) and ($_SESSION["pseudoUse"])){
    ?> <script> alert("Pseudo déjà utilisé") </script>
    <?php
    unset($_SESSION["pseudoUse"]);
}
if (isset($_SESSION["mdpPetit"]) and ($_SESSION["mdpPetit"])){
    ?> <script> alert("Le mot de passe est trop petit") </script>
    <?php
    unset($_SESSION["mdpPetit"]);
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6" id="con_log">
            <h1>Login</h1>
                <form action="login.php" method="post" class ="form-container" style="background-color:#9b9b9b; ">
                <label for="username" class="col-12 col-form-label ">
                        <h6>Pseudo</h6>
                        <div class="col-3">
                            <input type="text"  name="username" class="form-control" id="username">
                        </div>
                    </label>
                    <!-- <input type="text" name="username" placeholder="Pseudo" id="username" required> -->
                    
                    <label for="password" class="col-12 col-form-label ">
                        <h6>Mot de passe</h6>
                        <div class="col-3">
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </label>
                    <!-- <br> 
                    <br>
                    <input type="password" name="password" placeholder="Mot de passe" id="password" required>
                    <br>
                    <br> -->
                    <!-- <input type="submit" value="Se connecter">   -->
                    
                    <div class="col-auto mt-3">
                        <button type="submit" class="btn btn-secondary mb-3 ">Se connecter</button>
                    </div>
                </form>
        </div>

        <div class="col-md-6" id="con_inscr">
            <h1 >Inscription</h1>
                <form action="register.php" method="post" class ="form-container" style="background-color:#9b9b9b; ">

                    <label for="mail" class="col-12 col-form-label">
                        <h6>Adresse mail</h6>
                        <div class="col-3">
                            <input type="email" name="mail" class="form-control" id="mail">
                        </div>
                    </label>
                
                    <label for="username" class="col-12 col-form-label ">
                        <h6>Pseudo</h6>
                        <div class="col-3">
                            <input type="text" name="username" class="form-control" id="username">
                        </div>
                    </label>
                    
                    <label for="password" class="col-12 col-form-label">
                        <h6>Mot de passe</h6>
                        <div class="col-3">
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </label>
                    
                    <label for="checkpwd" class="col-12 col-form-label ">
                        <h6>Vérification mot de passe</h6>
                        <div class="col-3">
                            <input type="password" name="checkpwd" class="form-control" id="checkpwd">
                        </div>
                    </label>
                    <label for="capitaine" class="mt-1" >  
                    <h6> Capitaine ?                                             
                        <input class="form-check-input mt-1 " type="checkbox" value=1 name="capitaine" style="margin-left:10px;" >  </h6>             
                    </label>

            <!--   <input type="text" name="mail" placeholder="Adresse mail" id="mail" required>
                    <br>
                    <br>
                    <input type="text" name="username" placeholder="Pseudo" id="username" required>
                    <label for="password" class="col-sm-4 col-form-label">
                        <i class="fas fa-lock"></i>
                    </label>
                    <br>
                    <br>
                    <input type="password" name="password" placeholder="Mot de passe" id="password" required>
                    <br>
                    <br>
                    <input type="password" name="checkpwd" placeholder="Vérification mot de passe" id="checkpwd" required>
                    <br>
                    <br> 
                     <input type="submit" value="S'inscrire"> -->
                     <div class="col-auto mt-3 mb-3">
                        <button type="submit" class="btn btn-secondary mb-3 ">S'inscrire</button>
                    </div>
                </form>
        </div>
    </div>
</div>



<?php include("Joli/footer.php"); ?>
