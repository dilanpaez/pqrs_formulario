<?php

function conectarDB(): mysqli 
{

    $db = mysqli_connect('sql.freedb.tech','freedb_dilan_paez','*YF3nbysDc25PD2'
    ,'freedb_dilan_paez');

    if(!$db)
    {

        echo ">Error: No se pudo conectar";
        exit;

    }

    return $db;

}



?>