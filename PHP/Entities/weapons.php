<?php 
 
class weapons{
    public string $Name;
 
    public int $damage;
   
    public int $ammo;
 
    public int $fireRate;
 
    public function __construct(string $Name, int $damage, int $ammo, int $fireRate){
        $this->Name = $Name;
        $this->damage = $damage;
        $this->ammo = $ammo;
        $this->fireRate = $fireRate;
    }
 
 
    public function getName():string
    {
        return $this->Name;
    }
 
    public function __setName (string $Name) : void{
 
        $this->Name = $Name;
    }
 
 
     public function getdamage():int
    {
        return $this->damage;
    }
 
    public function __setdamage (int $damage) : void{
 
        $this->damage = $damage;
    }
 
     public function getammo():int
    {
        return $this->ammo;
    }
 
    public function __setammo (int $ammo) : void{
 
        $this->ammo = $ammo;
    }
 
     public function getfireRate():int
    {
        return $this->fireRate;
    }
 
    public function __setfireRate (int $fireRate) : void{
 
        $this->fireRate = $fireRate;
    }
 
   
}
 
 
?>