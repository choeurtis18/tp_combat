<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
  <h1>Wizard VS Warrior</h1>
  <h2>Veuillez entrer le nom de votre personnage et renseigner son type.</h2>

  <form action="Arene.php" method="POST">
    <p>Donnez un nom à votre personnage</p>
    <input type="text" name="nomPerso">
    <div class="typeBtn">
      <p>Choisissez le type de votre personnage</p>
      <input type="radio" name="radioBtn" value="guerrier">Guerrier
      <input type="radio" name="radioBtn" value="magicien">Magicien
    </div>
    <button name="submit">Créer un personnage</button>
  </form>
</body>
</html>