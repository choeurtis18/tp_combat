<?php

spl_autoload_register(function($className){
  require $className.".php";
});


try {
  $db = new PDO("mysql:host=db;dbname=tp_combat", "root", "password");
} catch (Exception $e) {
  die('Erreur : '.$e->getMessage());
}

$nomPerso = $type = $nomPersoErr = "";

if (isset( $_POST['submit'] ) ) {
  $nomPerso = $_POST['nomPerso'];
  $type = $_POST['type'];
}

if (isset($nomPerso) && isset($type) && $nomPerso != "") {
  $a = new Manage_personnage($db);
  $reponse = $a->addPersonage($nomPerso, $type);
}
else {
  $nomPersoErr = "Veuillez remplir tous les champs";
}

?>
