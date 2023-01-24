<?php 
$title = 'À propos';
include("Joli/header.php"); 
?>

<div class="row">
    <div class="col-md-4">
        <div id="mapid2"></div>
        <script src='http://maps.stamen.com/js/tile.stamen.js?v1.3.0'></script>

        <script>
            var mymap = L.map('mapid2').setView([43.6452, 3.9190], 8) ;
            let layer = new L.StamenTileLayer('terrain');
            mymap.addLayer(layer);

            var Univ = L.marker([43.630987, 3.8606988]).addTo(mymap)
            Univ.bindPopup('Faculté des sciences de Montpellier');

        </script>
    </div>

    <div class="col-md-8">
    <br>
        Nous sommes des étudiants de la faculté des sciences de Montpellier. <br>
        Nous avons produit ce site dans le cadre d'un projet tutoré en 
        2ème année de licence en informatique.
        <br>
        <br>
        Pour nous contacter voici nos adresses mails institutionnelles :
        <br>
        <ul>
            <li>Caparros Théo : <a href="mailto:theo.caparros@etu.umontpellier.fr" class="mail"> theo.caparros@etu.umontpellier.fr </a></li>
            <li>Ettahiri Sofian : <a href="mailto:sofian.ettahiri@etu.umontpellier.fr" class="mail"> sofian.ettahiri@etu.umontpellier.fr </a></li>
            <li>Lansalot Clara : <a href="mailto:clara.lansalot@etu.umontpellier.fr"class="mail"> clara.lansalot@etu.umontpellier.fr </a></li>
            <li>Mahraoui Youness : <a href="mailto:youness.mahraoui@etu.umontpellier.fr"class="mail"> youness.mahraoui@etu.umontpellier.fr </a></li>
        </ul>
        <br>
        
        Le contact de notre encadrant de projet : <br>
        <ul>
            <li>Poncelet Pascal : <a href="mailto:pascal.poncelet@lirmm.fr"class="mail"> pascal.poncelet@lirmm.fr</a></li>
            <br><br><br>
        </ul>
    </div>
</div>  


<?php include("Joli/footer.php"); ?>