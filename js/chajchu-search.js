(document).ready(function(){
    //var autocompletar = new Array();
    /*<?php //Esto es un poco de php para obtener lo que necesitamos
     for($p = 0;$p < count($auto); $p++){ ?>//usamos count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $auto[$p]; ?>');
     <?php } ?>*/
     for (var i = 0; i<autocompletar.length; i++) {
       console.log("num"+autocompletar[i]);
       //autocompletar.push(autocompletar[i]);

     };
     $("#busqueda").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
  })(JQuery);