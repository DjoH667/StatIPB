<!DOCTYPE html>
<html>
<head>
<style>
body {
 /* background-color: #93B874; initiale */
 /* background-color: #B0CC99; */
 background-color: #e9f0ea;
 font-family: "Arial Rounded Bold", sans-serif;
 padding: 0px !important;
 margin: 0px !important;
 font-size: 18px;
}
thead {
  background-color: #a4b780;
  font-size: 24x;

}
td {
  font-size: 20px;
}
h1 {
 background-color: #3CB371;
 color:black;
}
h2 {
 background-color: #a4b780;
 color:white;
}
h3 {
  font-size: 30px;
}
h4 {
  font-size: 15px;
}
h5 {
  font-size: 15px;
  color:black;
}

/* p {
 background-color: #FFFFFF);
} */

/* unvisited link */
a:link {
  color: #43935e;
}

/* visited link */
a:visited {
  color: #43935e;
}

/* mouse over link */
a:hover {
  color: white;
  background-color: #43935e;
}

/* selected link */
a:active {
  color: grey;
}
</style>
</head>
<body>


<table style="width: 100%; border-collapse: collapse; height:;" border="0">
<tbody>
<thead>
  <tr style="height: ;">
    <!-- <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td> -->
    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>

    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>

    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>
    <!-- <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td> -->
  </tr>
</thead>

  <tr style="height: ;">
    <!-- <td style="width: 8%; height: 20px;"></td>
    <td style="width: 8%; height: 20px;"></td> -->
    <td style="width: 8%; height: 20px; text-align:center; vertical-align:top "><a href="index.php"><img src="Images/Profil FB iPassBall 80px.png" alt="iPassBall Contrôle Passe !"></td>
    <td style="width: 8%; height: 20px; text-align:center;"><h2>MENU</h2></td>

    <td style="width: 8%; height: 20px; text-align:center;"><h2><a href="TableJoueurs.php">Joueurs</a></h2></td>
    <td style="width: 8%; height: 20px;text-align:center;"><h2><a href="TableSessions.php">Sessions</a></h2></td>
    <td style="width: 8%; height: 20px; text-align:center;"><h2><a href="TableParties.php">Parties</a></h2></td>
    <td style="width: 8%; height: 20px; text-align:center;"><h2><a href="AbaquePointDistance.php">Abaque</a></h2></td>

    <!-- <td style="width: 8%; height: 20px;"></td> -->
    <!-- <td style="width: 8%; height: 20px;"></td> -->
    <td style="width: 8%; height: 20px; text-align:right; vertical-align:center" colspan="2"><?php
    date_default_timezone_set("Europe/Paris");
    echo "Le ".date("d/m/Y") ." " . date("H:i");
    ?></td>
      <!-- <td style="width: 8%; height: 20px;"> -->
  </tr>
  <thead>
  <tr style="height: ;">
    <!-- <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td> -->
    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>

    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>

    <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td>
    <!-- <td style="width: 8%; height: 5px;"></td>
    <td style="width: 8%; height: 5px;"></td> -->
  </tr>
  </thead>
</tbody>
</table>
<br>
