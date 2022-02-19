<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;
use ReflectionException;
use ReflectionMethod;

/**
 * Trait ApplyQueryScopes
 * @package App\Traits
 */
trait ApplyQueryScopes
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Model
     */
    protected $query;

    /**
     * @param array $filters
     * @param $query
     * @param null $tableAlias
     */
    public static function applyFilters(array $filters,$query,$tableAlias = null)
    {
        $self = new self();

        if ($tableAlias) {
            $self->setTable($tableAlias);
        }

        foreach ($filters as $filterName => $parameters) {
            if (self::isValidFilter($filterName)) {

                try {
                    $method = new ReflectionMethod($self, 'scope' . Str::studly($filterName));
                } catch (ReflectionException $e) {
                    $self->{'scope'.Str::studly($filterName)}($query, $parameters);
                    continue;
                }

                if ($method->getNumberOfParameters() == 2) {
                    $self->{'scope'.Str::studly($filterName)}($query, $parameters);
                    continue;
                }

                call_user_func_array([$self,'scope'.Str::studly($filterName)], array_merge([$query],(array) $parameters));
            }
        }
    }

    /**
     * @param $filterName
     * @return bool
     */
    private static function isValidFilter($filterName)
    {
        return method_exists(get_called_class(),'scope'.Str::studly($filterName));
    }
}
