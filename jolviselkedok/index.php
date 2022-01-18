<?php
declare(strict_types=1);
require_once("Nevek.php");
require_once("Ajandek.php");

    echo <<<H
    <!DOCTYPE html>
    <html lang="hu">
    <head>
        <meta charset="UTF-8">    
        <title>Jólviselkedők</title>
    </head>
    <body>
H;
    function betolt($fajlnev, $osztaly):array {
        $t = [];
        if(($f = fopen($fajlnev, "r"))!==FALSE) {
            $paratlan = true;
            $a="";
            
            while(($sor=fgets($f))!==FALSE) {
                if($paratlan) {
                    $a = $sor;
                } else {
                    $b = $sor;
                    $t[]=new $osztaly($a, (float)$b);
                }
                $paratlan = !$paratlan;
                
            }
            fclose($f);
        }
        return $t;
    }
    
    function hasonlit($a, $b) {
        return ($a->getAktivitas()<$b->getAktivitas());
    }
    function hasonlit2($a, $b) {
        return ($a->getErtek()<$b->getErtek());
    }


    $szemelyek = betolt("jolviselkedok.txt", "Nevek");
    
    usort($szemelyek, "hasonlit");
    foreach($szemelyek as $szemely){
        echo "<p>".$szemely->getNev().$szemely->getAktivitas()."</p>";
    }
    $ajandekok = betolt("ajandekok.txt", "Ajandek");
    
    usort($ajandekok, "hasonlit2");
    foreach($ajandekok as $ajandek){
        echo "<p>".$ajandek->getAjandek().$ajandek->getErtek()."</p>";
    }
     echo "<ol>\n";
    $meddig = min([count($szemelyek), count($ajandekok)]);
    for($i=0; $i<$meddig; $i++) {
        echo "\t<li>", $szemelyek[$i]->getNev(), " - ", $ajandekok[$i]->getAjandek(), "</li>\n";
    }
    echo "</ol>\n"; 
 
    echo <<<H
        
    </div>    
    </body>
    </html>
H;




?>


    

