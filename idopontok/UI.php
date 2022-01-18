<?php
declare(strict_types=1);

class UI{
    private $idopontok;

    public function __construct(Idopont $idopontok)
    {
        $this->idopontok = $idopontok;       
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

    $this->foot();
}


}
