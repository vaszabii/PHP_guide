<?php
class UI{
    private $konyvtar;

    public function __construct(Konyvtar &$konyvtar)
    {
       $this->konyvtar = $konyvtar;
    }
    private function head(){
        echo <<<END
<!DOCTYPE html>
<html lang="en_US">
    <head>
        <title>Application for classroom test</title>
        <meta charset="utf-8" />
    </head>
    <body>

END;
    }

    private function foot() {
        echo <<<END
    </body>
</html>

END;
    }

    public function kereses(){
        $this->head();
        echo "<p>Keresés Cím/ Szerző / ISBM szerint<p>\n";
        echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=eredmeny\" method=\"post\">\n".
                     "<input type=\"text\" name=\"kulcs\"  />\n".
                     "<input type=\"submit\" value=\"Keres\" />\n".
                     "</form>\n";
        echo "<p><a href=\"".$_SERVER["PHP_SELF"]."?page=ujkonyv"."\">Új könyv felvétele.</a></p>\n";
        $this->foot();
    }
    public function eredmeny(){
        $this->head();
        echo "Eredmények:";
        $kulcs = $_POST["kulcs"];
        echo $kulcs;
        // filter_input(INPUT_POST, "kulcs", FILTER_SANITIZE_STRING);
        $eredmény = $this->konyvtar->Keres($kulcs);

        foreach($eredmény as $sor){
            echo "<p>".$sor->__toString()."</p>";
            
        }

        //if(str_contains( $kulcs,", ")){
           
            
            $t=explode(",",rtrim($kulcs));
            
            
            $eredmény = $this->konyvtar->kulcsKeres($t);
            foreach($eredmény as $sor){
                echo "<p>".$sor->__toString()."</p>";
                
            }
        //}
       
        echo "<p><a href=\"".$_SERVER["PHP_SELF"]."?page=kereses"."\">Vissza a kereséshez.</a></p>\n";

        $this->foot();
    }
    public function ujkonyv(){
            $this -> head();
            $labelszoveg = ["Cím:", "Szerző:", "ISBN szám:", "Kulcsszavak"];
            $name = ["cim", "szerzo", "isbn", "kulcsszavak"];
            if(!empty($_POST)){
                $fogad =[];
                foreach ($_POST as $kulcs => $ertek) {
                    if(in_array($kulcs, $name)){
                        $fogad[$kulcs] = $ertek;
                    }                
                        //nagyon low budget, nem biztos, hogy fog létezni ilyen kulcs
                }
                $trimmed = rtrim($fogad["kulcsszavak"]);
                echo $trimmed;
                $kulcsszavak=explode(",",$trimmed );
                $this->konyvtar->addKonyvek(new Konyv($fogad["cim"], $fogad["szerzo"], $fogad["isbn"], $kulcsszavak));

            }


            echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=ujkonyv\" method=\"post\">\n";
            for ($i=0; $i < 4; $i++) { 
                echo "<div><label>".$labelszoveg[$i].                 
                "<input type=\"text\" name=\"".$name[$i]."\" required />\n";
                echo "</label></div>";
            }
            echo "<input type=\"submit\" value=\"Mentés\" />\n";
            echo "</form>\n";

            echo "<p><a href=\"".$_SERVER["PHP_SELF"]."?page=kereses"."\">Vissza a kereséshez.</a></p>\n";

            $this ->foot();
    }
    


}


?>
