<?php
include "funcs.view.php";

/* ####### function getLignes ########

echo a formated list of the lists of lignes. 
(With a form post)
*/
function getLignes() {
$xml = simplexml_load_string(file_get_contents("http://timeo3.keolis.com/relais/217.php?xml=1"));
$json = json_encode($xml);
$json = json_decode($json);
$json = $json->alss->als;
$nb = count($json);
echo "<h4> Choix d'une ligne : </h4>";
echo "<hr>";
echo "<form method='POST'>";
echo "<select class='form-control' name='idSens'>";
for($i = 0; $i < $nb; $i++) {

echo "<option value='".$json[$i]->ligne->code."#".$json[$i]->ligne->sens."'>".$json[$i]->ligne->nom." vers ".$json[$i]->ligne->vers."</option>";
}
echo "</select>";
echo "<hr>";
echo "<button class='btn btn-primary' action='submit'>Valider</button>";
echo "</form>";
}

/* ####### function getStops ########
echo a formated list of the lists of stops for a ligne (Choosen by the POST idSens). 
(With a form post)
*/
function getStops() {
  $idSens = explode("#",$_POST['idSens']);
  $id = $idSens[0];
  $sens = $idSens[1];
  $xml = simplexml_load_string(file_get_contents("http://timeo3.keolis.com/relais/217.php?xml=1&ligne=".$id."&sens=".$sens));
  $json = json_encode($xml);
  $json = json_decode($json);

  $json = $json->alss->als;
  $nb = count($json);
  echo "<h4> Choix d'un arrêt : </h4>";
  echo "<hr>";
  echo "<form method='POST'>";
  echo "<select class='form-control' name='refs'>";
  for($i = 0; $i < $nb; $i++) {
    echo "<option value='".$json[$i]->refs."'>".$json[$i]->arret->nom." (".$json[$i]->arret->code.") </option>";
  }
  echo "</select>";
  echo "<hr>";
  echo "<button class='btn btn-primary' action='submit'>Ajouter arrêt</button>";
  echo "</form>";

}

/* ####### function addLocalStorage ########
from the POST ref, it display a javascript code that is charged to add in localStorage.
Highly unefficient and horrible.
Must switch it to a pure javascript function in next update.
*/
function addLocalStorage() {
  $refs = "'".$_POST['refs']."'";
echo "<script type='text/javascript'>


    localStorage.setItem('arret_'+localStorage.length+1,".$refs.");

window.location = 'index.php';
</script>";
}



head();
?>
    <div class="container">
        <div class="col-md-offset-3 col-md-6 col-md-offset-3">

            <?php
            if(isset($_POST['idSens'])) {
              getStops();
            } else if (isset($_POST['refs'])) {
                addLocalStorage();
            } else {
              getLignes();
            }
            ?>

        </div>
    </div>
<?php foot(); ?>