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


  else
    nbimpact=$((nbimpact+1))
    score=${my_array[6]}
    echo "$nbimpact Impacts"
    echo ">$score Pts"
    # $ni=$nbimpact
    # $sc=$score
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
