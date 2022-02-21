<?php


namespace App\Http\Middleware;


use App\Repositories\VisitRepository;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Stevebauman\Location\Location;

/**
 * Class VisitCount
 * @package App\Http\Middleware
 */
class VisitCount extends Middleware
{


    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $attributes = [
            'device_type' => getDeviceType(),
            'browser' => getBrowserName($request->header('User-Agent')),
            'ip' => $request->ip(),
            // This package can't detect local IP address country  so I choose to put this IP staticly
            'country' => \Location::get('41.231.233.152')->countryName,
            'user_agent' => $request->header('User-Agent'),
            'url' => $request->url()
        ];
        $visitRepository = new VisitRepository();
        $visitRepository->create($attributes);
        return $next($request);
    }
}
