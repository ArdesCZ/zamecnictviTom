<?php

/*
 * do common.neon napsat pod services:
  - App\Model\DatabazeManager cesta k modelu složka app/podsložka Model\ název modelu
 * */

namespace App\Model;

use Nette;
use Nette\Database\Context; // použití nette databáze

class DatabazeManager
{
    use Nette\SmartObject;

    private $database;

    /**
     * metoda, která se stará o načtení dat pro připojení do databáze ze souboru config/local.neon a připojí se k databázi
     */
    public function __construct(Context $database)
    {
        $this->database = $database;
    }

    /**
     * metoda která vrací výpis z databázové tabulky
     * parametr funkce je název tabulky
     */
    public function vypisZTabulky($tabulka)
    {
        $query = $this->database->table($tabulka);
        return $query;
    }

    public function vlozeniDoTabulky($tabulka, $sloupec, $hodnota)
    {
        $query = $this->database->query("INSERT INTO $tabulka", [
            $sloupec => $hodnota,
        ]);

        return $query;
    }

    public function hledejHodnoty($selekce, $tabulka, $sloupec, $hodnota)
    {
        $query = $this->database->query("SELECT $selekce FROM $tabulka WHERE $sloupec = ?", "$hodnota");
        return $query;
    }

    public function vymazVTabulce($tabulka, $sloupec, $hodnota)
    {
        $query = $this->database->query("DELETE FROM $tabulka WHERE $sloupec = ?", $hodnota);
        return $query;
    }
}