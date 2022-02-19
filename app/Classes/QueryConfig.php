<?php


namespace App\Repositories;


class QueryConfig
{

    /**
     * Paginate page number
     * @var int
     */
    protected $page = 1;

    /**
     * Filters
     * @var array
     */
    protected $filters = [];

    /**
     * Selected Columns
     * @var array
     */
    protected $columns = [];


    /**
     * Order by Column
     * @var string
     */
    protected $orderBy;

    /**
     * Order by Direction
     * @var
     */
    protected $direction;


    /**
     * Per page
     * @var
     */
    protected $perPage;


    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param $filter
     * @param null $default
     * @return mixed
     */
    public function getFilter($filter, $default = null)
    {
        if (isset($this->filters[$filter]))
            return $this->filters[$filter];
        return $default;
    }

    /**
     * @param array $filters
     * @return QueryConfig
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @param $filter
     * @param $value
     * @return mixed
     */
    public function setFilter($filter, $value)
    {
        $this->filters[$filter] = $value;
        return $this;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function addFilters($filters)
    {
        $this->filters = array_merge($this->filters, $filters);
        return $this;
    }

    /**
     * @param array $default
     * @return array
     */
    public function getColumns($default = [])
    {
        if ($this->columns)
            return $this->columns;
        return $default;
    }

    /**
     * @param array $columns
     * @return QueryConfig
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;
        return $this;
    }


    /**
     * @param string|array $default
     * @return mixed
     */
    public function getOrderBy($default = null)
    {
        return $this->orderBy ? $this->orderBy : $default;
    }

    /**
     * @param mixed $orderBy
     * @return QueryConfig
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param null $default
     * @return mixed
     */
    public function getDirection($default = null)
    {
        return $this->direction ? $this->direction : $default;
    }

    /**
     * @param mixed $direction
     * @return QueryConfig
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        if (!$this->perPage) {
            return config('constants.DEFAULT_PER_PAGE');
        }
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return $this
     */
    public function setPerPage(int $perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return QueryConfig
     */
    public function setPage(int $page)
    {
        $this->page = $page;
        return $this;
    }

}
