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
    <h1><a href="index.php">Retour menu</a></h1>
    <?php
      $id = htmlspecialchars($_GET["id"]);
      $db = new Dbconnexion();
      $db = $db->connection();

      $a = new Personage_Manager($db);
      $personage = $a->getPersonnage(intval($id));
    
    ?>
    <p><?php echo htmlspecialchars($_GET["error"]);?></p>
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
        $manage = new Personage_Manager($db->connection());

        $personages = $manage->getPersonnages();
        foreach($personages as $perso) {
      ?>
      <a href="InfosPerso.php?id=<?php echo $perso->getID();?>" > <p><?php echo $perso->getNom();?> le <?php echo $perso->getType();?></p></a>
      <a href="action.php?action=attaquer&id_attaque=<?php echo $personage->getID();?>&id_defense=<?php echo $perso->getID();?>"><button name="attack">Attaquer</button></a>
      <?php
        if($personage->getType() == "magicien") {
      ?>
      <a href="action.php?action=dodo&id_attaque=<?php echo $personage->getID();?>&id_defense=<?php echo $perso->getID();?>"><button name="dodo">Endormir</button></a>
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

