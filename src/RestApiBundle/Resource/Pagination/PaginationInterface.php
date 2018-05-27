<?php

namespace RestApiBundle\Resource\Pagination;

use RestApiBundle\Resource\Filtering\FilterDefinitionInterface;
use RestApiBundle\Resource\Filtering\ResourceFilterInterface;
use Hateoas\Representation\PaginatedRepresentation;

interface PaginationInterface
{
    public function paginate(Page $page, FilterDefinitionInterface $filter);
    public function getResourceFilter();
    public function getRouteName();
}