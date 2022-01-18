<?php
declare(strict_types=1);
define("FILENAME", "file.dat");

class UI{
    private $db;

    public function __construct(DataBase $db)
    {
        $this->db = $db;       
    }
    private function head(){
        echo <<<END
<!DOCTYPE html>
<html lang="en_US">
        <head>
            <tiltle>Akasztófa</tiltle>
            <meta charset="utf-8"/>
        </head>
        <body>

END;
    }
    private function foot(){
        echo <<<END
        </body>
    </html>
END;    
    }
//függvények

public function jatek(){
    $this->head();
    $feladvanyok=$this->db->leKer();
    $segit="";
    if(empty($_POST)){
        $feladvany=$feladvanyok[array_rand($feladvanyok,1)];  
        $karakterlanc="";
    }else{
        if(($file = file_get_contents(FILENAME))){
            $feladvany=unserialize($file);
        }       
        
        $karakterlanc = filter_input(INPUT_POST, "karakter", FILTER_SANITIZE_STRING);
        $segit = filter_input(INPUT_POST, "segit", FILTER_SANITIZE_STRING);       
    }
    $rosszkarakterlanc="";
    $rosszkarakterlanc = $rosszkarakterlanc.$karakterlanc;
    $utolso=mb_substr($rosszkarakterlanc, -1);

    if($segit=="yes"){
        $talalt=false;
        $feladvany->setHiba($feladvany->getHiba()+1);
        foreach($feladvany->getOsszkarakter() as $karakter){
           if(in_array($karakter, $feladvany->getFeladvany())&&(str_contains($rosszkarakterlanc,$karakter))==false&&$talalt==false){
                $utolso=$karakter;
                $talalt=true;
                $rosszkarakterlanc = $rosszkarakterlanc.$karakter;
                $karakterlanc=$karakterlanc.$karakter;
                //echo $rosszkarakterlanc;
           }
        }
   }
    if(in_array($utolso,$feladvany->getFeladvany() )){
        $feladvany->putKitalal($utolso);
    }else{
        echo "Sikertelen próbálkozás";
        $feladvany->setHiba($feladvany->getHiba()+1);
        $feladvany->setRossz($utolso);
    }
    if($feladvany->getHiba()>6){
        echo "<p>Lúzer</p>";
        echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">\n";
        echo   "<input type=\"submit\" value=\"Újboli próbálkozás\" />\n".
        "</form>\n";
    $rosszkarakterlanc="";


    }else if($feladvany->nyertel()){
        echo "<p>Grat, nyertél!</p>";
        echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">\n";
        echo   "<input type=\"submit\" value=\"Újboli próbálkozás\" />\n".
        "</form>\n";
    $rosszkarakterlanc="";


    }else{
    echo "Rossz karakterek:".$feladvany->getRossz();
    echo "<p>Még lehetséges próbálkozások száma:".(7-(int)$feladvany->getHiba()."</p>");
          

    file_put_contents(FILENAME,serialize($feladvany));

    echo "</br>";
    echo $feladvany->kiiras();
    echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">\n";
    echo "<select name=\"karakter\">\n";
    foreach($feladvany->getOsszkarakter() as $karakter){
        
        if(!(str_contains($karakterlanc, $karakter))){
        echo "<option value=\"".($rosszkarakterlanc.$karakter)."\">".$karakter."</option>\n";
        }
    }
    echo   "<input type=\"submit\" value=\"Mehet\" />\n".
    "</form>\n"; 
    }  

    echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">\n";

    echo "<input type=\"hidden\" value=\"yes\" name=\"segit\"/>\n";
    echo "<input type=\"hidden\"  value=\"".($rosszkarakterlanc.$karakter)."\" name=\"karakter\"/>\n";
    
    echo   "<label>Szeretnél segítséget kapni egy próbálkozásért?</label><input type=\"submit\" value=\"Igen!\" />\n".
    "</form>\n"; 



   

    $this->foot();
}


}
