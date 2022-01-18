<?php
declare(strict_types=1);
define("FILENAME", "libra.dat");

spl_autoload_register(function ($name) {
    require_once("$name.php");
});
$file = file_get_contents(FILENAME);

$konyvtar = null;
if(($file = file_get_contents(FILENAME)) === false) {
    $konyvtar = new Konyvtar();
    $konyvtar->addKonyvek(new Konyv("John Doe", "ABC123", "1234567891234", ["alma"]));
    $konyvtar->addKonyvek(new Konyv("Jane Doe", "DEF456", "1234567891234", ["alma", "körte"]));

} else {
    $konyvtar = unserialize($file);
}

$ui = new UI($konyvtar);
$page = "";
if(filter_has_var(INPUT_GET, "page")) {
    $page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING);
}
$pageList = ["kereses", "eredmeny", "ujkonyv"];
if(in_array($page, $pageList)) {
    $ui->$page();
} else {
    $ui->kereses();
}


file_put_contents(FILENAME, serialize($konyvtar));