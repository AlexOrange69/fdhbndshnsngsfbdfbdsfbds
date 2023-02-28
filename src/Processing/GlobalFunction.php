<?php

namespace App\Processing;

class GlobalFunction
{
    public function convertDateExcel($date, bool $choice): string
    {
        $real_date = ($date-25569)*86400;
        if ($choice == true) {
            $real_date = date("m/Y", $real_date);
        } else {
            $real_date = date("d/m/Y", $real_date);
        }
        return $real_date;
    }

    public function getFormatedDate($mouthSubstraction): String
    {
        $date = getDate();
        $date["mon"] =$date["mon"]-$mouthSubstraction;
        if ($date["mon"] < 10) {
            $month = "0".$date["mon"];
        } else {
            $month = $date["mon"];
        }
        return $month."/".$date["year"];
    }
}
