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
    <?php
      $id = htmlspecialchars($_GET["id"]);
      $db = new Dbconnexion();
      $db = $db->connection();
      $a = new Manage_personnage($db);
      $personage = $a->getPersonnage(intval($id));
    
    ?>
    <h1><?php echo $personage->getNom();?></h1>
    <h2><?php echo $personage->getType();?></h2>
    <div class="box">
      <p>Points de Vie : <?php echo $personage->getHp();?></p>
      <p>Attaque : <?php echo $personage->getAttack();?></p>
      <p>Défense : <?php echo $personage->getDefence();?></p>
    </div>

    <div>
      <h2>Liste personnage</h2>
      <?php
        $db = new Dbconnexion();
        $manage = new Manage_personnage($db->connection());
        $personages = $manage->getPersonnages();
        foreach($personages as $perso) {
      ?>
      <a href="./InfosPerso.php?id=<?php echo $perso->getID();?>" > <p><?php echo $perso->getNom();?> le <?php echo $perso->getType();?></p></a>
      <button name="attack">Attaquer</button>
      <?php
        if($personage->getType() == "magicien") {
      ?>
      <button name="dodo">Endormir</button>
      <?php
        }
      ?>
      <?php
        }
      ?>
    </div>
  </div>
  
</body>
</html>

