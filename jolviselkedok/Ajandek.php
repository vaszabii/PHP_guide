<?php
class Ajandek{
    private $ajandek;
    private $ertek;

    public function __construct($ajandek, float $ertek)
    {
        $this->ajandek = $ajandek;
        $this->ertek = $ertek;
        
    }

    public function getAjandek() :string {
        return $this->ajandek;
    }
    public function getErtek() :float {
        return $this->ertek;
    }
}