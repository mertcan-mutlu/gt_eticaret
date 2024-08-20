<?php
function tarih() {
    date_default_timezone_set('Europe/Istanbul'); 
    $aylar = [
        1 => 'Ocak',
        2 => 'Şubat',
        3 => 'Mart',
        4 => 'Nisan',
        5 => 'Mayıs',
        6 => 'Haziran',
        7 => 'Temmuz',
        8 => 'Ağustos',
        9 => 'Eylül',
        10 => 'Ekim',
        11 => 'Kasım',
        12 => 'Aralık'
    ];

    $gunler = [
        'Pazar',
        'Pazartesi',
        'Salı',
        'Çarşamba',
        'Perşembe',
        'Cuma',
        'Cumartesi'
    ];

    $tarih = date("j ") . $aylar[date("n")] . date(" Y");
    $gun_ismi = $gunler[date("w")];
    return $tarih . ", " . $gun_ismi;
}

?>
