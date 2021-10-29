<?php

spl_autoload_register(function($className){
  require $className.".php";
});


try {
  $db = new PDO("mysql:host=db;dbname=tp_combat", "root", "password");
} catch (Exception $e) {
  die('Erreur : '.$e->getMessage());
}

if (isset( $_POST['submit'] ) ) {
  $nomPerso = $_POST['nomPerso'];
  $type = $_POST['type'];
}

if (isset($nomPerso) && isset($type) && $nomPerso != "") {
  echo 'type : ' . $type . '</br>';
  echo 'Nom : ' . $nomPerso ;
  $a = new Manage_personnage($db);
  $reponse = $a->addPersonage($nomPerso, $type);
}
else {
  echo "Veuillez remplir tous les champs";
}

$a = new Manage_personnage($db);
$reponse = $a->getPersonnages();
//echo $response;


?>
