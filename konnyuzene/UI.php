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
            <tiltle>KÖNNYŰZENE</tiltle>
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

    public function albumtabla(){
        $this->head();
        echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\"><table>";
        echo "<tr><th>Előadó <select name=\"erendez\">".
            "<option></option>".
             "<option value=\"novekvo\" >&uarr;</option>".
             "<option value=\"csokkeno\" >&darr;</option></select>";
        echo "<div> <input type=\"text\" name=\"eszures\" ></div>";     
        echo "</th><th>Album ".
             "<select name=\"arendez\">".
             "<option></option>".
             "<option value=\"novekvo\" >&uarr;</option>".
             "<option value=\"csokkeno\" >&darr;</option></select>";
        echo "<div> <input type=\"text\" name=\"aszures\" ></div>";     
             
        
        "</th><th>Kiadás éve</th></tr>";
        if(!empty($_POST)){
            $szures_eloado = filter_input(INPUT_POST, "eszures", FILTER_SANITIZE_STRING);
            $szures_cim = filter_input(INPUT_POST, "aszures", FILTER_SANITIZE_STRING);
            //if($szures_eloado!=""){
            $albumok = $this->db->getAlbum($szures_eloado, $szures_cim);
            /*}
            else{
            $albumok = $this->db->getAlbum();
            }*/
        }else{
        $albumok = $this->db->getAlbum();

        }

        if(!empty($_POST)){
            print_r($_POST);
            $ertek = filter_input(INPUT_POST, "erendez", FILTER_SANITIZE_STRING);
            $ertek1 = filter_input(INPUT_POST, "arendez", FILTER_SANITIZE_STRING);
            
            

            echo $ertek1;
            if($ertek!=""){
                if($ertek=="csokkeno"){                
                    usort($albumok, function($a, $b) {return strcmp($b->getEloado()->getNev(),$a->getEloado()->getNev());});
                }
                else{
                    usort($albumok, function($a, $b) {return strcmp($a->getEloado()->getNev(),$b->getEloado()->getNev());});
                }
            }
            if($ertek1!=""){
                if($ertek1=="csokkeno"){   
                                
                    usort($albumok, function($a, $b) {return strcmp($b->getCim(),$a->getCim());});
                }
                else{
                    usort($albumok, function($a, $b) {return strcmp($a->getCim(),$b->getCim());});
        
                }
            }
        }

        else{
            usort($albumok, function($a, $b) {return strcmp($a->getEloado()->getNev(),$b->getEloado()->getNev());});

        }

        
        foreach($albumok as $album) {
            echo "<tr>\n".
                "<td>".$album->getEloado()->getNev()."</td>".
                "<td><a href=\"".$_SERVER["PHP_SELF"]."?page=dal"."&id=".$album->getID()."\">".$album->getCim()."</a></td>".
                "<td>".$album->getKiadas_eve()."</td>". 
                
                "</tr>\n";
      
              
        }


        echo "</table>".
             "<input type=\"submit\" value=\"Frissít\" />\n"."</form>";



        $this->foot();

    }

    public function dal(string $id){
        
        $this->head();
        echo "<table>";
        echo "<tr><th>Sorszám </th><th>Dal Cím </th><th>Hossz </th></tr>";
        
        foreach($this->db->getDalok($id) as $dal) {
            echo "<tr>\n".
                
                "<td>".$dal->getSorszam()."</td>";
                if(($dal->getSzoveg())!=null){
                   echo "<td><a href=\"".$_SERVER["PHP_SELF"]."?page=szoveg"."&id=".$dal->getAlbum_id()."&sorszam=".$dal->getSorszam()."\">".$dal->getCim()."</a></td>"; 
                }
                else{
                    echo "<td>".$dal->getCim()."</td>";
                }
            
            echo "<td>".$dal->getHossz()."</td>". 
                
                "</tr>\n";
      
              
        }
        

        echo "</table>";
        $album =$this->db->getBoritok($id);
        if($album->getKis_borito()!=null &&$album->getNagy_borito()!=null ){
            echo "<a href=\"".$_SERVER["PHP_SELF"]."\"><img src=\"".$album->getKis_borito()."\" alt=\"Kisborito\" /></a>\n";
       }else  
       if($album->getKis_borito()){
             echo "<img src=\"".$album->getKis_borito()."\" alt=\"Kisborito\" />\n";
        }
        
        echo "<a href=\"".$_SERVER["PHP_SELF"]."\">Vissza a főoldalra.</a>";


        $this->foot();
    }

    public function szoveg($id,$sorszam){
        $this->head();
        $dal= $this->db->getSzoveg($id,$sorszam);
        echo "<p>".$dal->getEloado()->getNev()."</p>";
        echo "<p>".$dal->getCim()."</p>";
         
        echo "<p>".$dal->getSzoveg()."</p>";
        
        echo "<a href=\"".$_SERVER["PHP_SELF"]."?page=dal"."&id=".$dal->getAlbum_id()."\">Vissza az albumba.</a>";
        $this->foot();
    }




}