<?php
class Elotanulmanyok{
    private $kod;   
    private $elotanulmany;    


    public function __construct(string $kod, Kotelezo $elotanulmany)    
    {
     $this->kod=$kod;
     $this->elotanulmany=$elotanulmany;
               
    }
    public function getkod() : string {
        return $this->kod;
    } 
    public function getelotanulmany() : Kotelezo {
        return $this->elotanulmany;
    } 
    




}