<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <?php include 'creerPerso.php' ?>
  <title>Document</title>
</head>
<body>
  <div class="container">
    <h1><?php echo ($nomPerso) ?></h1>
    <h2><?php echo ($type) ?></h2>
    <div class="box">
      <p>Points de Vie : </p>
      <p>Attaque : </p>
      <p>Défense : </p>
    </div>
    <button name="attack">Attaquer</button>
  </div>
  
</body>
</html>

