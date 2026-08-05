<html>
<?php

include 'Head.php';
//include 'Header.php';
//include 'SideBar.php';
//
//include 'MenuIPassBall.php';  // Ok.
?>
<?php
/**
 * Exemple simple qui étend la classe SQLite3 et change les paramètres
 * __construct, puis, utilise la méthode de connexion pour initialiser la
 * base de données.
 */
include 'ConnexionBDDiPassBall.php';

// Lecture des donnees dans la table
$sql = "SELECT * FROM Joueurs";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);
if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {


?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        Widget settings form goes here
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn blue">Save changes</button>
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <!-- BEGIN STYLE CUSTOMIZER -->
        <div class="theme-panel hidden-xs hidden-sm">
            <div class="toggler">
            </div>
            <div class="toggler-close">
            </div>
            <div class="theme-options">
                <div class="theme-option theme-colors clearfix">
                    <span>
                    THEME COLOR </span>
                    <ul>
                        <li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default">
                        </li>
                        <li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue">
                        </li>
                        <li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue">
                        </li>
                        <li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey">
                        </li>
                        <li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light">
                        </li>
                        <li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2">
                        </li>
                    </ul>
                </div>
                <div class="theme-option">
                    <span>
                    Layout </span>
                    <select class="layout-option form-control input-small">
                        <option value="fluid" selected="selected">Fluid</option>
                        <option value="boxed">Boxed</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                    Header </span>
                    <select class="page-header-option form-control input-small">
                        <option value="fixed" selected="selected">Fixed</option>
                        <option value="default">Default</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                    Sidebar Mode</span>
                    <select class="sidebar-option form-control input-small">
                        <option value="fixed">Fixed</option>
                        <option value="default" selected="selected">Default</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                    Sidebar Menu </span>
                    <select class="sidebar-menu-option form-control input-small">
                        <option value="accordion" selected="selected">Accordion</option>
                        <option value="hover">Hover</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                    Sidebar Style </span>
                    <select class="sidebar-style-option form-control input-small">
                        <option value="default" selected="selected">Default</option>
                        <option value="light">Light</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                    Sidebar Position </span>
                    <select class="sidebar-pos-option form-control input-small">
                        <option value="left" selected="selected">Left</option>
                        <option value="right">Right</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>
                    Footer </span>
                    <select class="page-footer-option form-control input-small">
                        <option value="fixed">Fixed</option>
                        <option value="default" selected="selected">Default</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- END STYLE CUSTOMIZER -->
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Blank Page <small>blank page</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.php">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Page Layouts</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Blank Page</a>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    Actions <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="#">Action</a>
                        </li>
                        <li>
                            <a href="#">Another action</a>
                        </li>
                        <li>
                            <a href="#">Something else here</a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="#">Separated link</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

<!-- DEBUT CONTENU PROPRE IPASSBALL ***********************************************************************************************************-->
             <div class="note note-success">
                 <p> Please try to re-size your browser window in order to see the tables in responsive mode. </p>
             </div>
             <!-- BEGIN SAMPLE TABLE PORTLET-->
             <div class="portlet box green">
                 <div class="portlet-title">
                     <div class="caption">
                         <i class="fa fa-cogs"></i>Responsive Flip Scroll TABLE JOUEURS
                    </div>
                     <div class="tools">
                         <a href="javascript:;" class="collapse">collapse </a>
                         <a href="#portlet-config" data-toggle="modal" class="config">config </a>
                         <a href="javascript:;" class="reload"> reload</a>
                         <a href="javascript:;" class="remove"> </a>
                     </div>
                 </div>
            </div>


              <div class="portlet-body flip-scroll">
                <table class="table table-bordered table-striped table-condensed flip-content">
                  <thead class="flip-content">
                   <tr>
                      <th class="numeric"><b>#</b></td>
                      <th class="numeric"><b>Code</b></td>
                      <th class="numeric"><b>Nom</b></td>
                      <th class="numeric"><b>Prenom</b></td>
                      <!--  <th class="numeric"><b>Date Naissance</b></td>
                       <th class="numeric"><b>Tel</b></td>
                       <th class="numeric"><b>Mail</b></td>
                       <th class="numeric"><b>Origine Coord</b></td>
                       <th class="numeric"><b>Club</b></td>  -->
                      <th class="numeric"><b>Date Creation</b></td>
                   </thead>
                  </tr>


                 <tbody>
<?php
    while ($row = $reponse->fetchArray()) {
              /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/
              echo "<tr>";
              echo " <th class='numeric'><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['IdJoueur']."</a></td>";
              echo " <th class='numeric'><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['CodeJoueur']."</a></td>";
              echo " <th class='numeric'><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['NomJoueur']."</a></td>";
              echo " <th class='numeric'><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['PrenomJoueur']."</a></td>";
              //echo " <th class='numeric'>".$row['DateNaissance']."</td>";
              //echo " <th class='numeric'>".$row['TelJoueur']."</td>";
              //echo " <th class='numeric'>".$row['MailJoueur']."</td>";
              //echo " <th class='numeric'>".$row['OrigineCoordJoueur']."</td>";
              //echo " <th class='numeric'>".$row['ClubJoueur']."</td>";
              echo " <th class='numeric'>".$row['DateCreation']."</td>";
              echo "</tr>";

    }
}
?>
              </tbody>
            </table>
          </div>
<!-- FIN CONTENU PROPRE IPASSBALL ***********************************************************************************************************-->

            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->

<br>
<?php
// Deconnexion
$bd = null;

include 'Footer.php';
include 'EndOfPage.php';
?>
</html>
