#!/bin/csh

echo "usage : A faire dans le répertoire principal du projet"
echo "./module.sh toto : cree un module toto avec les fichiers necessaires (et la vue index)"

set m = $argv[1]
mkdir ./modules/$m
mkdir ./modules/$m/actions
mkdir ./modules/$m/vues

touch ./modules/$m/vues/indexVue.php
touch ./modules/$m/actions/$m"Actions.class.php"


echo "<?php" >> ./modules/$m/actions/$m"Actions.class.php"
echo class $m"Actions extends baseActions {" >> ./modules/$m/actions/$m"Actions.class.php"
echo " " >> ./modules/$m/actions/$m"Actions.class.php"
echo "	public function executeindex() {" >> ./modules/$m/actions/$m"Actions.class.php"
echo " " >> ./modules/$m/actions/$m"Actions.class.php"
echo "  }// Ne pas modifier a partir de la !" >> ./modules/$m/actions/$m"Actions.class.php"
echo "}" >> ./modules/$m/actions/$m"Actions.class.php"


chmod 755 ./modules/$m
chmod 755 ./modules/$m/actions
chmod 755 ./modules/$m/vues
chmod 644 ./modules/$m/vues/indexVue.php
chmod 644 ./modules/$m/actions/$m"Actions.class.php"




