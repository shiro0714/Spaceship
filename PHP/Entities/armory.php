<?php 
 
class armory{
    public string $Name;
 
    public int $storage;
   
    public int $protection;
 
    public int $weapons;
 
    public function __construct(string $Name, int $storage, int $protection, int $weapons){
        $this->Name = $Name;
        $this->storage = $storage;
        $this->protection = $protection;
        $this->weapons = $weapons;
    }
 
 
    public function getName():string
    { 
        return $this->Name;
    }
 
    public function __setName (string $Name) : void{
 
        $this->Name = $Name;
    }
 
 
     public function getstorage():int
    {
        return $this->storage;
    }
 
    public function __setstorage (int $storage) : void{
 
        $this->storage = $storage;
    }
 
     public function getprotection():int
    {
        return $this->protection;
    }
 
    public function __setprotection (int $protection) : void{
 
        $this->protection = $protection;
    }
 
     public function getweapons():int
    {
        return $this->weapons;
    }
 
    public function __setweapons (int $weapons) : void{
 
        $this->weapons = $weapons;
    }
 
   
}
 
 
?>