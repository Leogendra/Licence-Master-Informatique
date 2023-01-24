<?php 
$title = 'Équipes incrites';
include("Joli/header.php");
?>
<link rel="stylesheet" href="css/equipesinscrites.css">  
    
    

<?php 

$sth = $bdd->prepare("SELECT equipe.nom FROM equipe");
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_ASSOC);
// print_r($res);
echo "<table ><tbody colspan='10'>";
for($i=0;$i<count($res);$i++)
{
    //print_r($res[$i]);
    echo "<tr><td class='name' >".$res[$i]['nom']."</td>";
    echo "<td class='image' >IMAGE</td></tr>";
}
echo"</tbody></table>"

?>



<?php include("Joli/footer.php"); ?>
