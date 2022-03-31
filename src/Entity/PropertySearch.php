<?php 
namespace App\Entity; 


class PropertySearch{

    
    private $secteur; 
    private $crypto ; 

    public function setsecteur(  string $secteur ) 
    {
        $this->secteur = $secteur ;
        return $this; 
    }

    public function getsecteur( )  
    {
        return $this->secteur ;
    }





    public function setcrytpo(  string $crypto ) 
    {
        $this->crypto = $crypto ;
        return $this; 
    }
    
    public function getcrypto( )  
    {
        return $this->crypto ;
    }
}