<?php

namespace RestApiBundle\Resource\Pagination\Movie;

use RestApiBundle\Resource\Filtering\Movie\MovieResourceFilter;
use RestApiBundle\Resource\Filtering\ResourceFilterInterface;
use RestApiBundle\Resource\Pagination\AbstractPagination;
use RestApiBundle\Resource\Pagination\PaginationInterface;

class MoviePagination
    extends AbstractPagination
    implements PaginationInterface
{
    const ROUTE = 'get_movies';
    /**
     * @var MovieResourceFilter
     */
    private $resourceFilter;

    public function __construct(MovieResourceFilter $resourceFilter)
    {
        $this->resourceFilter = $resourceFilter;
    }

    public function getResourceFilter()
    {
        return $this->resourceFilter;
    }

    public function getRouteName()
    {
        return self::ROUTE;
    }
}