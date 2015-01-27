<?php
/* ########## Functions call ########
can call getSingleTime (with the stop reference as parameter (passed via GET['r']))
can also call refToName
*/
if(isset($_GET['func'])) {
 
  if(isset($_GET['r']) && $_GET['func'] == 'getSingleTime') {
    getSingleTime($_GET['r']);
  }

  if(isset($_GET['r']) && $_GET['func'] == 'refToName' && isset($_GET['n'])) {
    refToName($_GET['r'],$_GET['n']);
  }
}

/* ####### Function Time Check #######
  Check the time and if the time difference is zero, show that the transport is near.
*/
function timecheck ($time) {
  $min = 0;
  if($time->h >= 1) {
    $min += 60*$time->h;
  }
  $min += $time->i;
  if($min == 0) {
    return "Passage en cours...";
  } else {
    return $min." min";
  }
  

}
/* ######### functin refToName ###########
refs : Reference of the stop
nb : the number of the stop in the local storage

This function echo a formated div with a button that can be later use to call the javascript function to delete the stop
from the localStorage
*/
function refToName($refs,$nb) {
            $xml = simplexml_load_string(file_get_contents("http://timeo3.keolis.com/relais/217.php?xml=3&refs=".$refs."&ran=1"));
            $json = json_encode($xml);
            $json = json_decode($json);
            $json = $json->horaires->horaire;
            $arret = $json->description->arret;
            $dir = $json->description->vers;
            echo "<div class='alert alert-info'>
                      Arret <b>$arret</b> vers <b>$dir</b> 
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'onclick='deleteStop($nb)'>
                        <span class='glyphicon glyphicon-remove-circle'></span>
                      </button>
                  </div>";
            $nb++;

          
}
/* ########## function getSingleTime ##########

refs : References of the stop

This function echo formated html containing stop name, direction, Time of the two next passages.
This function is called for each value in localStorage

*/
function getSingleTime($refs) {

    $apiCall = "http://timeo3.keolis.com/relais/217.php?xml=3&refs=".$refs."&ran=1";

    $xml = simplexml_load_string(file_get_contents($apiCall));
    $json = json_encode($xml);
    $json = json_decode($json);



    $heure = $json->heure;
    $json = $json->horaires->horaire;
    $ligne = $json->description->ligne_nom;
    $arret = $json->description->arret;
    $dir = $json->description->vers;
    
    $json = $json->passages->passage;
    
    $passage1 = $json[0]->duree;
    $passage2 = $json[1]->duree;
      
    $TimeH = new DateTime($heure);
    
    $TimeP1 = new DateTime($passage1);
    $TimeP2 = new DateTime($passage2);

    $TimeP1 = date_diff($TimeP1, $TimeH);
    $TimeP2 = date_diff($TimeH, $TimeP2);
    
    $TimeP1 = timecheck($TimeP1);
    $TimeP2 = timecheck($TimeP2);

      echo "<p class='alert alert-info'><b>Arret ".$arret." vers ".$dir." <span class='badge'>Ligne ".$ligne."</span></p></b></div>";
      echo "<hr>";
      echo "<p><h4> Prochains passages : </h4></p>";
      echo "<h3><span class='label label-primary'> ".$TimeP1." (".$passage1.")</span></h3>";
      echo "<br>";
      echo "<h5><span class='label label-default'> ".$TimeP2." (".$passage2.")</span></h5>";
      echo "</li>";

}

?>