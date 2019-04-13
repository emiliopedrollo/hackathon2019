<?php

function cpf( $base = null, $dotted = false ) {
    if (strlen($base) == 9 and is_numeric($base))
    {
        $base = str_split($base);
    } else {
        $base[0] = rand( 0, 9 );
        $base[1] = rand( 0, 9 );
        $base[2] = rand( 0, 9 );
        $base[3] = rand( 0, 9 );
        $base[4] = rand( 0, 9 );
        $base[5] = rand( 0, 9 );
        $base[6] = rand( 0, 9 );
        $base[7] = rand( 0, 9 );
        $base[8] = rand( 0, 9 );
    }

    $d1 = $base[8] * 2 + $base[7] * 3 + $base[6] * 4 + $base[5] * 5 + $base[4] * 6 + $base[3] * 7 + $base[2] * 8 + $base[1] * 9 + $base[0] * 10;
    $d1 = 11 - ( $d1 % 11 );
    if ( $d1 >= 10 ) {
        $d1 = 0;
    }
    $d2 = $d1 * 2 + $base[8] * 3 + $base[7] * 4 + $base[6] * 5 + $base[5] * 6 + $base[4] * 7 + $base[3] * 8 + $base[2] * 9 + $base[1] * 10 + $base[0] * 11;
    $d2 = 11 - ( $d2 % 11 );
    if ( $d2 >= 10 ) {
        $d2 = 0;
    }
    if ( $dotted ) {
        return $base[0] . $base[1] . $base[2] . "." . $base[3] . $base[4] . $base[5] . "." . $base[6] . $base[7] . $base[8] . "-" . $d1 . $d2;
    }
    return $base[0] . $base[1] . $base[2] . $base[3] . $base[4] . $base[5] . $base[6] . $base[7] . $base[8] . $d1 . $d2;
}