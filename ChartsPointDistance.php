
<?php

?>

<!-- VCD      -->
<!-- VCD      -->
<!-- VCD      -->

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Distance','Cibles 5',  'Cibles 3', 'Cibles 2', 'Cibles 1'],
      <?php
      for ($dist = 0; $dist <= 1000; $dist+=10) {

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
      chartArea:{width:'1000px',height:'2000px',
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
        //ticks: [2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48,50]
        <?php
        echo "ticks: [";
        for ($tick = VCD($Dmin,$Vc5,$c1,0); $tick <= VCD($Dmin,$Vc5,$c1,998); $tick+=2) {
          echo $tick.",";
        }
        echo VCD($Dmin,$Vc5,$c1,1000)."]";
        ?>
      },
      // colors: ['#228B22', '#a9d08e', '#f2b084', '#f8cbad'],
      colors: ['#228B22', '#50b14d', '#f2b084', '#f8cbad'],
      isStacked: false,
      'width':1000,
      'height':600,
    };

    var chart = new google.visualization.SteppedAreaChart(document.getElementById('VCD'));

    chart.draw(data, options);
  }
</script>

<!-- <hr size='5' color='green' width='100%'> -->
<!-- <hr size='5' color='green' width='100%'> -->
<h2>Points selon Distance
<br>&nbsp;Formule VCD= Vc + ArrondiSup(c x (ArrondiSup(Distance - Distance Nominale) x Vc)
<br>&nbsp;avec Distance Nominale = <?php echo $Dmin ?> mètres, c1 = <?php echo$c1 ?> et c2 = <?php echo $c2 ?></h2>

<div id="VCD" align="center" ></div>
<!--style="width: 900px; height: 500px;"-->

<!-- <hr size='5' color='green' width='100%'> -->
<!-- <hr size='5' color='green' width='100%'> -->


<!-- InitialeVCD      -->
<!-- InitialeVCD      -->
<!-- InitialeVCD      -->

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Distance','Cibles 5',  'Cibles 3', 'Cibles 2', 'Cibles 1'],
      <?php
      for ($dist = 0; $dist <= 1000; $dist+=10) {

                  $distm = $dist / 100;

                  echo
                  "['".$distm." m',".
                  InitialeVCD($Dmin,$Vc5,$c1,$dist).",".
                  InitialeVCD($Dmin,$Vc3,$c2,$dist).",".
                  InitialeVCD($Dmin,$Vc2,$c2,$dist).",".
                  InitialeVCD($Dmin,$Vc1,$c2,$dist)."],".
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
      chartArea:{width:'1000px',height:'2000px',
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
        //ticks: [2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48,50]
        <?php
        echo "ticks: [";
        for ($tick = InitialeVCD($Dmin,$Vc5,$c1,0); $tick <= InitialeVCD($Dmin,$Vc5,$c1,998); $tick+=2) {
          echo $tick.",";
        }
        echo InitialeVCD($Dmin,$Vc5,$c1,1000)."]";
        ?>
      },
      // colors: ['#228B22', '#a9d08e', '#f2b084', '#f8cbad'],
      colors: ['#228B22', '#50b14d', '#f2b084', '#f8cbad'],
      isStacked: false,
      'width':1000,
      'height':600,
    };

    var chart = new google.visualization.SteppedAreaChart(document.getElementById('InitialeVCD'));

    chart.draw(data, options);
  }
</script>

<!-- <hr size='5' color='green' width='100%'> -->
<!-- <hr size='5' color='green' width='100%'> -->
<h2>Points selon Distance
<br>&nbsp;Formule InitialeVCD = Vc + ArrondiSup(c x (Distance - Distance Nominale) x Vc)
<br>&nbsp;avec Distance Nominale = <?php echo $Dmin ?> mètres, c1 = <?php echo$c1 ?> et c2 = <?php echo $c2 ?></h2>

<div id="InitialeVCD" align="center" ></div>
<!--style="width: 900px; height: 500px;"-->

<!-- <hr size='5' color='green' width='100%'> -->
<!-- <hr size='5' color='green' width='100%'> -->


<!-- ParaboleVCD      -->
<!-- ParaboleVCD      -->
<!-- ParaboleVCD      -->

<?php

$c1=$c1/$FacteurParabole;

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
      for ($dist = 0; $dist <= 1000; $dist+=10) {

                  $distm = $dist / 100;

                  echo
                  "['".$distm." m',".
                  ParaboleVCD($Dmin,$Vc5,$c1,$c1,$c2,$dist).",".
                  ParaboleVCD($Dmin,$Vc3,$c2,$c1,$c2,$dist).",".
                  ParaboleVCD($Dmin,$Vc2,$c2,$c1,$c2,$dist).",".
                  ParaboleVCD($Dmin,$Vc1,$c2,$c1,$c2,$dist)."],".
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
      chartArea:{width:'1000px',height:'2000px',
                backgroundColor: {stroke : 'green', strokeWidth:3 },
              },
      hAxis: {
        title: 'Distance en mètres',
        titleTextStyle: {
           color: '#FF0000',
           fontName: 'Arial',
           fontSize: 20,
           bold: true,},
           <?php
           echo "ticks: [";
           for ($tick = 10; $tick <= 80; $tick+=10) {
             $nstick = $tick/10 ;
             echo $nstick.",";
           }
           echo "9]";
           ?>
      },
      vAxis: {
        title: 'Nombre de points',
        titleTextStyle: {
           color: '#FF0000',
           fontName: 'Arial',
           fontSize: 20,
           bold: true,},
        //baseline: 5,
        //ticks: [2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48,50]

        <?php
        echo "ticks: [";
        for ($tick = ParaboleVCD($Dmin,$Vc5,$c1,$c1,$c2,0); $tick <= ParaboleVCD($Dmin,$Vc5,$c1,$c1,$c2,998); $tick+=2) {
          echo $tick.",";
        }
        echo ParaboleVCD($Dmin,$Vc5,$c1,$c1,$c2,1000)."]";
        ?>
      },
      // colors: ['#228B22', '#a9d08e', '#f2b084', '#f8cbad'],
      colors: ['#228B22', '#50b14d', '#f2b084', '#f8cbad'],
      isStacked: false,
      'width':1000,
      'height':600,
    };

    var chart = new google.visualization.SteppedAreaChart(document.getElementById('ParaboleVCD'));

    chart.draw(data, options);
  }
</script>

<!-- <hr size='5' color='green' width='100%'> -->
<!-- <hr size='5' color='green' width='100%'> -->
<h2>Points selon Distance
<br>&nbsp;Formule ParaboleVCD = Vc + ArrondiSup(c x (ArrondiSup(Distance - Distance Nominale)) x ArrondiSup(c x (ArrondiSup(Distance - Distance Nominale))
<br>&nbsp;avec Distance Nominale = <?php echo $Dmin ?> mètres, c1 = <?php echo$c1 ?> et c2 = <?php echo $c2 ?></h2>

<div id="ParaboleVCD" align="center" ></div>
<!--style="width: 900px; height: 500px;"-->

<!-- <hr size='5' color='green' width='100%'> -->
<!-- <hr size='5' color='green' width='100%'> -->
