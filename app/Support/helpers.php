<?php


use Carbon\Carbon;


/**
 * @return array
 */
function getLastSevenDays($timestamp = true)
{
    $i = 0;
    while ($i < 7) {
        $today = Carbon::today();
        $days [] = $timestamp ? $today->subDays($i)->timestamp : $today->subDays($i)->format('d-m-Y');
        $i++;
    }
    return $days;
}
