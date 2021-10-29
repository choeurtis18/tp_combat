<?php 
spl_autoload_register(function($className){
  require $className.".php";
});
?>
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
  <div class="container">
    <h1>Wizard VS Warrior</h1>
    <h2>Créez votre personnage !</h2>

    <form action="creerPerso.php" method="POST">
      <div class="step typeBtn">
        <label for="type">Spécifiez son type</label>
        <input type="radio" name="type" value="guerrier">Guerrier
        <input type="radio" name="type" value="magicien">Magicien
      </div>
      <div class="step">
        <label for="nomPerso">Donnez lui un nom</label>
        <input type="text" name="nomPerso">
        <p><?php echo htmlspecialchars($_GET["error"]);?></p>
      </div>
      <button name="submit">Créer un personnage</button>
    </form>
    <div>
      <h2>Liste personnage</h2>
      <?php
        //connection a la data base
        $db = new Dbconnexion();
        $manage = new Personage_Manager($db->connection());

        //recuperer liste de personnage
        $personages = $manage->getPersonnages();
        if($personages != NULL) {
          foreach($personages as $perso) {
      ?>
          <a href="InfosPerso.php?id=<?php echo $perso->getID();?>" > <p><?php echo $perso->getNom();?> le <?php echo $perso->getType();?></p></a>
      <?php
          }
        }
      ?>
    </div>
  </div>

</body>
</html>