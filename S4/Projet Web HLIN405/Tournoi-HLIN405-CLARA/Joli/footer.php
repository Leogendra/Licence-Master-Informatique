
    </section> <!-- FIN du texte-->
    
    <footer class="footer" >
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-3">
                <p class="text-center">
                  <a href="carte.php"id="lien"> Carte</a>
                  <br>
                  <a href="contact.php"id="lien"> À propos</a>
                  <br>
                </p>
              </div>

              <div class="col-3">
                <p class="text-center">
                <a href="joueur.php" id="lien"> Les joueurs</a>
              </div>

              <div class="col-3">
                <p class="text-center">
                <a href="inscriptionEquipe.php" id="lien">Inscrire une équipe</a>
                <br>
                  <a href="creertournoi.php" id="lien">Créer un tournoi</a>                
              </p>
              </div>

              <div class="col-3">
                <p class="text-center">
                <a href="tableauDeCompetition.php" id="lien">Tableau de compétition</a>
                </p>
              </div>
            </div>
        
            <div class="divider xs-white"> <!-- petite ligne de séparation-->
              <hr class="mt-2 mb-2">
            </div>

            <div class="row">
            <p class="text-center" id="oui" style="font-size:smaller;">
              Copyright © Nous All Rights Reserved
            </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    </div>
    </body>
    
    
<script>
// S'active quand on scroll :
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

// Sticky quand on scroll, revient à sa position quand on est tout en haut
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>


</html> 
