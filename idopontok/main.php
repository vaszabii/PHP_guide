<?php
declare(strict_types=1);
define("FILENAME", "data.dat");



spl_autoload_register(function ($name){
    require_once("$name.php");
    
});
function head(){
    echo <<<END
<!DOCTYPE html>
<html lang="en_US">
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>

END;
}
head();

function kiiratas(array &$idopontok=null){

    echo "<table>";
    echo "<tr><th>Név</th><th>H</th><th>K</th><th>Sz</th><th>Cs</th><th>P</th></tr>";
    
    if($idopontok!=null){
    foreach($idopontok as $idopont){
        echo "<tr>\n";
        echo "<td>"."<input type=\"text\" name=\"nev\" value=\"".$idopont->getNev()."\" disabled>"."</td>";
            foreach($idopont->getNapok() as $nap){
                if($nap==true){
                    echo "<td>"."<input type=\"checkbox\" name=\"h\"value=\"Yes\" checked disabled >"."</td>";
                }
                else{
                    echo "<td>"."<input type=\"checkbox\" name=\"h\"value=\"Yes\"  disabled >"."</td>";

                }
            } 
             
        echo "</tr>";
    }
}
echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">";

    echo "<tr>\n";
    echo "<td>"."<input type=\"text\" name=\"nev\" pattern=\"[a-zA-Z]+[a-zA-Z\s]+\">"."</td>". 
         "<td>"."<input type=\"checkbox\" name=\"h\"value=\"Yes\"  >"."</td>". 
         "<td>"."<input type=\"checkbox\" name=\"k\" value=\"Yes\" >"."</td>". 
         "<td>"."<input type=\"checkbox\" name=\"sz\" value=\"Yes\" >"."</td>". 
         "<td>"."<input type=\"checkbox\" name=\"cs\" value=\"Yes\" >"."</td>". 
         "<td>"."<input type=\"checkbox\" name=\"p\" value=\"Yes\" >"."</td>";
    echo "</tr>";

    if($idopontok!=null){
    $ertekb=["h"=>true, "k"=>true, "sz"=>true, "cs"=>true, "p"=>true];

    foreach($idopontok as $idopont){
        foreach($idopont->getNapok() as $kulcs=>$nap){
            if($nap==false){
                $ertekb[$kulcs]=false;
            }
        }
    }   
    
    echo "<tr>\n";
        echo "<td>Eredmények</td>";
            foreach($ertekb as $nap){
                if($nap==true){
                    echo "<td>X</td>";
                }
                else{
                    echo "<td> </td>";

                }
            } 
             
        echo "</tr>";
        echo "</br>";
    }
    echo "</table>";

        echo "<input type=\"submit\" value=\"Mentés\" />\n"."</form>";
    


}


if(($file = file_get_contents(FILENAME)) === false) {
   $idopontok=null; 

} 
else{
    $idopontok = unserialize($file);
}
if(!empty($_POST)){
    $nev = filter_input(INPUT_POST, "nev",FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/^[a-zA-Z]+[a-zA-Z\s]$/i']]);
    $i=0;
    $jonev=true;
    
    $ertekb=["h"=>false, "k"=>false, "sz"=>false, "cs"=>false, "p"=>false];
    if($nev==""){
        $jonev=true;
    }
    foreach ($idopontok as $idopont){
        if($idopont->getNev()==$nev){
            $jonev=false;
        }
    }
    if($jonev==true){
        foreach($_POST as $kulcs =>$ertek){
            if($ertek=="Yes"){
                $ertekb["$kulcs"]=true;
            }
        }
        $idopontok[] = new Idopont($nev,$ertekb);

    }
    else{
        echo "Rossz név vagy nem adtál meg nevet, esetleg már tartozik egy ilyen névhez időpont";
    }
    

}
kiiratas($idopontok);
file_put_contents(FILENAME, serialize($idopontok));
 


 function foot(){
    echo <<<END
    </body>
</html>
END;    
}

foot();

