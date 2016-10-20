var date1 = new Date();

annee = date1.getFullYear();
month = date1.getMonth();
jour = date1.getDate();

google.load("visualization", "1");

// Set callback to run when API is loaded
google.setOnLoadCallback(drawVisualization_1);

var timeline_non_optimise;
var data;

function getSelectedRow() {
    var row = undefined;
    var sel = timeline_non_optimise.getSelection();
    if (sel.length) {
        if (sel[0].row != undefined) {
            row = sel[0].row;
        }
    }
    return row;
}

// Called when the timelineualization API is loaded.
function drawVisualization_1() {
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
        $incr = 0;

        $liste_tache = $bdd->query('SELECT TA_ID, TA_DATE, TA_HEUREDEBUT, TA_HEUREFIN, CA_LIBELLE FROM TACHE_UTILISATEUR JOIN CATALOGUE USING(CA_ID) WHERE UT_ID = '.$ut_id.' AND TA_OPTIMISE = 0');
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
            $TA_ID = $row["TA_ID"];

            $liste_supprimer[$incr] = $TA_ID;
            $incr++;

            echo "[new Date(".$date_debut."), new Date(".$date_fin."), '<span title=\"$TA_LIBELLE\" \">".$row["CA_LIBELLE"]."</span>'],\n";
        }
    }
    ?>
        ]);

    var heightTemp = (document.documentElement.clientHeight-200)/2.3;
    var height = heightTemp+"px";

    dateDebut = new Date(annee, month, jour);
    dateFin = new Date(annee, month, jour+1);

    // specify options
    var options = {
        width: "100%",
        height: height,
        minHeight: 0,
        autoHeight: true,
        min: new Date(annee, month, jour),                // lower limit of visible range
        max: new Date(annee, month, jour+1),                // lower limit of visible range
        moveable: true,
        showNavigation: true,
        editable: true,  // enable dragging and editing events
        enableKeys: true,
        axisOnTop: false,
        animate: true,
        animateZoom: true,
        layout: "box",
        zoomMin: 1000 * 60 * 60 * 1,
        zoomMax: 1000 * 60 * 60 * 24   
    };

    // Instantiate our table object.
    timeline_non_optimise = new links.Timeline(document.getElementById('timeline_no_optimize'));
    options.locale = "fr";
    // Attach event listeners
    google.visualization.events.addListener(timeline_non_optimise, 'select', onselect_non_optimise);
    google.visualization.events.addListener(timeline_non_optimise, 'rangechange', onrangechange_non_optimise);
    google.visualization.events.addListener(timeline_non_optimise, 'delete', ondelete_non_optimise);
    // Draw our table with the data we created locally.
    timeline_non_optimise.draw(data, options);

}

// adjust start and end time.
function setTime() {
    if (!timeline_non_optimise) return;

    var newStartDate = new Date(document.getElementById('startDate').value);

    annee = newStartDate.getFullYear();
    month = newStartDate.getMonth();
    jour = newStartDate.getDate();  

    drawVisualization_1();
    drawVisualization_2();

    transfert_date();
}

function addTime() {
    jour++; 
    drawVisualization_1();
    drawVisualization_2();
    
    transfert_date();
}

function delTime() {
    jour--; 
    drawVisualization_1();
    drawVisualization_2();
    
    transfert_date();
}

function onrangechange_non_optimise() {
    // adjust the values of startDate and endDate
    var range = timeline_non_optimise.getVisibleChartRange();
    document.getElementById('startDate').value = dateFormat(options.min);
    document.getElementById('endDate').value   = dateFormat(options.max);
}

/********************   DEBUT DES TESTS  *******************************/

function onselect_non_optimise() {
    var sel = timeline_non_optimise.getSelection();
    if (sel.length) {
        if (sel[0].row != undefined) {
            var row = sel[0].row;
            var tab = <?php echo json_encode($liste_supprimer); ?>;
        } 
    }
}

function ondelete_non_optimise() {
    var row = getSelectedRow();
    var tab2 = <?php echo json_encode($liste_supprimer); ?>;
    var ta_id = tab2[row];
    supprimer_tache('supprimer_tache', ta_id);
}

function transfert_date()
{
    var dateJour = dateDebut.getDate();
    var dateAnnee = dateDebut.getFullYear();
    var dateMois = dateDebut.getMonth()+1;
    var dateDeb = dateAnnee+'-'+dateMois+'-'+dateJour;
    document.getElementById('hide_date').value=dateDeb;
}
