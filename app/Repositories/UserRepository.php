<?php

namespace App\Repositories;

use App\Classes\QueryConfig;
use App\Models\User;
use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{

    /**
     * @var User
     */
    private $user;


    /**
     * UserRepository constructor.
     * @param User|null $user
     */
    public function __construct(User $user = null)
    {
        $this->user = $user ? $user : new User();
    }


    /**
     * @param QueryConfig $config
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function search(QueryConfig $config)
    {
        $query = User::query();
        User::applyFilters($config->getFilters(), $query);
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
             $this->user->delete();
        } catch (\Exception $e) {
            Log::error("ERROR ON DELETING USER : " . $e->getMessage());
            return false;
        }
        return true;
    }


}
