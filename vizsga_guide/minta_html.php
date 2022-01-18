<?php
    echo "<form action=\"".$_SERVER["PHP_SELF"]."\" method=\"post\">";

    //legördülő lista
    echo "<select name=\"erendez\">";
    echo "<option></option>";
    echo "<option value=\"novekvo\" >&uarr;</option>";
    echo "<option value=\"csokkeno\" >&darr;</option>";
    echo "</select>";

    //input text 
    echo "<div><label>Név: <input type=\"text\" name=\"eszures\" ></label></div>";

    //input number
    echo "<div><label>Szám: <input type=\"number\" name=\"eszures\" ></label></div>";

    //input date
    echo "<label>Érkezés: <input type=\"date\" name=\"erkez\"". 
                "value=\"".date("Y-m-d")."\" min=\"".date("Y-m-d")."\" ></label>";

     //rádiógombok
     foreach($szallashely as $kulcs=>$szallas){
          if(array_key_first($szallashely)==$kulcs){
              echo "<input type=\"radio\" name=\"szallashely\" value=\"".$szallas->getID()."\" checked>".
              "<label>".$szallas->getNev()."</label><br>";
          
          }else{
          echo "<input type=\"radio\" name=\"szallashely\" value=\"".$szallas->getID()."\">".
              "<label>".$szallas->getNev()."</label><br>";
          }
      }


    //table 
    echo "<table>";
    echo "<tr><th>Sorszám </th><th>Dal Cím </th><th>Hossz </th></tr>";
    
    echo "<tr>\n";
    echo "<td>"."Tartalom"."</td>". 
         "<td>"."Tartalom"."</td>". 
         "<td>"."Tartalom"."</td>";
    echo "</tr>";

    echo "</table>";
    
    //checkbox
    echo "<input type=\"checkbox\" name=\"asd\"  value=\"as\" >";
    echo "<input type=\"checkbox\" name=\"ads\"  value=\"sa\" >";

    //hidden
    echo "<input type=\"hidden\" value=\"hidden értték\" name=\"hiddenname\"/>\n";

    //submit
    echo "<input type=\"submit\" value=\"Mentés\" />\n"."</form>";

    //vissza link
    echo "<a href=\"".$_SERVER["PHP_SELF"]."\">Vissza a főoldalra.</a>";

    //getátküldés
    //<a href=\"".$_SERVER["PHP_SELF"]."?page=szoveg"."&id=".$dal->getAlbum_id()."&sorszam=".$dal->getSorszam()."\">".$dal->getCim()."</a>
     

    //visszaegy lappal
    echo "<form name=back action=\"javascript:history.go(-1)()\" method=post>";
    echo "<input type=submit value=\"Go Back\">";

    
     //image
     echo "<a href=\"".$_SERVER["PHP_SELF"]."\"><img src=\"".$album->getKis_borito()."\" alt=\"Plakát\" width=\"30\"/></a>\n";

     //oldalújratöltés POST törléshez
     echo "<meta http-equiv='refresh' content='0'>";

     //pötty nélküli számozatlan lista
     echo "<ul style=\"list-style-type: none\">".
     "<li></li>".
     "</ul>";





    
