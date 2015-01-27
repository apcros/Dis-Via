<?php 
include "funcs.view.php";

head();

?>
    <div class="container">
        <div class="col-md-offset-3 col-md-6 col-md-offset-3" id='stops'>
         
        </div>
    </div>
    
    <script type="text/javascript">

      htmlSTR = "<h4> Supprimer un arrêt : </h4> <hr>";
      $('#stops').html(htmlSTR);
    for (var i = 0; i < localStorage.length; i++) {
        arret = localStorage.getItem(localStorage.key(i));
        $("#stops").html(htmlSTR);
       $.get("func.php?func=refToName&r="+arret+"&n="+i, function(text) {
         console.log(text);
          $("#stops").append(text);

       });

    }
    
    function deleteStop(nb) {
    localStorage.removeItem(localStorage.key(nb));

    }

</script>
 <?php foot(); ?>