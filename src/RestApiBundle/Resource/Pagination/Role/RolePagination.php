<?php

namespace RestApiBundle\Resource\Pagination\Role;

use RestApiBundle\Resource\Filtering\ResourceFilterInterface;
use RestApiBundle\Resource\Filtering\Role\RoleResourceFilter;
use RestApiBundle\Resource\Pagination\AbstractPagination;
use RestApiBundle\Resource\Pagination\PaginationInterface;

class RolePagination
    extends AbstractPagination
    implements PaginationInterface
{
    const ROUTE = 'get_movie_roles';

    /**
     * @var RoleResourceFilter
     */
    private $resourceFilter;

    public function __construct(RoleResourceFilter $resourceFilter)
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