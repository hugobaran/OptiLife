<?php

include('../../connexion.php');

echo "
    <script>
        document.getElementById('heure_debut').disabled = false;
        document.getElementById('heure_debut').value = '';
        document.getElementById('heure_fin').value = '';
        jQuery('#heure_debut').datetimepicker({
            lang:'fr',
            datepicker:false,
            format:'H:i',
            step:1,
            mask:true
        });
    </script>";

?>