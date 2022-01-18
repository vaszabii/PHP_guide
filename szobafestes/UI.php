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
            <tiltle>Szobafestés</tiltle>
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

public function szoba(){
    $this->head();
    (float)$szelesseg = filter_input(INPUT_POST, "szel", FILTER_VALIDATE_FLOAT);
    (float)$hossz = filter_input(INPUT_POST, "hossz", FILTER_VALIDATE_FLOAT);
    (float)$magassag = filter_input(INPUT_POST, "mag", FILTER_VALIDATE_FLOAT);



    echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=nyilas\" method=\"post\">";

    echo "<div><label>Szélesség: <input type=\"float\" name=\"szel\" min=\"0\" value=\"".$szelesseg."\"></label></div>";
    echo "<div><label>Hosszúság: <input type=\"float\" name=\"hossz\" min=\"0\" value=\"".$hossz."\"></label></div>";
    echo "<div><label>Magasság: <input type=\"float\" name=\"mag\" min=\"0\" value=\"".$magassag."\"></label></div>";

    echo "<input type=\"submit\" value=\"Tovább\" />\n"."</form>";


    $this->foot();
}
public function nyilas(){
    $this->head();
    foreach($_POST as $p){
        if(empty($p)){
            header('HTTP/1.1 307 Temporary Redirect');        
            header("Location: ".$_SERVER["PHP_SELF"]);

        }
    }
    if(filter_has_var(INPUT_POST, "szelny")&&filter_has_var(INPUT_POST, "magny")){
        (float)$szelessegny = filter_input(INPUT_POST, "szelny", FILTER_VALIDATE_FLOAT);
        (float)$magassagny = filter_input(INPUT_POST, "magny", FILTER_VALIDATE_FLOAT, ["options" => ["min_range"=>0, "max_range"=>10]]);
       
        $szoba=unserialize(base64_decode($_POST["szoba"]));
        $nyilaszaro=new Nyilaszaro($szelessegny,$magassagny);
        $szoba->setNyilaszaro($nyilaszaro);
    
    }else{

    (float)$szelesseg = filter_input(INPUT_POST, "szel", FILTER_VALIDATE_FLOAT);
    (float)$hossz = filter_input(INPUT_POST, "hossz", FILTER_VALIDATE_FLOAT);
    (float)$magassag = filter_input(INPUT_POST, "mag", FILTER_VALIDATE_FLOAT);
    $szoba=new Szoba(null,$szelesseg,$hossz,$magassag);
    print_r($szoba);
    }



    echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=nyilas\"  method=\"post\">";
    echo "<div><label>Szélesség: <input type=\"number\" name=\"szelny\" min=\"0\"></label></div>";
    echo "<div><label>Magasság: <input type=\"number\" name=\"magny\" min=\"0\"></label></div>";
    echo "<input type=\"hidden\" value=\"".base64_encode(serialize($szoba))."\" name=\"szoba\"/>\n";
    echo "<input type=\"submit\" value=\"Hozzáad\" />\n"."</form>";
    if($szoba->getNyilaszaro()!==null){

    echo "<table>";
    echo "<tr><th>Szélesség</th><th>Magasság</th>></tr>";
    foreach($szoba->getNyilaszaro() as $nyilaszaro){
    echo "<tr>\n";
    echo "<td>".$nyilaszaro->getMagassag()."</td>". 
         "<td>".$nyilaszaro->getSzelesseg()."</td>";
    echo "</tr>";
    }   
    echo "</table>";
   
    
    }
    echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=felulet\"  method=\"post\">";
    echo "<input type=\"hidden\" value=\"".base64_encode(serialize($szoba))."\" name=\"szoba\"/>\n";
    echo "<input type=\"submit\" value=\"Tovább\" />\n"."</form>";
    $this->foot();
}
public function felulet(){
    $this->head();
    $szoba=unserialize(base64_decode($_POST["szoba"]));
    echo "<p>A szoba falainak a felülete nyílászárók nélkül: ".$szoba->getFelulet()." négyzetméter</p>";
    if($szoba->getNyilaszaro()==null)
    {
    echo "<p>Az összes nyílászárók száma: 0 </p>";
    }else{
    echo "<p>Az összes nyílászárók száma: ".count($szoba->getNyilaszaro())." </p>";
    }
    echo "<p>A nyílászárók által elfoglalt falfelület: ".$szoba->getNyilasfelulet()." négyzetméter</p>";
  



    $this->foot();

}

}
