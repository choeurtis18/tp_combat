<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Bienvenue dans l'Arène de combat</h1>
</body>
</html>

<?php

if (isset( $_POST['submit'] ) ) {
  $nomPerso = $_POST['nomPerso'];
  $radioBtn = $_POST['radioBtn'];
}

echo 'type : ' . $radioBtn . '</br>';
echo 'Nom : ' . $nomPerso ;

?>