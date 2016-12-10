

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Opti-Life</title>

        <link rel="icon" type="image/png" href="../../Images/optilife.png"/>
        
        <!-- CSS -->
        <link rel="stylesheet" href="../../Font/font.css" type="text/css" media="all">
        <link rel="stylesheet" href="../css/bandeau.css" type="text/css">
        <link rel="stylesheet" href="../css/utilities.css" type="text/css" />
        <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css"/>


        <!-- JS -->

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap/bootstrap.min.js"></script>
   
        <script type="text/javascript" src="../../Js/jquery.corner.js"></script>
        <script type="text/javascript" src="../../Js/jQueryRotate.js"></script>

    </head>

    <body>

        <div id='notif' style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Activité ajoutée</strong>
        </div>

    </body>

    <script type="text/javascript">
        $("#notif").fadeTo(2000, 500).slideUp(500, function(){
    $("#notif").slideUp(500);
});
    </script>

</html>