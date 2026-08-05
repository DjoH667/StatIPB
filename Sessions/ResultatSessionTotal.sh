# !/bin/bash
clear
echo "*******************"
echo "Traitement en cours"
echo "*******************"
date
echo " "

nbligne=0
nbimpact=0

# set -x # Activation du débogage à partir de maintenant
# date # Cette ligne est la ligne qui affiche la date
# set +x # Désactivation du débogage à partir de maintenant


cat ResultatsSession.csv | while  read ligne ; do

  nbligne=$((nbligne+1))
  # echo "nbLigne = $nbligne"

  my_array=($(echo $ligne | tr ";" "\n"))

  # echo "-->my_array0 = ${my_array[0]}"
  if test "${my_array[0]}" = "NP" ; then

    echo " "

    # if test $nbligne != 0 ; then
    # echo "Nombre Impact = $nbimpact"
    # fi
    echo "RESULTATS"
    echo ">$nbimpact Impacts"
    echo ">$score Pts"
    echo ""
    echo "****************"
    echo "Nouvelle Partie "
    echo "****************"
    echo "-->Joueur : ${my_array[1]}"
    echo "Durée : ${my_array[2]} s"
    echo "Dist Nominale : ${my_array[3]} cm - c1/c2 : ${my_array[4]}/${my_array[5]}"
    echo "Info complementaire : ${my_array[6]}"

    # // Init des valeurs d'une $partie
     NbImpact=0
     TpsImpactPrecedent=0
     DeltaTps=0
     DeltaTpsMin=0
     DeltaTpsMax=0
     Score=0
     SommeDist=0
     Dmoyenne=0
     DMin=0
     DMax=0
     Dmoyenne=0
     DMin=0
     DMax=0
     SommeForce=0
     ForceMoyenne=0
     ForceMin=0
     ForceMax=0

    # // init du  Nb im pact de chaque  Nb Cibles
     NbBG=0
     NbBGG=0
     NbHG=0
     NbHGG=0

     NbBD=0
     NbBDD=0
     NbHD=0
     NbHDD=0

     NbHaut=0
     NbBas=0

     NbExtG=0
     NbCentreG=0
     NbCentreD=0
     NbExtD=0

     NbGauche=0
     NbDroite=0

     NbHS=0

    # // init de la distance im pact de chaque  Nb Cibles
     DistBG=0
     DistBGG=0
     DistHG=0
     DistHGG=0

     DistBD=0
     DistBDD=0
     DistHD=0
     DistHDD=0

     DistHaut=0
     DistBas=0

     DistExtG=0
     DistCentreG=0
     DistCentreD=0
     DistExtD=0

     DistGauche=0
     DistDroite=0

     DistHS=0

    # // init de la  Force d'im pact de chaque  Nb Cibles
     ForceBG=0
     ForceBGG=0
     ForceHG=0
     ForceHGG=0

     ForceBD=0
     ForceBDD=0
     ForceHD=0
     ForceHDD=0

     ForceHaut=0
     ForceBas=0

     ForceExtG=0
     ForceCentreG=0
     ForceCentreD=0
     ForceExtD=0

     ForceGauche=0
     ForceDroite=0

     ForceHS=0

    # // init du  pourcentage de chaque Cible
     pNbBG=0
     pNbBGG=0
     pNbHG=0
     pNbHGG=0

     pNbBD=0
     pNbBDD=0
     pNbHD=0
     pNbHDD=0

     pNbHaut=0
     pNbBas=0

     pNbExtG=0
     pNbCentreG=0
     pNbCentreD=0
     pNbExtG=0

     pNbGauche=0
     pNbDroite=0


  else
    nbimpact=$((nbimpact+1))
    score=${my_array[6]}

    Dist=${my_array[3]}

    # // Calcul sur Distance
    SommeDist=$(($SommeDist+$Dist)) | dc
    # SommeDist=$(($SommeDist+$Dist))
    # Dmoyenne=$SommeDist/$NbImpact

    echo "SommeDist : $SommeDist m"
    # echo "Distance Moyenne : $Dmoyenne m"

    echo "$nbimpact Impacts"
    echo ">$score Pts"


  fi

done
# <<<$(find tmp -type f)


echo "RESULTATS"
echo ">$nbimpact Impacts"
echo ">$score Pts"

echo " "
echo " "
echo "*******************"
echo "Traitement terminé "
echo "*******************"
echo " "
