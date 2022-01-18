<?php
declare(strict_types=1);
//scandirhez
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
    //validate intervallum
    (float)$magassagny = filter_input(INPUT_POST, "magny", FILTER_VALIDATE_FLOAT, array("options" => array("min_range"=>0, "max_range"=>10)));
    (float)$magassagny = filter_input(INPUT_POST, "magny", FILTER_VALIDATE_FLOAT, ["options" => ["min_range"=>0, "max_range"=>10]]);
    $time = filter_input(INPUT_POST, "test", FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);


    //validate regexp
    $neptun = filter_input(INPUT_POST, "neptun", FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/^[a-z0-9]{6}$/i']]);
    $nev = filter_input(INPUT_POST, "nev",FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => '/^[a-zA-Z]+[a-zA-Z\s]$/i']]);


    //post
    $erkez = filter_input(INPUT_POST, "erkez", FILTER_SANITIZE_STRING);
    (int)$szallas_id = filter_input(INPUT_POST, "szallashely", FILTER_VALIDATE_INT);
    $szobaszel=(float)filter_input(INPUT_POST,"szelesseg",FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    $szobahossz=(float)filter_input(INPUT_POST,"hosszusag",FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    $szobamag=(float)filter_input(INPUT_POST,"magassag",FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    if(filter_has_var(INPUT_POST, "pont")&&filter_has_var(INPUT_POST, "id")){
        (int)$pont = filter_input(INPUT_POST, "pont", FILTER_VALIDATE_INT);
        (int)$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
         
    
    }else if(filter_has_var(INPUT_POST, "megjelenit")){
        (int)$megjelenit = filter_input(INPUT_POST, "megjelenit", FILTER_VALIDATE_INT);

    }
    //serialize POST-oláshoz
    echo "<input type=\"hidden\" value=\"".base64_encode(serialize($szoba))."\" name=\"szoba\"/>\n";
    //unserialize
    $szoba=unserialize(base64_decode($_POST["szoba"]));


    //tömb JSON 
    echo "<input type=\"hidden\" value=\"".base64_encode(json_encode($szoba))."\" name=\"szoba\"/>\n";
    //JSON decode
    $szoba=json_decode(base64_decode($_POST["szoba"]),true);



    //rendezés
    usort($targyak, function($a, $b) {return strcmp($a->getMegnevezes(),$b->getMegnevezes());});

    //kepmentes
    echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=mentes\" enctype=\"multipart/form-data\" method=\"post\">";

    if(array_key_exists("kep", $_FILES)){
        move_uploaded_file($_FILES["kep"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/mozifilmek/".$_FILES["kep"]["name"]);
        $kepnev=$_FILES["kep"]["name"];
    }

    //scandir -képek betöltése a mappából    
    $files = scandir($_SERVER[' DOCUMENT_ROOT'].'/szallas');   
    foreach($files as $file){
        $elso=substr($file, 0,1);
            if($elso==(string)$szallas_id)
            {
                echo "<a  href=\"".$_SERVER["PHP_SELF"]."?page=kep"."&id=".$file."\">". 
                "<img src=\"".$file."\" alt=\"".$file."\" style=\"width:150px;\">".
                "</a>";
            }
    }

    //képfeltöltés, fájlfeltöltés
    echo "<form action=\"".$_SERVER["PHP_SELF"]."?page=mentes\" enctype=\"multipart/form-data\" method=\"post\">";
    echo "<div><label>Plakát: <input type=\"file\" name=\"kep\" id=\"kep\" accept=\"image/jpg\" required></label></div>";

    if(array_key_exists("kep", $_FILES)){
        move_uploaded_file($_FILES["kep"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/mozifilmek/".$_FILES["kep"]["name"]);
        $kepnev=$_FILES["kep"]["name"];
    }

    //explode
    $erkezh=explode("-",$erkez);
    //strtotime
    $a=strtotime($tavoz);
        $b=strtotime($erkez);
        $nap = ($a-$b) / 86400;

    //image
    echo "<a href=\"".$_SERVER["PHP_SELF"]."\"><img src=\"".$album->getKis_borito()."\" alt=\"Kisborito\" /></a>\n";

    //oldal direct betöltése
    header("Location: ".$_SERVER["PHP_SELF"]);
    //oldal direct betöltése ugyanazzal a POST-al
    header('HTTP/1.1 307 Temporary Redirect');        
    header("Location: ".$_SERVER["PHP_SELF"]);


    //tömb valahányadik elemétől valamennyi elemet kitörölni
    array_splice($eddigi_id_t,$i,1);
    
    //tömbből random elem
    $feladvany=$feladvanyok[array_rand($feladvanyok,1)];  
    
    //stringből levágás, multiple byte figyelembe vételével
    $utolso=mb_substr($rosszkarakterlanc, -1);

    //string első karakterének kicsinyítése
    $this->feladvany=lcfirst($feladvany);


    //fájl írás, olvasás
    file_put_contents(FILENAME, serialize($this));
    unserialize(file_get_contents(FILENAME));

    //fájl létrehozása ha nem létezik
    if (!file_exists(FILENAME)) {
        $fajl=fopen(FILENAME, "w");
        fclose($fajl); 
    }

    //tömb sortolása egymással
    array_multisort($szamtomb, SORT_DESC, $keresestomb );

    //magyar locale 
    setlocale(LC_ALL, "hungarian.UTF-8");

    //locale után magyar betűk jó sortolása
    usort($this->betuk, "strcoll");

    //DateTime formázás
    $this->meddig=new DateTime($meddig);
    $szoba->getFoglalas()->getMeddig()->format('Y-m-d');


    //tömb manipulátorok
    next($utvonal);//következő elem
    prev($utvonal);//elöző elem
    key($utvonal);//jelenlegi elem kulcsa
    reset($utvonal);//tömb első eleme
    end($utvonal);//tömb utolsó eleme
    array_key_first($utvonal);//tömb első kulcsa
    array_key_last($utvonal);//tömb utolsó kulcsa
    array_key_exists("box",$utvonal);//van-e egy megadott sztringű kulcs


    //Karakterek helyes kiíratása
    for ($i=0; $i < count($foglaltak); $i++) {
    echo chr(ord('A')+$i);
    }
    $this->foot();
}


}
