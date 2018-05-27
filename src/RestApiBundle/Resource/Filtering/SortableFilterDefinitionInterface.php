<?php

namespace RestApiBundle\Resource\Filtering;

interface SortableFilterDefinitionInterface
{
    public function getSortByQuery();
    public function getSortByArray();
}