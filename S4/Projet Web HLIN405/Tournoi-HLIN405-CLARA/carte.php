   <?php 
$title = 'Carte';
include("Joli/header.php"); 
?>


<h2>
Vous pouvez retrouver sur cette carte tous les grands lieux de rendez-vous Esport pour les différents tounois de League of Legend en France.
</h2>
<br>

<div id="mapid"></div>
<script src='http://maps.stamen.com/js/tile.stamen.js?v1.3.0'></script>
<script>
    var mymap = L.map('mapid').setView([47.1539, 2.2508], 6) ;
    let layer = new L.StamenTileLayer('terrain');
    mymap.addLayer(layer);

    var GRex = L.marker([48.8704, 2.3475]).addTo(mymap)
    GRex.bindPopup('Grand Rex Paris');

    var ArMtp = L.marker([43.5724, 3.9513]).addTo(mymap)
    ArMtp.bindPopup('Arena Montpellier');

    var ZStra = L.marker([48.5930, 7.68711]).addTo(mymap)
    ZStra.bindPopup('Zenith Strabourg');

    var AHAr = L.marker([48.8385414, 2.3763955]).addTo(mymap)
    AHAr.bindPopup('AccorHotel Arena Paris');

    var TEsCon = L.marker([43.5763862, 1.4715039]).addTo(mymap)
    TEsCon.bindPopup('Toulouse Esport Concept');

    var CasBarT = L.marker([43.5720442,1.4319524]).addTo(mymap)
    CasBarT.bindPopup('Casino Barrière Toulouse');

    var ArkAr = L.marker([44.8246486,-0.533891]).addTo(mymap)
    ArkAr.bindPopup('Arkéa Arena Bordeaux');

    var DomeMar = L.marker([43.3152972,5.4022549]).addTo(mymap)
    DomeMar.bindPopup('Le Dôme Marseille');

    var CCLyon = L.marker([45.7849119,4.8523098]).addTo(mymap)
    CCLyon.bindPopup('Centre de Congrès de Lyon');

    var CasBarL = L.marker([50.6365331,3.0748712]).addTo(mymap)
    CasBarL.bindPopup('Casino Barrière Lille');

    var ZenNan = L.marker([47.2287056,-1.6301253]).addTo(mymap)
    ZenNan.bindPopup('Zenith Nantes');


</script>

<br>
<?php $generateMailTel = function($tel, $mail) : void {
  echo '
<div class="row mt-3">
    <div class="col-3"></div>
    <div class="col-6">
        <img src="Joli/Images/icTel.png" id="icone">
        ' . $tel . '
    </div>
    <div class="col-3"></div>
    <div class="col-3"></div>
    <div class="col-6">
        <img src="Joli/Images/icAdr.png" id="icone"> 
        ' . $mail . '
    </div>
    <div class="col-3"></div>
</div>
  ';
}
?>

<div class="container">
   <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <p class="text-center">
                        <b>Grand rex Paris</b>
                    </p>
                    <div class="text-center">
                        <img src="Joli/Images/LGR.jpg" id="imMap">
                    </div>
                    <?php $generateMailTel('01 45 08 93 89', '1 Boulevard Poissonnière, 75002 Paris'); ?>                   
                           
                    <br>             
                    <hr id="sepMap">

                    <p class="text-center">
                        <b>AccorHotel Arena Paris</b>
                    </p>
                    <div class="text-center">
                        <img src="Joli/Images/AHA.jpg" id="imMap"></div>
                        <?php $generateMailTel('01 75 44 04 00', '8 Boulevard de Bercy, 75012 Paris'); ?>
                        
                    <hr id="sepMap">
                    
                    <p class="text-center">
                        <b>Casino Barrière Lille</b>
                    </p>
                    <div class="text-center">
                    <img src="Joli/Images/CBL.jpg" id="imMap"></div>
                    <?php $generateMailTel('03 28 14 47 77', '777 Pont de Flandres, 59777 Lille'); ?>

                    <hr id="sepMap">
                
                    <p class="text-center">
                        <b>Centre de Congrès de Lyon</b>
                    </p>
                    <div class="text-center">
                        <img src="Joli/Images/CCL.jfif" id="imMap">
                    </div>
                    <?php $generateMailTel('04 72 82 26 26', '50 Quai Charles de Gaulle, 69006 Lyon'); ?>
                </div>

                <div class="col-md-4">
                    <p class="text-center">
                        <b>Toulouse Esport Concept</b> </p>
                    <div class="text-center">
                        <img src="Joli/Images/TES.jpg" id="imMap"> </div>                    
                    <?php $generateMailTel('05 32 10 80 72', '9 Rue Valentina Terechkova, 31400 Toulouse'); ?>

                    <hr id="sepMap">

                    <p class="text-center">
                        <b>Casino Barrière Toulouse</b></p>                    
                    <div class="text-center">
                        <img src="Joli/Images/CBT.jpg" id="imMap"></div>
                        <?php $generateMailTel('05 61 33 37 77', '18 Chemin de la Loge, 31400 Toulouse'); ?>

                    <hr id="sepMap">

                    <p class="text-center">
                        <b>Le Dôme Marseille </b></p>
                    <div class="text-center">
                    <img src="Joli/Images/DM.jpg" id="imMap"></div>
                    <?php $generateMailTel('04 91 12 21 21', '48 Avenue de Saint-Just, 13004 Marseille'); ?>

                    <hr id="sepMap">

                    <p class="text-center">
                        <b>Zenith Strasbourg</b> </p>
                    <div class="text-center">
                    <img src="Joli/Images/ZS.jpg" id="imMap"></div>
                    <?php $generateMailTel('03 88 10 50 50', '1 Allée du Zénith, 67201 Eckbolsheim'); ?>                   
                </div>

                <div class="col-md-4">
                <p class="text-center">
                        <b>Arena Montpellier</b> </p>
                    <div class="text-center">
                        <img src="Joli/Images/AM.jpg" id="imMap"> </div>
                        <?php $generateMailTel('04 67 17 68 17', 'Route de la Foire, 34470 Pérols'); ?>
                        
                    <br> 
                    <hr id="sepMap">

                    <p class="text-center">
                        <b>Zenith Nantes</b></p>
                    <div class="text-center">
                        <img src="Joli/Images/ZL.gif" id="imMap"></div>
                        <?php $generateMailTel('02 40 92 99 50', 'Boulevard du Zénith, 44800 Saint-Herblain'); ?>

                    <hr id="sepMap">

                    <p class="text-center">
                        <b>Arkéa Arena Bordeaux</b></p>
                    <div class="text-center">
                        <img src="Joli/Images/AA.gif" id="imMap"></div>
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <img src="Joli/Images/icAdr.png" id="icone"> 48-50 Avenue Jean Alfonséa, 33270 Floirac
                                <br><br><br>
                            </div>
                        </div>          
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


<?php include("Joli/footer.php"); ?>