<?php

namespace RestApiBundle\Resource\Pagination\Person;

use RestApiBundle\Resource\Filtering\Person\PersonResourceFilter;
use RestApiBundle\Resource\Filtering\ResourceFilterInterface;
use RestApiBundle\Resource\Pagination\AbstractPagination;
use RestApiBundle\Resource\Pagination\PaginationInterface;

class PersonPagination
    extends AbstractPagination
    implements PaginationInterface
{
    const ROUTE = 'get_humans';

    /**
     * @var PersonResourceFilter
     */
    private $resourceFilter;

    public function __construct(PersonResourceFilter $resourceFilter)
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