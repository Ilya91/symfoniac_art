<?php

namespace RestApiBundle\Resource\Filtering;

use Doctrine\ORM\QueryBuilder;

interface ResourceFilterInterface
{
    public function getResources($filter);
    public function getResourceCount($filter);
}