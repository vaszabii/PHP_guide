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
            <tiltle>Sporttevékenység</tiltle>
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
    public function kereses(){
        $this->head();
        $felhasznalok = $this->db->getSportolo();


        echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=keresEredmeny\" method=\"post\">\n".
        "<div><label>Sportoló:"."<select name=\"felhasznalo\">\n";
        foreach($felhasznalok as $felhasznalo) {
            echo "<option value=\"{$felhasznalo->getID()}\">".$felhasznalo->getNev()."</option>\n";
        }
        echo "</select></label></div>\n";
        echo "<div><label>Év megadása: <input type=\"number\" name=\"ev\" min=\"2000\" max=\"2050\" required></label></div>";

        echo "<div><label>Hónap:"."<select name=\"honap\">\n";
        for($i=1; $i<13;$i++) {
            echo "<option value=\"{$i}\">".$i."</option>\n";
        }
        echo "</select></label></div>\n";

        echo   "<input type=\"submit\" value=\"Keres\" />\n".
               "</form>\n";

        echo "<a href=\"".$_SERVER["PHP_SELF"]."?page=adatLap\">Adatfelvitel.</a></br>";
        echo "<a href=\"".$_SERVER["PHP_SELF"]."?page=statisztika\">Statisztika.</a>";
        

        $this->foot();
    }

    public function keresEredmeny(){
        $this->head();
        if(!empty($_POST)){
        (int)$felhasznalo = filter_input(INPUT_POST, "felhasznalo", FILTER_VALIDATE_INT);
        (int)$ev = filter_input(INPUT_POST, "ev", FILTER_VALIDATE_INT);
        (int)$honap = filter_input(INPUT_POST, "honap", FILTER_VALIDATE_INT);
        $tevekenysegek = $this->db->tevekenysegFelhasznalo($felhasznalo, $ev, $honap );
        if($tevekenysegek==false){
            echo "<p>Nem található sporttevékenység.</p>";
        }else{
            $osszedzes=0;
            $ossztav=0.0;
        
        echo "<h1>".$tevekenysegek[0]->getFelhasznalo()->getNev()."</h1>";
        echo "<table>";
        echo "<tr><th>Tevékenységek</th><th>Megtett távolság</th><th>Év</th><th>Hónap</th><th>Nap</th></tr>";
        
        foreach($tevekenysegek as $tevekenyseg) {
            echo "<tr>\n"."<td>".$tevekenyseg->getTevekenyseg()."</td>";
            echo "<td>".$tevekenyseg->getTavolsag()."</td>";
            echo "<td>".$tevekenyseg->getEv()."</td>";
            echo "<td>".$tevekenyseg->getHonap()."</td>";
            echo "<td>".$tevekenyseg->getNap()."</td>"."</tr>\n";
            $osszedzes++;
            $ossztav=$ossztav+$tevekenyseg->getTavolsag();
      
              
        }       

            echo "</table>";
            echo "<p>Az összes edzések száma: {$osszedzes}  Az összessen megtett távolság: {$ossztav}</p>";
        }
        }
        echo "<a href=\"".$_SERVER["PHP_SELF"]."\">Vissza a főoldalra.</a>";
    


        $this->foot();
    }
    
    public function adatLap(){
        $this->head();
        echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=mentes\" method=\"post\">\n";
        $felhasznalok = $this->db->getSportolo();

        echo "<div><label>Sportoló:"."<select name=\"felhasznalo\">\n";
        foreach($felhasznalok as $felhasznalo) {
            echo "<option value=\"{$felhasznalo->getID()}\">".$felhasznalo->getNev()."</option>\n";
        }
        echo "</select></label></div>\n";

        echo "<div><label>Tevékenység:"."<select name=\"tevekenyseg\">\n";
        
        echo "<option value=\"0\">Futás</option>\n";
        echo "<option value=\"1\">Bringázás</option>\n";
        echo "<option value=\"2\">Görkorcsolyázás</option>\n";

        
        
        echo "</select></label></div>\n";

        echo "<div><label>Távolság <input type=\"text\" name=\"tavolsag\" required></label></div>";

        


        echo "<div><label>Év megadása: <input type=\"number\" name=\"ev\" min=\"2000\" max=\"2050\" value=\"".date('Y')."\" required></label></div>";

        echo "<div><label>Hónap:"."<select name=\"honap\">\n";

        $h=date('n');
        $n=date('d');
        for($i=1; $i<13;$i++) {
            if($i==$h){
            echo "<option value=\"{$i}\" selected>".$i."</option>\n";

            }else{
            echo "<option value=\"{$i}\">".$i."</option>\n";
            }
        }
        echo "</select></label></div>\n";

        echo "<div><label>Nap:"."<select name=\"nap\">\n";
        for($i=1; $i<32;$i++) {
            if($i==$n){
            echo "<option value=\"{$i}\" selected>".$i."</option>\n";
        }else{
            echo "<option value=\"{$i}\">".$i."</option>\n";

        }
        }
        echo "</select></label></div>\n";

        echo   "<input type=\"submit\" value=\"Mentes\" />\n".
               "</form>\n";
         echo "<a href=\"".$_SERVER["PHP_SELF"]."\">Vissza a főoldalra.</a>";
        

        $this->foot();
    }
    public function mentes(){
        $this->head();
        $jo=$this->db->add($_POST);
        if($jo){
            echo "<p>Sikeres új adatfelvétel.</p>";
        }
        else{
            echo "<p>Sikertelen.</p>";

        }
        echo "<a href=\"".$_SERVER["PHP_SELF"]."?page=adatLap\">Vissza az adatfelvitel.</a></br>";
        
        $this->foot();
    }

    public function statisztika(){
        $this->head();
        $sportDB = [
            "Futás" => 0,
            "Bringázás" => 0,
            "Görkorcsolyázás" => 0
        ];
        $sportTavolsag = [
            "Futás" => 0,
            "Bringázás" => 0,
            "Görkorcsolyázás" => 0
        ];
        $sportok = $this->db->tevekenysegSportok();

        foreach($sportok as $sport){
            if($sport->getTevekenyseg()=="Futás"){
                $sportDB["Futás"]=$sportDB["Futás"]+1;
                $sportTavolsag["Futás"]=$sportTavolsag["Futás"]+$sport->getTavolsag();

            }else if($sport->getTevekenyseg()=="Bringázás"){
                $sportDB["Bringázás"]=$sportDB["Bringázás"]+1;
                $sportTavolsag["Bringázás"]=$sportTavolsag["Bringázás"]+$sport->getTavolsag();

            } else{
                $sportDB["Görkorcsolyázás"]=$sportDB["Görkorcsolyázás"]+1;
                $sportTavolsag["Görkorcsolyázás"]=$sportTavolsag["Görkorcsolyázás"]+$sport->getTavolsag();


            }
        }

        echo "<table>";
        echo "<tr><th></th><th>Összes edzés</th><th>Összessen megtett távolság</th></tr>";
        
        foreach($sportDB as $kulcs=>$érték) {
            echo "<tr>\n"."<td>".$kulcs."</td>";
            echo "<td>".$érték."</td>";
            echo "<td>".$sportTavolsag[$kulcs]."</td>".
            "</tr>\n";
         }       

            echo "</table>";
        echo "<a href=\"".$_SERVER["PHP_SELF"]."\">Vissza.</a>";

        
        $this->foot();
    }






}