<?php

namespace RestApiBundle\Resource\Pagination;

use RestApiBundle\Resource\Filtering\FilterDefinitionInterface;
use Doctrine\ORM\UnexpectedResultException;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\PaginatedRepresentation;

abstract class AbstractPagination implements PaginationInterface
{
    public function paginate(Page $page, FilterDefinitionInterface $filter)
    {
        $resources = $this->getResourceFilter()->getResources($filter)
            ->setFirstResult($page->getOffset())
            ->setMaxResults($page->getLimit())
            ->getQuery()
            ->getResult();

        $resourceCount = $pages = null;

        try {
            $resourceCount = $this->getResourceFilter()->getResourceCount($filter)
                ->getQuery()
                ->getSingleScalarResult();
            $pages = ceil($resourceCount / $page->getLimit());
        } catch (UnexpectedResultException $e) {

        }

        return new PaginatedRepresentation(
            new CollectionRepresentation($resources),
            $this->getRouteName(),
            $filter->getQueryParameters(),
            $page->getPage(),
            $page->getLimit(),
            $pages,
            null,
            null,
            false,
            $resourceCount
        );
    }
}