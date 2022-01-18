<?php
class Nevek{
    private $nev;
    private $aktivitas;

    public function __construct($nev, float $aktivitas)
    {
        $this->nev = $nev;
        $this->aktivitas = $aktivitas;
        
    }

    public function getNev() :string {
        return $this->nev;
    }
    public function getAktivitas() :float {
        return $this->aktivitas;
    }
}