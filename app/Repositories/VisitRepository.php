<?php

namespace App\Repositories;

use App\Models\Visit;

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


    public static function search()
    {

    }
}
