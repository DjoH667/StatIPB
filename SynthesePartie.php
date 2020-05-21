<?php
include 'MenuDev.php';  // Ok.
include 'MenuIPassBall.php';  // Ok.
?>

<?php

/* Variables passées en prametres dans l'url*/
$IdP = $_GET["IdP"];
$IdJ = $_GET["IdJ"];

include 'ConnexionBDDiPassBall.php';

include 'SynthesePartieSession.php';


//$Dmin = 3;
//$c1 = 0.4;
//$c2 = 0.15;
?>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Nb Impact : ');
    data.addColumn('number', 'Nb Impact : ');
    data.addRows([
      ['Cible 5pt G', 5,'color: #f8cbad'],
      ['Cible 5pt D', 2,'color: #f8cbad'],
      ['Cible 3pt G', 6,'color: #f56bad'],
      ['Cible 3pt D', 9,'color: #f8c78d'],
      ['Cible 2pt G', 5,'color: #f8cbad'],
      ['Cible 2pt D', 1,'color: #f8cbad']
    ]);

    // Set chart options
    var options = {
      'title':'Repartition / Cible',
      'width':800,
      'height':600,

    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('BarChart'));
    chart.draw(data, options);
  }
</script>
<!--
<h1>Chart BarChart</h1>
<div id="BarChart" align="center" ></div>
Div that will hold the pie chart-->
<!--//nclude 'AbaqueTableauPointDistance.php';
?>-->
