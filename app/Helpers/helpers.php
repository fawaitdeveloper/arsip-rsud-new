<?php

function random_color_part()
{
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color()
{
    return random_color_part() . random_color_part() . random_color_part();
}


function getFirstCharacterUser()
{
    return strtoupper(substr(auth()->user()->name, 0, 1));
}

function getPath()
{
    $path = request()->path();

    $explode = join(" ", explode("-", join(" | ", explode("/", $path))));

    return $explode;
}

function formatDateToID($date)
{
    $month = [
        "Jan" => "Januari",
        "Feb" => "Februari",
        "Mar" => "Maret",
        "Apr" => "April",
        "May" => "Mei",
        "Jun" => "Juni",
        "Jul" => "Juli",
        "Aug" => "Agustus",
        "Sep" => "September",
        "Oct" => "Oktober",
        "Nov" => "November",
        "Dec" => "Desember",
    ];

    $m = date("M", strtotime($date));
    $d = date("d", strtotime($date));
    $y = date("Y", strtotime($date));

    $m = $month[$m];

    return $d . " " . $m . " " . $y;
}
