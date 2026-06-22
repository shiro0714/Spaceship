<?php
 
class Spaceship{
    public string $Name;
 
    public int $length;
   
    public int $HP;
 
    public int $Attack;
 
    public function __construct(string $Name, int $length, int $HP, int $Attack){
        $this->Name = $Name;
        $this->length = $length;
        $this->HP = $HP;
        $this->Attack = $Attack;
    }
 
 
    public function getName():string
    {
        return $this->Name;
    }
 
    public function __setName (string $Name) : void{
 
        $this->Name = $Name;
    }
 
 
     public function getlength():int
    {
        return $this->length;
    }
 
    public function __setlength (int $length) : void{
 
        $this->length = $length;
    }
 
     public function getHP():int
    {
        return $this->HP;
    }
 
    public function __setHP (int $HP) : void{
 
        $this->HP = $HP;
    }
 
     public function getAttack():int
    {
        return $this->Attack;
    }
 
    public function __setAttack (int $Attack) : void{
 
        $this->Attack = $Attack;
    }
 
   public function _atatack():string
    {
       return "Spaceship " . $this->Name . " is attacking with " . $this->Attack . " damage!";
    }
}   
 
 
?>