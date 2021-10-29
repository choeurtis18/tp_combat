<?php

spl_autoload_register(function($className){
  require $className.".php";
});


try {
  $db = new Dbconnexion();
  $db = $db->connection();
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
  
  $url = './index.php';
  header("Location: $url");
}
else {
  $url = './index.php';
  $param = 'error=Veuillez remplir tous les champs';
  $url = editURL_parameter($url, $param);
  header("Location: $url");
}

function editURL_parameter($url, $param_string){
  $query = parse_url($url, PHP_URL_QUERY);
  // Returns a string if the URL has parameters or NULL if not
  if ($query) {
      $url .= '&'.$param_string;
  } else {
      $url .= '?'.$param_string;
  }

  return $url;
}
?>
