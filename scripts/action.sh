#!/bin/csh
set m = $argv[1]
set a = $argv[2]
set nb = `more ./modules/$m/actions/$m"Actions.class.php" | wc -l `

mv ./modules/$m/actions/$m"Actions.class.php" /tmp
awk -f ./scripts/action.awk -v nb=$nb -v nom=$argv[2] /tmp/$m"Actions.class.php" > ./modules/$m/actions/$m"Actions.class.php"

touch ./modules/$m/vues/$a"Vue.php"
chmod 644  ./modules/$m/vues/$a"Vue.php"
