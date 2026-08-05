
<?php
//$Dmin = 2;
//$c1 = 0.4;
//$c2 = 0.15;

$Vc5 = 5;
$Vc3 = 3;
$Vc2 = 2;
$Vc1 = 1;


// function VCD($Dm,$Vc,$c,$d) {
//     //return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_UP) ;
//     $Inter =round(($d/100 - $Dm),0, PHP_ROUND_HALF_UP);
//     return $Vc + round($c * $Inter * $Vc ,0, PHP_ROUND_HALF_UP) ;
// }

?>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Distance','Cibles 5',  'Cibles 3', 'Cibles 2', 'Cibles 1'],
      <?php
      for ($dist = 200; $dist <= 1000; $dist+=10) {

                  $distm = $dist / 100;

                  echo
                  "['".$distm." m',".
                  VCD($Dmin,$Vc5,$c1,$dist).",".
                  VCD($Dmin,$Vc3,$c2,$dist).",".
                  VCD($Dmin,$Vc2,$c2,$dist).",".
                  VCD($Dmin,$Vc1,$c2,$dist)."],".
                  "\n";
                }

      ?>

    ]);

    var options = {
      title: 'Points selon \'Distance\' avec  Dmin = <?php echo $Dmin ?> Mètre, c1 = <?php echo $c1 ?> , c2 = <?php echo $c2 ?>',
      titleTextStyle : {  color: 'green',
                          fontName: 'Arial',
                          fontSize: 20,
                          bold: true,
                          italic: true, },
      backgroundColor: '#e9f0ea',
      chartArea:{width:'1000px',height:'1000px',
                backgroundColor: {stroke : 'green', strokeWidth:3 },
              },
      hAxis: {
        title: 'Distance en mètres',
        titleTextStyle: {
           color: '#FF0000',
           fontName: 'Arial',
           fontSize: 20,
           bold: true,},
      },
      vAxis: {
        title: 'Nombre de points',
        titleTextStyle: {
           color: '#FF0000',
           fontName: 'Arial',
           fontSize: 20,
           bold: true,},
        //baseline: 5,
        ticks: [2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48,50]
      },
      // colors: ['#228B22', '#a9d08e', '#f2b084', '#f8cbad'],
      colors: ['#228B22', '#50b14d', '#f2b084', '#f8cbad'],
      isStacked: false,
      'width':1000,
      'height':600,
    };

    var chart = new google.visualization.SteppedAreaChart(document.getElementById('SteppedAreaChart'));

    chart.draw(data, options);
  }
</script>

<hr size='5' color='green' width='100%'>
<hr size='5' color='green' width='100%'>
<h2>Points selon Distance<br> avec Distance Nominale = <?php echo $Dmin ?> mètres, c1 = <?php echo$c1 ?> et c2 = <?php echo $c2 ?></h2>
<hr size='5' color='green' width='100%'>
<hr size='5' color='green' width='100%'>

<div id="SteppedAreaChart" align="center" ></div>
<!--style="width: 900px; height: 500px;"-->



</tbody>
</table>
