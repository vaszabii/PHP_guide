<?php
declare(strict_types=1);

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
            <tiltle></tiltle>
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

public function targyak(){
    $this->head();
    $targyak=$this->db->getTargyak();
    usort($targyak, function($a, $b) {return strcmp($a->getMegnevezes(),$b->getMegnevezes());});

    echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=megjelenit\" method=\"post\">";

    echo "<select name=\"targy\">";

    foreach($targyak as $targy){
        echo "<option value=\"".$targy->getKod()."\" >".$targy->getMegnevezes()."</option>";
    }
    
    echo "</select>";
    echo "<input type=\"submit\" value=\"Mehet\" />\n"."</form></br>";

    if(empty($_POST)){
        echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=felveheto\" method=\"post\">";
        echo "<div><label>Válasszon félévet<select name=\"felev\">";
        
         echo "<option value=\"paratlan\" >Őszi</option>";
         echo "<option value=\"paros\" >Tavaszi</option>";
            
        
    echo "</select></label></div>";
        echo "<p>Összes tárgy:</p>";
        foreach($targyak as $targy){
        echo "<div><label>".$targy->getMegnevezes()."<input type=\"checkbox\" name=\"".$targy->getKod()."\"   ></label></div>";
        }
        echo "<input type=\"submit\" value=\"Mehet\" />\n"."</form>";
    }else{
        $felev = filter_input(INPUT_POST, "felev", FILTER_SANITIZE_STRING);
        echo $felev;
        $marfelvette=[];
        foreach($_POST as $value => $ertek){
            $marfelvette[]=$value;
        }
        print_r($marfelvette);
        $megnemvettfel=[];
        foreach($targyak as $t){
            if(in_array($t->getKod(), $marfelvette)==false){
                $megnemvettfel[]=$t;
            }
        }
        echo "<p>Felvehető tárgyak:</p>";
        
        foreach($megnemvettfel as $t){
            $felveheti=true;
            $elotanulmanyok=$this->db->getElotanulmanyok($t->getKod());
            if($elotanulmanyok!==false){
                
                foreach($elotanulmanyok as $elotanulmany){
                   if(in_array($elotanulmany->getElotanulmany()->getKod(),$marfelvette)==false){
                    $felveheti=false;

                   }
        
                }

                
            }   
            if(($t->getAF()%2==0)&&$felev=="paros"&&$felveheti==true){
                echo "<div><label>".$t->getMegnevezes()."<input type=\"checkbox\" name=\"".$t->getKod()."\"   ></label></div>";

            }else if($t->getAF()%2!==0&&$felev=="paratlan"&&$felveheti==true){
                echo "<div><label>".$t->getMegnevezes()."<input type=\"checkbox\" name=\"".$t->getKod()."\"   ></label></div>";

            }
        }



        
    }







    $this->foot();
}

public function megjelenit(){
    $this->head();
    if(!empty($_POST)){
        $targykod = filter_input(INPUT_POST, "targy", FILTER_SANITIZE_STRING);
        
        $targy = $this->db->getTargyak($targykod);
        foreach($targy as $t){
            echo "<p>A tárgy megnevezése:{$t->getMegnevezes()}</p>";
            echo "<p>A tárgy neptun kódja:{$t->getKod()}</p>";
            echo "<p>A tárgy ajánlott féléve:{$t->getAf()}</p>";
        }
        echo "<table>";
        echo "<tr><th>Előtanulmány:</th></tr>";

        $this->tanulmanyrek($targykod,0);
        echo "</table>";
        
    }
    echo "<a href=\"".$_SERVER["PHP_SELF"]."\">Vissza a főoldalra.</a>";

    $this->foot();
}

public function tanulmanyrek(string $targykod, int $a){
    $elotanulmanyok = $this->db->getElotanulmanyok($targykod);
    echo "<tr>";
    for ($i=0; $i < $a; $i++) { 
        echo "<th></th>";
    }
   
    echo "<th>Név </th><th>Kód</th>";
    echo "</tr>";
        if($elotanulmanyok==false){
            echo "<tr><td>Nincsenek előtanulmányi követelmények</td></tr>";
            
        }     
        else{
        foreach($elotanulmanyok as $elotanulmany){
            echo "<tr>\n";
     
                for ($i=0; $i < $a; $i++) { 
                    echo "<td></td>";
                }
            
            echo "<td>".$elotanulmany->getElotanulmany()->getMegnevezes()."</td>". 
            "<td>".$elotanulmany->getElotanulmany()->getKod()."</td>";
             echo "</tr>";
             if($this->db->getElotanulmanyok($elotanulmany->getElotanulmany()->getKod())!==false){
                $this->tanulmanyrek($elotanulmany->getElotanulmany()->getKod(),$a+1);
             }
            

        }
    
    
    
       
         }

}




}
