<?php
 
require_once 'Entities/Spaceship.php';  
 
$Spaceship = new Spaceship("Destroyer", 30, 100, 50);
echo ($Spaceship->getName() );
 echo "\n";
 
$Spaceship-> __setName("Cruiser", 40, 150, 70);
echo ($Spaceship->getName() );
 echo "\n";
 
$Spaceship = new Spaceship( " ",30, 100, 50);
echo ($Spaceship->getlength() );
 echo "\n";
 
$Spaceship = new Spaceship( " ",30, 100, 50);
echo ($Spaceship->getHP() );
 echo "\n";
 
$Spaceship = new Spaceship( " ",30, 100, 50);
echo ($Spaceship->getAttack() );
 echo "\n";
 
?>