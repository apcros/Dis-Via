<?php 
include "funcs.view.php";

head();

?>

<div id="mon">
  
  <script type="text/javascript">
    var cl = new CanvasLoader('mon');
    cl.show()
  </script>
    <b>Chargement...</b>

</div>

<script type='text/javascript'>
  
  $('#mon').html("");
  
  for (var i = 0; i < localStorage.length; i++) {
      arret = localStorage.getItem(localStorage.key(i));

     $.get("func.php?func=getSingleTime&r="+arret, function(text) {
       $('#mon').append(text);
       cl.hide();
     });
    } 

  var auto_refresh = setInterval(
 
  function ()
  {

  for (var i = 0; i < localStorage.length; i++) {
      arret = localStorage.getItem(localStorage.key(i));
     $('#mon').html(""); 
     $.get("func.php?func=getSingleTime&r="+arret, function(text) {
       $('#mon').append(text);
       cl.hide();
     });
    } 
  }, 10000);
</script>

<?php foot(); ?>