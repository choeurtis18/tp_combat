<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <?php include 'creerPerso.php'?>
  <title>Document</title>
</head>
<body>
  <div class="container">
    <h1>Wizard VS Warrior</h1>
    <h2>Créez votre personnage !</h2>

    <form action="index.php" method="POST">
      <div class="step typeBtn">
        <label for="type">Spécifiez son type</label>
        <input type="radio" name="type" value="guerrier">Guerrier
        <input type="radio" name="type" value="magicien">Magicien
      </div>
      <div class="step">
        <label for="nomPerso">Donnez lui un nom</label>
        <input type="text" name="nomPerso">
      </div>
      <button name="submit">Créer un personnage</button>
    </form>
  </div>
</body>
</html>