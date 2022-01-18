<?php
declare(strict_types=1);
$_SERVER['DOCUMENT_ROOT'];

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
                    <tiltle>Szállás</br></tiltle>
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
    public function szallasfoglalas(){
        $this->head();
        echo "<h1>Szállásfoglalás</h1>";
        echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=foglalas\" method=\"post\">\n";
        echo "<label>Érkezés: <input type=\"date\" name=\"erkez\"". 
                "value=\"".date("Y-m-d")."\" min=\"".date("Y-m-d")."\" ></label>";
     echo "<label>Távozás: <input type=\"date\" name=\"tavoz\"". 
                "value=\"".date("Y-m-d")."\" min=\"".date("Y-m-d")."\" ></label>";
        $szallashely= $this->db->getSzallas();
        echo "<p>Válaszz szálláshelyet:</p>";
        $i=0;
        foreach($szallashely as $szallas){
            if($i==0){
                echo "<input type=\"radio\" name=\"szallashely\" value=\"".$szallas->getID()."\" checked>".
                "<label>".$szallas->getNev()."</label><br>";
            
            }else{
            echo "<input type=\"radio\" name=\"szallashely\" value=\"".$szallas->getID()."\">".
                "<label>".$szallas->getNev()."</label><br>";
            }
            $i++;
        }

        echo   "<input type=\"submit\" value=\"Mentes\" />\n".
        "</form>\n";
        $this->foot();
    }

    public function foglalas(){
        $this->head();

        $erkez = filter_input(INPUT_POST, "erkez", FILTER_SANITIZE_STRING);
        $tavoz = filter_input(INPUT_POST, "tavoz", FILTER_SANITIZE_STRING);
        (int)$szallas_id = filter_input(INPUT_POST, "szallashely", FILTER_VALIDATE_INT);
        
        $szallas = $this->db->getSzallas($szallas_id);
        foreach($szallas as $szal)
        {
            echo "<p>Szálláshely neve: ".$szal->getNev()."</p>";
            echo "<p>Szálláshely Leírása: ".$szal->getLeiras()."</p>";
        }

        
        $files = scandir($_SERVER['DOCUMENT_ROOT'].'/szallas');   
        foreach($files as $file){
            $elso=substr($file, 0,1);
                if($elso==(string)$szallas_id)
                {
                    echo "<a  href=\"".$_SERVER["PHP_SELF"]."?page=kep"."&id=".$file."\">". 
                    "<img src=\"".$file."\" alt=\"".$file."\" style=\"width:150px;\">".
                    "</a>";
                }
        }
        //$szobak = $this->db->getSzobak($szallas_id, $erkez, $tavoz);
        $szobak = $this->db->getSzoba($szallas_id);
        $foglalt = $this->db->getFoglalt($szallas_id);
        foreach($foglalt as $f){
            if(!($f->getMettol()>=$tavoz||$f->getMeddig()<=$erkez)){
                foreach($szobak as $s){
                    if($f->getSzoba_id()==$s->getID()){
                        $s->setFerohely(0);
                    }
                }
            }

        }
        $erkezh=explode("-",$erkez);
        $tavozh=explode("-",$tavoz);
        $a=strtotime($tavoz);
        $b=strtotime($erkez);
        $nap = ($a-$b) / 86400;

        $fo=["06","07","08"];
        echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=mentes\" method=\"post\">\n";
        echo "<input type=\"hidden\" name=\"erkez\" value=\"$erkez\" />\n".
        "<input type=\"hidden\" name=\"tavoz\" value=\"$tavoz\" />\n";

        echo "<table>";
        echo "<tr><th>Férőhely  </th><th>Szezonban/ej/fő  </th><th>Szezonon kívül/ej/fő  </th><th>Össz mennyi/éj/fő</th></tr>";
        foreach($szobak as $s){
            if($s->getFerohely()>0){
                echo "<tr><td>".$s->getFerohely()."</td><td>".
                $s->getSzezon()."</td><td>".$s->getKivul()."</td>";
                if(in_array($erkezh[1],$fo)||in_array($tavozh[1],$fo) ){
                    echo "<td>".$s->getSzezon()*$nap."</td>";
                }
                else{ 
                    echo "<td>".$s->getKivul()*$nap."</td>";

                }
                echo "<td><input type=\"checkbox\" name=\"foglal\" value=\"".$s->getID()."\" ></td>";
            }
            echo "</tr>";

        }
        echo "</table>";
        echo   "<input type=\"submit\" value=\"Foglal\" />\n";
        echo "</form>";

        


        echo "<a href=\"".$_SERVER["PHP_SELF"]."\">Vissza a főoldalra.</a>";
        
       

        $this->foot();
        
    }
    public function mentes(){
        $this->head();
        $erkez = filter_input(INPUT_POST, "erkez", FILTER_SANITIZE_STRING);
        $tavoz = filter_input(INPUT_POST, "tavoz", FILTER_SANITIZE_STRING);
        foreach($_POST as $kulcs=> $ertek){
            if($kulcs=="foglal"){
                if($this->db->ujFoglalas((int)$ertek,$erkez,$tavoz)){
                echo "Sikeres szobamentés</br>";}
            }

        }
        echo "<a href=\"".$_SERVER["PHP_SELF"]."\">Vissza a főoldalra.</a>";


        $this->foot();

    }

    public function kep($id){
        $this->head();
        echo "<img src=\"".$id."\" alt=\"".$id."\">";     
       

        echo "<form name=back action=\"javascript:history.go(-1)()\" method=post>";

        echo "<input type=submit value=\"Go Back\">";

        echo "</form>";
        $this->foot();
    }




}