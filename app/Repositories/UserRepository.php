<?php

namespace App\Repositories;

use App\Models\User;

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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function search(QueryConfig $config)
    {
        $query = User::query()->whereHas('visits');
        User::applyFilters($config->getFilters(),$query);
        $query = $query->orderBy($config->getOrderBy(), $config->getDirection());
        return $query->paginate($config->getPerPage(), $config->getColumns(), 'page', $config->getPage());
    }
}
