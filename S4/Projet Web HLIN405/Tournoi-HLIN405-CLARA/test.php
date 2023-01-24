<!DOCTYPE html>
<?php 
session_start();
//$_SESSION["historique"]="";
?>


<html lang="fr">

<head> <meta charset="utf-8"/>
<title> Projet </title>
<link rel="stylesheet" href="css/test.css">
</head>
<body>
<?php
/*
try {
    $dbh = new PDO("mysql:host=localhost;dbname=baseDeDonnee","root","ilovelinuxnow",array(PDO::ATTR_PERSISTENT => true));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Ok ca marche";
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
*/
?>
<h1>Inscription équipes</h1>
<p>Equipe</p>
<form method = "POST" action = "">
    <input type="text" name="nom" placeholder="nom"/>
    <br/>
    <input type="text" name="niveau" placeholder="niveau(1-100)"/> 
    <br/>
    <input type="text" name="1"  placeholder="Joueur 1"/> 
    <input type="radio" name="num_cap" value=1 checked>Capitaine
    <br/>
    <input type="text" name="2" placeholder="Joueur 2"/> 
    <input type="radio" name="num_cap" value=2>Capitaine
    <br/>
    <input type="text" name="3" placeholder="Joueur 3"/> 
    <input type="radio" name="num_cap" value=3>Capitaine
    <br/>
    <input type="text" name="4" placeholder="Joueur 4"/> 
    <input type="radio" name="num_cap" value=4>Capitaine
    <br/>
    <input type="text" name="5" placeholder="Joueur 5"/> 
    <input type="radio" name="num_cap" value=5>Capitaine
    <br/>
    <input type="submit" value="OK">
</form>

<?php
echo "T";
print_r($_POST["nom"]);
echo "T";
$servname = "localhost";
$user = "root";
$password = "ilovelinuxnow";
$dbh = "baseDeDonnee";
$conn = new mysqli($servname, $user, $password, $dbh);
if ($conn->connect_error) {
    die("Echec de la connexion: " . $conn->connect_error);
  }
  echo "Connexion réussite \n";

$monTab = array();

for($i = 0; $i<10; $i++){
    $monTab[$i] = $i;
}
print_r($monTab);

echo "<hr/>";
$copieTab = $monTab;
unset($monTab[2]);
echo "<hr/>";
print_r($monTab);
$monTab=array_values($monTab);
print_r($monTab);
echo"<hr/>";
print_r($copieTab);

$nomEq1="G2";
$nomEq2="FNC";
$nomEq3="KC";
$nomEq4="LINUX";
$nbrEq=4;

$TESTEQ[6] = $nomEq4;
$TESTEQ[5] = $nomEq3;
$TESTEQ[4] = $nomEq2;
$TESTEQ[3] = $nomEq1;
$TESTEQ[2] = $nomEq3;
$TESTEQ[1] = $nomEq1;
$TESTEQ[0] = $nomEq3;

// $TESTEQ=array("6"=>$nomEq4);
// $TESTEQ=array_merge($TESTEQ,array("5"=>$nomEq3));
// $TESTEQ=array_merge($TESTEQ,array("4"=>$nomEq2));
// $TESTEQ=array_merge($TESTEQ,array("3"=>$nomEq1));
// $TESTEQ=array_merge($TESTEQ,array("2"=>$nomEq3));
// $TESTEQ=array_merge($TESTEQ,array("1"=>$nomEq1));
// $TESTEQ=array_merge($TESTEQ,array("0"=>$nomEq3));
echo "<br></br>";
ksort($TESTEQ);

var_dump($TESTEQ);
// $TESTEQ=ksort($TESTEQ);
// print_r($TESTEQ);


echo"<hr/>";
echo"<hr/>";    
?>
<!-- <div id='orgchart' class='orgchart' style='width: 100%; min-height: 0px; max-height: none; height:"+snbH+" px;'><h1>TOURNOI</h1><table width='100%' style='100%'><tbody>
    <tr><td colspan='4' width='100%'><div width='100%' class='charttext'><b>⚔</b><sub>4</sub>LMAO</div></td></tr><tr><td colspan='4'><table width='100%'><tbody><tr><th class='right' width='50%'></th><th></th></tr></tbody></table></td></tr><tr><th width='25%'></th><th class= 'left top' width='25%'></th><th class= 'right top' width='25%'></th><th width='25%'></th></tr><tr><tr><td colspan='4' width='100%'><div width='100%' class='charttext'><b>⚔</b><sub>3</sub>LMAO</div></td></tr><tr><td colspan='4'><table width='100%'><tbody><tr><th class='right' width='50%'></th><th></th></tr></tbody></table></td></tr><tr><th width='25%'></th><th class= 'left top' width='25%'></th><th class= 'right top' width='25%'></th><th width='25%'></th></tr><tr><tr><td colspan='4' width='100%'><div width='100%' class='charttext'><b>⚔</b><sub>2</sub>LMAO</div></td></tr><tr><td colspan='4'><table width='100%'><tbody><tr><th class='right' width='50%'></th><th></th></tr></tbody></table></td></tr><tr><th width='25%'></th><th class= 'left top' width='25%'></th><th class= 'right top' width='25%'></th><th width='25%'></th></tr><tr><tr><td colspan='4' width='100%'><div width='100%' class='charttext'><b>⚔</b><sub>1</sub>LMAO</div></td></tr><tr><td colspan='4'><table width='100%'><tbody><tr><th class='right' width='50%'></th><th></th></tr></tbody></table></td></tr><tr><th width='25%'></th><th class= 'left top' width='25%'></th><th class= 'right top' width='25%'></th><th width='25%'></th></tr><tr>
    </tbody></table></div>
<div id='orgchart' class='orgchart' style='width: 100%; min-height: 0px; max-height: none; height:"+snbH+" px;'><h1>TOURNOI</h1><table width='100%' style='100%'><tbody>    <tr><td colspan='4' width='100%'><div width='100%' class='charttext'><b>⚔</b><sub>4</sub>LMAO</div></td></tr><tr><td colspan='4'><table width='100%'><tbody><tr><th class='right' width='50%'></th><th class='half'></th></tr></tbody></table></td></tr><tr><th width='25%'></th><th class= 'left top' width='25%'></th><th class= 'right top' width='25%'></th><th width='25%'></th></tr>
<tr><td colspan='4' width='100%'><div width='100%' class='charttext'><b>⚔</b><sub>4</sub>LMAO</div></td></tr><tr><td colspan='4'><table width='100%'><tbody><tr><th class='right' width='50%'></th><th></th></tr></tbody></table></td></tr><tr><th width='25%'></th><th class= 'left top' width='25%'></th><th class= 'right top' width='25%'></th><th width='25%'></th></tr><tr><tr><td colspan='4' width='100%'><div width='100%' class='charttext'><b>⚔</b><sub>3</sub>LMAO</div></td></tr><tr><td colspan='4'><table width='100%'><tbody><tr><th class='right' width='50%'></th><th></th></tr></tbody></table></td></tr><tr><th width='25%'></th><th class= 'left top' width='25%'></th><th class= 'right top' width='25%'></th><th width='25%'></th></tr><tr><tr><td colspan='4' width='100%'><div width='100%' class='charttext'><b>⚔</b><sub>2</sub>LMAO</div></td></tr><tr><td colspan='4'><table width='100%'><tbody><tr><th class='right' width='50%'></th><th></th></tr></tbody></table></td></tr><tr><th width='25%'></th><th class= 'left top' width='25%'></th><th class= 'right top' width='25%'></th><th width='25%'></th></tr><tr><tr><td colspan='4' width='100%'><div width='100%' class='charttext'><b>⚔</b><sub>1</sub>LMAO</div></td></tr><tr><td colspan='4'><table width='100%'><tbody><tr><th class='right' width='50%'></th><th></th></tr></tbody></table></td></tr><tr><th width='25%'></th><th class= 'left top' width='25%'></th><th class= 'right top' width='25%'></th><th width='25%'></th></tr><tr>
    </tbody></table></div> -->

<button onclick="launch()">Lancer la simulation</button> 
<p id="container">Aucune simulation n'a été lancé, veuillez en configurer une</p>
<script>
// function displayTree() {
//     var x = document.getElementById("demo");
//     var nomEqu1=<?//php echo json_encode($nomEq1, JSON_HEX_TAG);  ?>;
//     var nomEqu2=<?//php echo json_encode($nomEq2, JSON_HEX_TAG);  ?>;
//     var nomEqu3=<?//php echo json_encode($nomEq3, JSON_HEX_TAG);  ?>;
//     var nomEqu4=<?//php echo json_encode($nomEq4, JSON_HEX_TAG);  ?>;
//     var nbr=<?//php echo json_encode($nbrEq, JSON_HEX_TAG); ?>;
//     var nbH=nbr*100;
//     var snbH=nbH.toString();
//     var T="<div id='orgchart' class='orgchart'";
//     var buffer="";
//     var X=creationOfTree(nbr, buffer);
//     alert("X");
//     alert(X);
//     T+="style='width: 100%; min-height: 0px; max-height: none; height:"+snbH+" px;'>";
//     T+="<center>"+"<h1>TOURNOI</h1>"+"<table width='100%' style='100%'>"+"<tbody>";

//     // while(nbr>1)
//     // {
//     //     var nbr2=nbr-1;
//     //     var snbr=nbr2.toString();
//     //     T+="<tr>"+"<td colspan='4' width='100%'>"+"<div width='100%' class='charttext'>"+"<b>"+"⚔"+"</b>"+"<sub>"+snbr+"</sub>"+"LMAO";
//     //     T+="</div>"+"</td>"+"</tr>";
//     //     T+="<tr>"+"<td colspan='4'>"+"<table width='100%'>"+"<tbody>"+"<tr>"+"<th class='right' width='50%'>"+"</th>"+"<th class='half'>"+"</th>";
//     //     T+="</tr>"+"</tbody>"+"</table>"+"</td>"+"</tr>";
//     //     T+="<tr>";
//     //     T+="<th width='25%'>"+"</th>"+"<th class= 'left top' width='25%'>"+"</th>"+"<th class= 'right top' width='25%'>"+"</th>"+"<th width='25%'>"+"</th>";
//     //     T+="</tr>";

//     //     nbr--;
//     // }
//     T+=X;
//     T+=nomEqu1+" "+nomEqu2+" "+nomEqu3+ " "+nomEqu4;
//     T=T+"</tbody>"+"</table>"+"</center>"+"</div>";
//     //alert(T);
    
//     x.innerHTML = T;
//     // Tu peux ne pas supprimer le texte de ta balise en faisant un innerHTML+= variable XD
// }
// function creationOfTree(nbr, T)
// {
//     if(nbr>1)
//     {
//         var snbr=nbr.toString();
//         T+="<tr>"+"<td colspan='4' width='100%'>"+"<div width='100%' class='charttext'>"+"<b>"+"⚔"+"</b>"+"<sub>"+snbr+"</sub>"+"LMAO";
//         T+="</div>"+"</td>"+"</tr>";
//         T+="<tr>"+"<td colspan='4'>"+"<table width='100%'>"+"<tbody>"+"<tr>"+"<th class='right' width='50%'>"+"</th>"+"<th>"+"</th>";
//         T+="</tr>"+"</tbody>"+"</table>"+"</td>"+"</tr>";
//         T+="<tr>";
//         T+="<th width='25%'>"+"</th>"+"<th class= 'left top' width='25%'>"+"</th>"+"<th class= 'right top' width='25%'>"+"</th>"+"<th width='25%'>"+"</th>";
//         T+="</tr>";
//         console.log("nbr");
//         console.log(nbr);
//         var nbr1=nbr-1;
//         var nbr2=nbr-2;
//         console.log("n1");
//         console.log(nbr1);
//         console.log("n2");
//         console.log(nbr2);
//         alert("T");
//         //var T1="<tr class='0'>";
//         //var T3;
//         //var T2;
//         return creationOfTree(nbr1, T1);
//         return creationOfTree(nbr2, T2);
//         //T2+="</tr>";
//         //T+=T1+T3+T2;
//     }
//     else
//     {
//         alert("TEST");
//         alert(T);
//         return T;
//     }
    
// }
// var dico={};

// dico["name"]="<b>⚔</b><sub> 1</sub> Bozo";
// dico["children"]=[];
// // dico["children"]={};
// dico["children"][0]={"name":"<b>⚔</b><sub>2</sub> Le clown", "children":[]};
// dico["children"][0]["children"][0]={"name":"tutu"};
// dico["children"][0]["children"][1]={"name":"titi"};

// dico["children"][1]={"name":"<b>⚔</b><sub> 3</sub> Toto","children":[]};
// dico["children"][1]["children"][0]={"name":"tata"};
// dico["children"][1]["children"][1]={"name":"tita"};




//dico["children"]["name"]="!!!";
//dico["children"]["children"]={};

// console.log(dico);
// console.log(dico["name"]);

// const equipes = 
//     {
//         name: "<b>⚔</b><sub> 1</sub> Bozo",
//         children: 
//         [
//             {
//                 name: "<b>⚔</b><sub>2</sub> Le clown",
//                 children: 
//                 [
//                     {
//                         name: "tutu"
//                     },
//                     {
//                         name: "titi"
//                     }
//                 ]
//             },
//             {
//                 name: "<b>⚔</b><sub> 3</sub> Toto",
//                 children: 
//                     [
//                         {
//                             name: "tatu"
//                         },
//                         {
//                             name: "tita"
//                         }
//                     ]
//             }
//         ]
//     };

function getTeam(number, incr,Incr, tableau)
{
    if(number>2)
    {
        let equipes={};
        equipes["name"] = `<b>⚔</b><sub> ${Incr}</sub> ${tableau[incr]}`;
        equipes["children"] = [];
        number-=1;
        let incr1=(2*incr)+1;
        let Incr1=incr1+1;
        equipes.children.push(getTeam(number,incr1,Incr1,tableau));
        let incr2=(2*incr)+2;
        let Incr2=incr2+1;
        equipes.children.push(getTeam(number,incr2,Incr2,tableau));
        // equipes["name"]=`<b>⚔</b><sub> ${incr}</sub> Bozo`;
        // // console.log("equipes['name']");
        // // console.log(equipes["name"]);
        // equipes["children"]=[];
        // var VarDico={};
        // equipes["children"][0]=getTeam(--number,VarDico,incr++);
        // // console.log("equipes['children'][0]");
        // // console.log(equipes["children"][0]);
        // VarDico={};
        // incr+=2;
        // equipes["children"][1]=getTeam(--number,VarDico,incr);
        // // console.log("equipes['children'][1]");
        // // console.log(equipes["children"][1]);
        // equipes["name"]=
        // equipes["children"]=[];
        // equipes["children"][0]=
        // equipes["children"][1]
        return equipes;
    }
    else
    {
        let equipes={};
        equipes.name=`${tableau[incr]}`;
        return equipes;      
    }
}


function createTable(equipes) {
  let out  =  `<table>
    <tr>
      <td></td>
      <td class="equipe" colspan="2">
        <div class="nomeq">
          ${equipes.name}
        </div>
        </td>
      <td></td>
    </tr>`
  if (equipes.children && equipes.children.length > 0) {
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
// alert(document.getElementById("container"));
// alert(createTable(equipes));
function launch()
{
    let TABLEAU=<?php echo json_encode($TESTEQ, JSON_HEX_TAG); ?>;
    let nbrEq=<?php echo json_encode($nbrEq,JSON_HEX_TAG);?>;
    console.log(nbrEq);
    let Equipes=getTeam(nbrEq,0,1,TABLEAU);
    // alert(getTeam(nbrEq,0,1,TABLEAU));
    console.log(getTeam(nbrEq,0,1,TABLEAU));
    document.getElementById("container").innerHTML = createTable(Equipes);
}
</script>


<!-- <div id="container">
</div> -->
<?php

/*
for($i = 0; $i<5; $i++){
    $copieTab[$i] = $i+2;
}
print_r($copieTab);
echo "<hr/>";
print_r($monTab);
echo "<hr/>";
if(rand(1,2) == 1) echo "True";
else echo "False";
*/
//Test d'insertion dans la table game
/*
if($conn->query("INSERT INTO organisateur(num_o, nom, type_tournoi) VALUES (2, 'Jean', 'IDK')")===TRUE){
    echo "inserted data \n";
}else{
    echo "failed \n";
}
$stmt = $conn->prepare("INSERT INTO game (date_game, num_tournoi, num_eq1, num_eq2, score_eq1, score_eq2, eq_gagnante) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siiiiii", $dateMatch, $tournoisEnCours, $equipe1, $equipe2, $score1, $score2, $victoire);

//Variable pour l'insertion

$dateMatch = "2021-04-13 04:00:00";
$tournoisEnCours = 1;
$equipe1 = 1;
$equipe2 = 2;
$score1 = 2;
$score2 = 0;
$victoire = 1;
echo "ok let's go \n";
$stmt->execute();
echo "Apres l'excute";
$stmt->close();
/*
echo $_POST[0];
//<h1>Equipes déjà inscrites</h1>
$bdd = new PDO("mysql:host=localhost;dbname=baseDeDonnee","root","ilovelinuxnow",array(PDO::ATTR_PERSISTENT => true));

$cal = (5 - $_POST['num_cap']);
echo "le joueur capitaine est dans la base $cal";
$requete2 = $bdd->query("SELECT licence FROM joueur ORDER BY licence DESC LIMIT 1 OFFSET $cal");
$resultat2 = $requete2->fetchAll(PDO::FETCH_ASSOC);

print_r($resultat2);
echo " Le résultat de la requete est ".$resultat2[0]['licence']; 
/*
try {
    $dbh = new PDO("mysql:host=localhost;dbname=baseDeDonnee","root","ilovelinuxnow",array(PDO::ATTR_PERSISTENT => true));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Ok ca marche";
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
//print_r($result);

$nt = $bdd->prepare("INSERT INTO tournoi(num_tournoi, nom, num_orga) VALUES(?, ?, ?)");
$nt->execute(array($_POST['niveau'], $_POST['nom'], $_POST["num_cap"]));

$test = $bdd->query("SELECT licence FROM joueur ORDER BY licence DESC LIMIT 5");
$ok = $test->fetchAll(PDO::FETCH_ASSOC);
print_r($ok);
//<h1>Affichage des match de la compétition</h1>


// print_r($_POST); afficher les valeurs de post
*/
?>
</body>
</html>