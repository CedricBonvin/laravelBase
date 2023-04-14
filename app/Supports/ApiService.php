<?php

namespace App\Supports;

use Spatie\QueryBuilder\QueryBuilder;

class ApiService
{
    protected string $classname;

    protected array $filters;

    protected array $includes;

    protected array $sorts;


    public function __construct(string $classname, array $filters = [], array $includes = [], array $sorts = [])
    {
        $this->classname = $classname;

        $this->filters = $filters;
        $this->includes = $includes;
        $this->sorts = $sorts;

        if (count($this->filters) <= 0) {
            $this->filters = $this->classname::getFilters();
        }

        if (count($this->includes) <= 0) {
            $this->includes = $this->classname::getIncludes();
        }

        if (count($this->sorts) <= 0) {
            $this->sorts = $this->classname::getSorts();
        }
    }

    public function initQuery($query = null): QueryBuilder
    {
        if ($query) {
            $builder = QueryBuilder::for($query);
        } else {
            $builder = QueryBuilder::for($this->classname);
        }

        return $builder
            ->allowedFilters($this->filters)
            ->allowedIncludes($this->includes)
            ->allowedSorts($this->sorts);
    }

    public function getPerPageNumber(): int
    {
        $requestedPerPage = request()->input('per_page', 0);

        if ($requestedPerPage > 0) {
            return $requestedPerPage;
        } else {
            return config('skribix.per_page', 25);
        }
    }


    public function addCriteria(string $arrayName, ...$elements): void
    {
        foreach ($elements as $element) {
            $this->{$arrayName}[] = $element;
        }
    }

    /**
     * @return string
     */
    public function getClassname(): string
    {
        return $this->classname;
    }

    /**
     * @param string $classname
     */
    public function setClassname(string $classname): void
    {
        $this->classname = $classname;
    }

    /**
     * @return array
     */
    public function getIncludes(): array
    {
        return $this->includes;
    }

    /**
     * @param array $includes
     */
    public function setIncludes(array $includes): void
    {
        $this->includes = $includes;
    }

    /**
     * @return array
     */
    public function getSorts(): array
    {
        return $this->sorts;
    }

    /**
     * @param array $sorts
     */
    public function setSorts(array $sorts): void
    {
        $this->sorts = $sorts;
    }
}
