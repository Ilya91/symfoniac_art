<?php

namespace RestApiBundle\Resource\Filtering;

interface FilterDefinitionFactoryInterface
{
    public function sortQueryToArray($sortByQuery);
    public function getAcceptedSortFields();
}