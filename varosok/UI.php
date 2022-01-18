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
            <tiltle>Varosok</br></tiltle>
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

public function kezdo(){
    $this->head();
    $eddigi_id="";
    $eddigi_id_t=[];
    $count=0;
    if(!empty($_POST))
    {
        print_r($_POST);
        echo "</br>";
        $eddigi_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
        $eddigi_id_t=explode(";",$eddigi_id);
        if(in_array("t",$eddigi_id_t)){
            foreach($_POST as $kulcs=>$ertek){
                for ($i=0; $i < count($eddigi_id_t); $i++) { 
                    if($kulcs==$eddigi_id_t[$i]||$eddigi_id_t[$i]=="t"){
                        array_splice($eddigi_id_t,$i,1);
                    }
                   
                }
            }           
        }
        if(in_array("c",$eddigi_id_t)){
            for ($i=0; $i < count($eddigi_id_t); $i++) { 
                if($eddigi_id_t[$i]=="c"){
                    array_splice($eddigi_id_t,$i,1);
                }
               
            }
            if(count($_POST)==3){
                $cst=[];
                foreach($_POST as $kulcs=>$ertek){
                $cst[]=$kulcs;
                }  
                print_r($cst);
                echo "</br>";
                $eddigi_id_t=array_filter($eddigi_id_t);

                print_r($eddigi_id_t);
                echo "</br>";
                $cs_jo1=false;
                $cs_jo2=false;
                for($j=0; $j<count($eddigi_id_t);$j++ ){
                    if($eddigi_id_t[$j]==$cst[1]&&$cs_jo1==false)
                    {   
                        $eddigi_id_t[$j]=$cst[2];                        
                        $cs_jo1=true;
                    }else if($eddigi_id_t[$j]==$cst[2]&&$cs_jo2==false){
                        $eddigi_id_t[$j]=$cst[1];
                        $cs_jo2=true;
                    }
                    
                }
            }     
        }
        $eddigi_id="";
        $eddigi_id_t=array_filter($eddigi_id_t);
        
        foreach($eddigi_id_t as $eddig){
            $eddigi_id=$eddigi_id.$eddig.";";
        }
        echo $eddigi_id;
    }
    
    

    echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">";

        echo "<select name=\"id\">";
        echo "<option value=\"".$eddigi_id."t;\" >Törlés</option>";
        echo "<option value=\"".$eddigi_id."c;\" >Csere</option>";
        
        $varosok=$this->db->getVarosok();
        foreach($varosok as $varos){
            $varos_id=(string)$varos->getID();
            if(str_contains($eddigi_id,$varos_id)==false){
                echo "<option value=\"".$eddigi_id.$varos_id.";\" >".$varos->getNev()."</option>";
                $count++;
            }
        }
    if($count==0){
        header('HTTP/1.1 307 Temporary Redirect');
        header("Location: ".$_SERVER["PHP_SELF"]."?page=osszegzes");
    }      
            

        echo "</select>";
    

    echo "<ol>";
  
    for ($i=0; $i < count($eddigi_id_t); $i++) { 
        foreach($varosok as $varos){
            if((string)$varos->getID()==$eddigi_id_t[$i]){
    
            echo "<li>".$varos->getNev()."<input type=\"checkbox\" name=\"".$eddigi_id_t[$i]."\"  value=\"Yes\" >"."</li>";

            }
        }
    }
    echo "</ol>";
    echo "<input type=\"submit\" value=\"Tovább\" />\n"."</form>";

    $this->foot();
}

public function osszegzes(){
    $this->head();
    $eddigi_id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
    $eddigi_id_t=explode(";",$eddigi_id);
    $id2=0;
    $ossztavolsag=0;
    echo "<table>";
    echo "<tr><th>Sorszám </th><th>Város </th><th>Távolság az előző városhoz </th></tr>";
    $varosok=$this->db->getVarosok();    
    for ($i=0; $i < count($eddigi_id_t); $i++) { 
        foreach($varosok as $varos){
            if((string)$varos->getID()==$eddigi_id_t[$i]){                
                foreach($varosok as $varos2){ 
                    if(isset($eddigi_id_t[$i-1])){                   
                        if((string)$varos2->getID()==$eddigi_id_t[$i-1]){
                            $id2=$varos2->getID();
                        }
                    }else{
                        if((string)$varos2->getID()==$eddigi_id_t[(count($eddigi_id_t)-2)]){
                            $id2=$varos2->getID();
                        }
                    }
                   
                }
            //$tavolsag=$this->db->getTavolsag($v);
            echo "<tr>\n";
            echo "<td>".($i+1)."</td>".
                "<td>".$varos->getNev()."</td>";
                
                $tavolsagok=$this->db->getTavolsag((int)$varos->getID(),(int)$id2);
                    foreach($tavolsagok as $tavolsag){
                        echo "<td>".$tavolsag->getTavolsag()."</td>";
                        $ossztavolsag=$ossztavolsag+$tavolsag->getTavolsag();

                    }
               
            echo "</tr>";
            }
        }
    }
 
    echo "<tr><td></td><td>Összessen megtett távolság:</td><td>".$ossztavolsag."</t></tr>";

    echo "</table>";

    $this->foot();
}


}
