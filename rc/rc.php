<?php
function verifyRC($rc)
{
    // "be liberal in what you receive"
    if (!preg_match('#^\s*(\d\d)(\d\d)(\d\d)[ /]*(\d\d\d)(\d?)\s*$#', $rc, $matches)) {
        return FALSE;
    }

    list(, $year, $month, $day, $ext, $c) = $matches;

    // do roku 1954 přidělovaná devítimístná RČ nelze ověřit
    if ($c === '') {
        return $year < 54;
    }

    // kontrolní číslice
    $mod = ($year . $month . $day . $ext) % 11;
    if ($mod === 10) $mod = 0;
    if ($mod !== (int) $c) {
        return FALSE;
    }

    // kontrola data
    $year += $year < 54 ? 2000 : 1900;

    // k měsíci může být připočteno 20, 50 nebo 70
    if ($month > 70 && $year > 2003) $month -= 70;
    elseif ($month > 50) $month -= 50;
    elseif ($month > 20 && $year > 2003) $month -= 20;

    if (!checkdate($month, $day, $year)) {
        return FALSE;
    }

    // cislo je OK
    return TRUE;
}


?>