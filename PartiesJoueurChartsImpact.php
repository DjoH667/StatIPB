
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartPoint<?php echo $iDuree ;?>);
        // google.charts.setOnLoadCallback(drawChartDistance);
        // google.charts.setOnLoadCallback(drawChartForce);


// title: 'Points, Distances en mètres et force en g suivant impacts',

                      function drawChartPoint<?php echo $iDuree ;?>() {
                        var data = google.visualization.arrayToDataTable([
                            ['Partie','Nb Impacts','Pts / Impact','D moy'],
// ['n°1 / 0 s',36,8.89,8.89,3.42],
// ['n°2 / 4 s',5,6.3,7.6,2.95],
// ['n°3 / 7 s',5,7.13,7.44,2.57],
// ['n°4 / 8 s',28,6.53,7.21,1.91],
// ['n°5 / 12 s',32,7.5,7.27,1.95]
// ['n°6 / 13 s',28,7.36,7.29,1.75],
// ['n°7 / 16 s',28,7.2,7.27,2.14],
// ['n°8 / 19 s',18,4.91,6.98,4.51],
// ['n°9 / 23 s',18,5.33,6.79,2.89],
// ['n°10 / 24 s',28,7.26,6.84,2.4],
// ['n°11 / 28 s',32,7.6,6.91,3.5],
// ['n°12 / 29 s',23,6.05,6.84,2.4],
<?php echo $LigneGraphiquePoints ;?>

                          ]);


                        var options = {
                          title: 'Evolution du Nb d\'impacst, du Nb de Points / Impact, \net de la Distance moyenne en mètres suivant N° Partie & Date ',
                          titleTextStyle : {  color: 'green',
                                              fontName: 'Arial',
                                              fontSize: 22,
                                              bold: true,
                                              italic: true, },
                          backgroundColor: '#e9f0ea',
                          chartArea:{width:'75%',height:'75%',
                                    backgroundColor: {stroke : 'green', strokeWidth:3 },
                                  },
                          hAxis: {
                                  title: 'N° de Partie & Date',
                                  titleTextStyle: {
                                     color: '#FF0000',
                                     fontName: 'Arial',
                                     fontSize: 20,
                                     bold: true,},
                                  gridlines : {minSpacing: 10}
                                  },
                          vAxis: {
                                  title :'Nb d\'Impacts, Nb de Pts par Impact\net Distance moyenne en mètres',
                                  titleTextStyle: {
                                     color: '#FF0000',
                                     fontName: 'Arial',
                                     fontSize: 20,
                                     bold: true,},
                                  minValue: 0,
                                  format:'##,##',
                                  gridlines : {minSpacing: 10 }
                                },
                          width : '1000',
                          height : '500'
                        };

                        var chartPoint<?php echo $iDuree ;?> = new google.visualization.AreaChart(document.getElementById('chart_point<?php echo $iDuree ;?>'));
                        chartPoint<?php echo $iDuree ;?>.draw(data, options);
                      }
</script>
