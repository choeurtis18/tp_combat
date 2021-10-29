<?php

spl_autoload_register(function($className){
  require $className.".php";
});

//Connection à la base de donnees
$db = new Dbconnexion();
$db = $db->connection();


$nomPerso = $type = $nomPersoErr = "";
if (isset( $_POST['submit'] ) ) {
  $nomPerso = $_POST['nomPerso'];
  $type = $_POST['type'];
}
//Si formulaire remplis alors rafraichir la page avec le nvx perso
if (isset($nomPerso) && isset($type) && $nomPerso != "") {
  $a = new Personage_Manager($db);
  $reponse = $a->addPersonage($nomPerso, $type);
  
  $url = './index.php';
  header("Location: $url");
}
//Si non rafraichir la page avec un msg d'erreur
else {
  $url = './index.php';
  $param = 'error=Veuillez remplir tous les champs';
  $url = editURL_parameter($url, $param);
  header("Location: $url");
}

//creer un URL avec des parametre
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
