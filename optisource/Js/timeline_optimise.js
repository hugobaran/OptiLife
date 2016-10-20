google.load("visualization", "1");

google.setOnLoadCallback(drawVisualization_2);

var timeline;
var data;

function drawVisualization_2() {
    // Create and populate a data table.
    data = new google.visualization.DataTable();
    data.addColumn('datetime', 'start');
    data.addColumn('datetime', 'end');
    data.addColumn('string', 'content');

    function addRow(startDate, endDate, content, backgroundColor, borderColor)
    {

        data.addRows([
            [startDate, endDate, div]
        ]);
    }


    data.addRows([
        <?php
        if(!empty($_SESSION['id'])){
            $ut_id = $_SESSION['id'];

            $liste_tache = $bdd->query('SELECT TA_ID, TA_DATE, TA_HEUREDEBUT, TA_HEUREFIN, CA_LIBELLE FROM TACHE_UTILISATEUR JOIN CATALOGUE USING(CA_ID) WHERE UT_ID = '.$ut_id.' AND TA_OPTIMISE = 1');
            while($row = $liste_tache->fetch()){
                $date = $row["TA_DATE"];
                $heure_debut = $row["TA_HEUREDEBUT"];
                $heure_fin = $row["TA_HEUREFIN"];

                $date_debut = strtotime($date.' '.$heure_debut);
                $date_debut = date('Y,m,d,H,i,s', $date_debut);
                list($Y,$m,$d,$H,$i,$s)=explode(',',$date_debut);
                $date_debut = Date("Y,m,d,H,i,s", mktime($H,$i,$s,$m-1,$d,$Y));

                $date_fin = strtotime($date.' '.$heure_fin);
                $date_fin = date('Y,m,d,H,i,s', $date_fin);
                list($Y,$m,$d,$H,$i,$s)=explode(',',$date_fin);
                $date_fin = Date("Y,m,d,H,i,s", mktime($H,$i,$s,$m-1,$d,$Y));

                $TA_LIBELLE = $row["CA_LIBELLE"];

                echo "[new Date(".$date_debut."), new Date(".$date_fin."), '<span title=\"$TA_LIBELLE\" \">".$row["CA_LIBELLE"]."</span>'],\n";
            }
        }
        ?>
    ]);

    var heightTemp = (document.documentElement.clientHeight-200)/2.3;
    var height = heightTemp+"px";

    // specify options
    var options = {
        width: "100%",
        height: height,
        minHeight: 0,
        autoHeight: true,
        min: new Date(annee, month, jour),                // lower limit of visible range
        max: new Date(annee, month, jour+1),                // lower limit of visible range
        moveable: true,
        editable: false,  // enable dragging and editing events
        enableKeys: true,
        axisOnTop: true,
        showNavigation: true,
        showButtonNew: false,
        animate: false,
        animateZoom: true,
        layout: "box",
        zoomMin: 1000 * 60 * 60 * 1,             // one day in milliseconds
        zoomMax: 1000 * 60 * 60 * 24     // about three months in milliseconds 
    };

    // Instantiate our table object.
    timeline = new links.Timeline(document.getElementById('timeline_optimize'));
    options.locale = "fr";
    // Attach event listeners
    google.visualization.events.addListener(timeline, 'select', onselect_optimise);
    //google.visualization.events.addListener(timeline, 'delete', ondelete_optimise);
    // Draw our table with the data we created locally.
    timeline.draw(data, options);

}

function onselect_optimise() {
    var sel = timeline.getSelection();
    if (sel.length) {
        if (sel[0].row != undefined) {
            var row = sel[0].row;
            //alert("event " + row + " selected");
        }
    }
}