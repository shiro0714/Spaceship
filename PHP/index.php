<?php
 
require_once 'Entities/Spaceship.php';  
require_once 'Entities/weapons.php';
require_once 'Entities/armory.php';
 
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

 echo "<br>";


 $weapons1 = new weapons("Pulse rifle", 50, 100, 50);
echo ($weapons1->getName() );
 echo "\n";
 
 
$weapons2 = new weapons( " ",67, 100, 50);
echo ($weapons2->getdamage() );
 echo "\n";
 
$weapons3 = new weapons( " ",30, 50, 50);
echo ($weapons3->getammo() );
 echo "\n";
 
$weapons4 = new weapons( " ",30, 100, 41);
echo ($weapons4->getfireRate() );
 echo "\n";



 echo "<br>";


 $armory = new armory("armory", 30, 100, 50);
echo ($armory->getName() );
 echo "\n";
 
 
$armory = new armory( " ",67, 100, 50);
echo ($armory->getstorage() );
 echo "\n";
 
$armory = new armory( " ",30, 30, 50);
echo ($armory->getprotection() );
 echo "\n";
 
$armory = new armory( " ",30, 100, 61);
echo ($armory->getweapons() );
 echo "\n";
 
echo "<br>";

 // if statement waarbij als ammmo van waepons 0 of kleiner is echo "out of ammo" en zo niet "ammo available"
    if($weapons3->getammo() <= 0){
        echo "out of ammo";
    } else {
        echo "ammo available";
    }
?>