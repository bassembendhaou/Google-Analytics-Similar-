<?php

namespace App\Repositories;

use App\Classes\QueryConfig;
use App\Models\Visit;
use Illuminate\Support\Facades\Log;

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
}
