<?php
class Foglalas{
    private $id;   
    private $szoba_id;    
    private $mettol;
    private $meddig;
    

    public function __construct( int $id=null, int $szoba_id=null, string $mettol=null, string $meddig=NULL )    
    {
        if($id!==NULL && $szoba_id!==NULL && $mettol!==NULL && $meddig!==NULL){
        $this->id=$id;
        $this->szoba_id=$szoba_id;        
        $this->mettol = $mettol; 
        $this->meddig=$meddig;
        }
        
               
    }
    public function getID() : int {
        return $this->id;
    } 
    public function getSzoba_id() : int {
        return $this->szoba_id;
    } 
  

    public function getMettol() : string {
        return $this->mettol;
    }
    public function getMeddig() : string {
        return $this->meddig;
    }






}