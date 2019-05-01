<?php
session_start();
mb_internal_encoding("UTF-8");

function autoloadFunkce($trida)
{
        // Končí název třídy řetězcem "Kontroler" ?
        if (preg_match('/Kontroler$/', $trida))
                require("kontrolery/" . $trida . ".php");
        else
                require("modely/" . $trida . ".php");
}
spl_autoload_register("autoloadFunkce");
// Připojení k databázi
Db::pripoj("sql2.webzdarma.cz", "evidencewzsk0356", "Oluska20", "evidencewzsk0356");
$smerovac = new SmerovacKontroler();
$smerovac->zpracuj(array($_SERVER['REQUEST_URI']));
$smerovac->vypisPohled();
?> 
