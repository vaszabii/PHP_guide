<?php 
    declare(strict_types=1);
    define("FAJL", "mozi.dat");
    define("SOROK", 20);
    define("OSZLOPOK", 10);
    
    function megnyit(string $file) : array {
        $t = [];
        $f = @fopen($file, 'r');
        if($f === false) {
            for($s=0; $s<SOROK; $s++) {
                $sor = [];
                for($o=0; $o<OSZLOPOK; $o++) {
                    $sor[] = false;
                }
                $t[] = $sor;
            }
        } else {
            $t = unserialize(fread($f, 8192));
            fclose($f);
        }
        return $t;
    }
    
    function ment(string $file, array $mtx) {
        $f = fopen($file, 'w');
        if($f !== false) {
            fwrite($f, serialize($mtx));
            fclose($f);
        }
    }
    
    function rajzol(array $mtx) {
        echo "<table>\n";
        echo "\t<tr><td></td>";
        for($o=0; $o<OSZLOPOK; $o++) {
            echo "<th>".($o+1)."</th>";
        }
        echo "</tr>\n";
        for($s=0; $s<SOROK; $s++) {
            echo "\t<tr><th>".(chr($s+ord('A')))."</th>";
            for($o=0; $o<OSZLOPOK; $o++) {
                echo "<td>".($mtx[$s][$o]?"X":"<input type=\"checkbox\" name=\"$s-$o\">")."</td>";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    }
    
    function ujadat(&$mtx) : string {
      $nev = filter_input(INPUT_POST, "nev", FILTER_SANITIZE_STRING);
      if($nev !== false) {
        $utkozes = false;
        $nevek = [];
        $regExp = array("options" => array("regexp" => '/^\d+-\d+$/'));
        foreach ($_POST as $kulcs => $ertek) {
          $szek = filter_var($kulcs, FILTER_VALIDATE_REGEXP, $regExp);
          if($szek !== false) {
            $szek = explode('-', $szek);
            if($mtx[$szek[0]][$szek[1]] !== false) {
              $utkozes = true;
              $nevek[] = chr($szek[0]+ord('A')).($szek[1]+1).
                ": ".$mtx[$szek[0]][$szek[1]];
            }
          }
        }
        if($utkozes) {
          return "<p>Sajnos néhány szék már foglalt:</p><ul><li>".
            implode("</li><li>", $nevek)."</li></ul>";
        } else {
          foreach ($_POST as $kulcs => $ertek) {
            $szek = filter_var($kulcs, FILTER_VALIDATE_REGEXP, $regExp);
            if($szek !== false) {
              $szek = explode('-', $szek);
              $mtx[$szek[0]][$szek[1]] = $nev;
            }
          }
        }
      }
      return "";
    }
    
    $nezoter = megnyit(FAJL);
?>
<!DOCTYPE html>
<head>
    <title>Mozi</title>
    <!-- <link rel="stylesheet" type="text/css" href="stilus.css"> -->
    <meta charset="utf-8" />
</head>
<body>
    <h1>Mozijegy vásárlás</h1>
    <?php echo ujadat($nezoter); ment(FAJL, $nezoter); ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div><label>Név: <input type="text" name="nev" required></label></div>
    <?php rajzol($nezoter); ?>
        <div><input type="submit" value="Küldés"></div>
    </form>
</body>
</html>
