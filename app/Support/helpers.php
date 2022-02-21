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

/**
 * @param $user_agent
 * @return string
 */
function getBrowserName($userAgent){
    $t = strtolower($userAgent);
    $t = " " . $t;
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;
    elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;
    elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unkown';
}

/**
 * @return mixed
 */
function getDeviceType(){
    $agent = new \Jenssegers\Agent\Agent;
    if($agent->isMobile())
        return \App\Models\Visit::DEVICE_TYPE['SMARTPHONE'];
    if($agent->isDesktop())
        return \App\Models\Visit::DEVICE_TYPE['DESKTOP'];
    if($agent->isTablet())
        return \App\Models\Visit::DEVICE_TYPE['TABLET'];

}
