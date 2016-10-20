<!DOCTYPE html>
<html>
<head>
    <title>Timeline jQuery Themeroller demo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="lib/jquery-ui.js"></script>
    <script type="text/javascript" src="lib/jquery.themeswitcher.js"></script>

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript" src="timeline.js"></script>
    <link rel="stylesheet" type="text/css" href="timeline-theme.css">

    <style>
        body,
        .ui-widget,
        .ui-widget input,
        .ui-widget select,
        .ui-widget textarea,
        .ui-widget button,
        .ui-widget-header,
        .ui-widget-content,
        .ui-widget-header .ui-widget-header,
        .ui-widget-content .ui-widget-content {
            font-family: Arial, "Trebuchet MS", Verdana, sans-serif !important;
            font-size: 12px !important;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#switcher").themeswitcher({
                imgpath: "img/themeswitcher/",
                loadtheme: "Eggplant"
            });
        });

        google.load("visualization", "1");

        // Set callback to run when API is loaded
        google.setOnLoadCallback(drawVisualization);

        var timeline;
        var data;
        var contenu_file_data;
        var new_file_data;

        function getSelectedRow() {
            var row = undefined
            var sel = timeline.getSelection();
            if (sel.length) {
                if (sel[0].row != undefined) {
                    var row = sel[0].row;
                }
            }
            return row;
        }

        // Called when the Visualization API is loaded.
        function drawVisualization() {
            // Create and populate a data table.
            data = new google.visualization.DataTable();
            data.addColumn('datetime', 'start');
            data.addColumn('datetime', 'end');
            data.addColumn('string', 'content');

            data.addRows([
                <?php 
                    $new_file_data = fopen('data.data', 'w+');
                    $contenu_file_data = "[new Date(2014, 01, 28, 12, 00, 00), new Date(2014, 01, 28, 14, 00, 00), 'Traject B'],";

                    fputs($new_file_data, $contenu_file_data);
                    
                    include ('data.data');
                ?>

//                var reader = new FileReader();
//
//                reader.onload = function() {
//                    reader.result();
//                };

//                reader.readAsText(data.data);
//                [new Date(2014, 01, 23, 23, 00, 00), , '<div>Mail from boss</div><img src="../examples/img/mail-icon.png" style="width:32px; height:32px;">'],
//                [new Date(2014, 01, 24, 16, 00, 00), , '<span onclick="alert(\'test\')">Click here!</span>'],
//                [new Date(2014, 01, 27), , '<div>Memo</div><img src="../examples/img/notes-edit-icon.png" style="width:48px; height:48px;">'],
//                [new Date(2014, 01, 28, 12, 00, 00), new Date(2014, 01, 28, 14, 00, 00), 'Faire les courses'],
                [new Date(2014, 01, 28, 12, 00, 00), new Date(2014, 01, 28, 14, 00, 00), '<span onclick="alert(\'Chercher les enfants à 17h\')">Chercher les enfants</span>'],
                [new Date(2014, 01, 28, 12, 00, 00), new Date(2014, 01, 28, 14, 00, 00), 'Faire la cuisine'],
//                [new Date(2014, 01, 28, 12, 00, 00), new Date(2014, 01, 28, 14, 00, 00), 'Travail']
            ]);

            // specify options
            var options = {
                width: "100%",
                editable: true,   // enable dragging and editing events
                enableKeys: true,
                axisOnTop: false,
                showNavigation: true,
                showButtonNew: true,
                animate: true,
                animateZoom: true,
                layout: "box"
            };

            timeline = new links.Timeline(document.getElementById('mytimeline'));
            timeline.draw(data, options);
        }
    </script>
</head>

<body>

<p>

<div id="switcher"></div>
</p>

<div id="mytimeline" lang="fr"></div>

</body>
</html>