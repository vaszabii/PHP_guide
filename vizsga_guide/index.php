<?php
declare(strict_types=1);// ez miért kell?

function elolab (){
echo <<<END
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<p>Hello</p>
END;
}



function foot(){
    echo <<<END
     </body>
     </html>
END;
}


elolab();

$tomb0=['Alma','Körte','Barack'];

echo isset($tomb0[2])?'Van':'Nincs';

print_r( array_keys($tomb0));


/*$myfile=fopen("torolni.txt","a") or die ("Nem sikerült megnyitni ezt a fájlt.");
$tomb=["Ezt","Meg ezt","Meg ezt is"];
$sor="";

foreach($tomb as $elem){
    fwrite($myfile,$elem."; ");

}*/


/*if($myfile){
$tomb=explode("\n",fread($myfile,filesize("szoveg.txt")));
}


while(!feof($myfile)){
    $sor=fgets($myfile);
    $tombebelso=explode(";",$sor);
    $tomb[]=$tombebelso;
}
*/
echo "<form action=\"".$_SERVER["PHP_SELF"]." \" enctype=\"multipart/form-data\" method=\"post\">";
echo "<input type=\"file\" name=\"fajl\" id=\"fajl\" accept=\"image/jpg\" required>";
echo "<input type=\"submit\" name=\"submit\" value=\"Feltoltes\">";
if(isset($_POST['submit'])){

    move_uploaded_file($_FILES["fajl"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/PHP/minta_hasznos/".$_FILES["fajl"]["name"]);
    $kepnev=$_FILES["fajl"]["name"];
}


//fclose($myfile);
foot();






?>
 
    



