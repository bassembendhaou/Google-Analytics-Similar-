<?php

namespace App\Repositories;

use App\Classes\QueryConfig;
use App\Models\Visit;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


/**
 * Class VisitRepository
 * @package App\Repositories
 */
class VisitRepository
{

    /**
     * @var Visit
     */
    private $visit;


    /**
     * VisitRepository constructor.
     * @param Visit|null $visit
     */
    public function __construct(Visit $visit = null)
    {
        $this->visit = $visit ? $visit : new Visit();
    }


    /**
     * @param QueryConfig $config
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function search(QueryConfig $config)
    {
        $query = Visit::query()->with('user');
        Visit::applyFilters($config->getFilters(), $query);
        $query = $query->select($config->getColumns());
        $query = $query->orderBy($config->getOrderBy(), $config->getDirection());
        if (!$config->getPagination())
            return $query->get();
        return $query->paginate($config->getPerPage(), $config->getColumns(), 'page', $config->getPage());
    }


    /**
     * @return bool
     */
    public function delete()
    {
        try {
            $this->visit->delete();
        } catch (\Exception $e) {
            Log::error("ERROR ON DELETING VISIT : " . $e->getMessage());
            return false;
        }
        return true;
    }


    /**
     * @return array
     */
    public static function getVisitsCountEvolutionsLastSevenDays()
    {
        $days = getLastSevenDays();
        foreach ($days as $day){
            $data [] = Visit::query()->filterByCreationDate($day)->count();
        }
        return array_reverse($data);
    }

    /**
     * @return array
     */
    public static function getUniqueVisitsCountEvolutionsLastSevenDays()
    {
        $days = getLastSevenDays();
        foreach ($days as $day){
            $data [] = Visit::query()->filterByCreationDate($day)->get()->groupBy('ip')->count();
        }
        return array_reverse($data);
    }

    /**
     * @return int
     */
    public static function getVisitsCount()
    {
        return Visit::query()->count();
    }

    /**
     * @return int
     */
    public static function getUniqueVisitsCount()
    {
        return Visit::query()->get()->groupBy('ip')->count();
    }


    /**
     * @return array
     */
    public static function getUniqueVisitsPerDevice()
    {
       $nbrVisitsUniqueDesktop = Visit::query()->filterByDeviceType(Visit::DEVICE_TYPE['DESKTOP'])->get()->groupBy('device_type')->count();
       $nbrVisitsUniqueTablet = Visit::query()->filterByDeviceType(Visit::DEVICE_TYPE['TABLET'])->get()->groupBy('ip')->count();
       $nbrVisitsUniqueSmartphone = Visit::query()->filterByDeviceType(Visit::DEVICE_TYPE['SMARTPHONE'])->get()->groupBy('ip')->count();
       return [
           'nbrVisitsUniqueDesktop' => $nbrVisitsUniqueDesktop,
           'nbrVisitsUniqueTablet' => $nbrVisitsUniqueTablet,
           'nbrVisitsUniqueSmartphone' => $nbrVisitsUniqueSmartphone,
       ];
    }


    /**
     * @return int
     */
    public static function getUniqueVisitsPerBrowser()
    {
        return Visit::query()->get()->groupBy('browser')->count();
    }
}
