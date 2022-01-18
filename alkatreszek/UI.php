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
<html lang="hu_HU">
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

public function termek(){
    $this->head();
    $t=[];
    foreach($_POST as $kulcs=>$ertek){
        if($ertek=="on"){
            $tulajdonsag= rtrim($kulcs,'_');
            foreach($_POST as $kulcs=>$ertek){
                if($kulcs==$tulajdonsag){
                    $kulcsr=str_replace("_"," ",$kulcs);
                    $t[$kulcsr]=$ertek;
                }
            }
        }
    }
    
    $tulajdonsagok=$this->db->getTulajdonsagGroup();
    echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">";

    foreach($tulajdonsagok as $tulajdonsag){
        $ertekek=$this->db->getErtekek($tulajdonsag->getTulajdonsag());


        echo "<div><input type=\"checkbox\" name=\"".$tulajdonsag->getTulajdonsag()." \"   >".$tulajdonsag->getTulajdonsag();
        echo "<select name=\"".$tulajdonsag->getTulajdonsag()."\">";
        foreach($ertekek as $ertek){
        echo "<option value=\"".$ertek->getErtek()."\" >".$ertek->getErtek()."</option>";

        }
        echo "</select>";
        echo "</div>";
   

        
        }
    echo "<input type=\"submit\" value=\"Szűrés\" />\n"."</form>";
    if(!empty($t)){
        print_r($t);
        echo "<table>";
        echo "<tr><th>Gyártó </th><th>Termék neve </th></tr>";
        $termekek=$this->db->geTermekSzurt($t);
        foreach($termekek as $termek){
            echo "<tr>\n";
            echo "<td>".$termek->getGyarto()."</td>". 
                "<td><a href=\"".$_SERVER["PHP_SELF"]."?page=tulajdonsag"."&id=".$termek->getID()."\">".$termek->getModell()."</a></td>";
            echo "</tr>";        
        }
    }else{
        echo "<table>";
        echo "<tr><th>Gyártó </th><th>Termék neve </th></tr>";
        $termekek=$this->db->getTermekek();
        foreach($termekek as $termek){
        echo "<tr>\n";
        echo "<td>".$termek->getGyarto()."</td>". 
            "<td><a href=\"".$_SERVER["PHP_SELF"]."?page=tulajdonsag"."&id=".$termek->getID()."\">".$termek->getModell()."</a></td>";
        echo "</tr>";
        
        }
    }

    echo "</table>";

    $this->foot();
}
public function tulajdonsag(string $id){
    $this->head();
    $termekek=$this->db->getTermekek($id);
    foreach($termekek as $termek){
        echo "<p>A termék gyártója: ".$termek->getGyarto()."   A termék neve: ".$termek->getModell()."</p>";
    }
    $tulajdonsagok=$this->db->getTulajdonsag($id);
    echo "<table>";
    echo "<tr><th>Gyártó </th><th>Termék neve </th></tr>";
    foreach($tulajdonsagok as $tulajdonsag){
        echo "<tr>\n";
        echo "<td>".$tulajdonsag->getTulajdonsag()."</td>". 
            "<td>".$tulajdonsag->getErtek()."</a></td>";
        echo "</tr>";
    
    }
   

    echo "</table>";





    echo "<a href=\"".$_SERVER["PHP_SELF"]."\">Vissza a főoldalra.</a>";

    $this->foot();

}


}
