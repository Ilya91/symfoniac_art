<?php

namespace RestApiBundle\Resource\Filtering;

abstract class AbstractFilterDefinition implements FilterDefinitionInterface
{
    const QUERY_PARAMS_BLACKLIST = ['sortByArray'];

    public function getQueryParameters()
    {
        return array_diff_key(
            $this->getParameters(),
            array_flip($this->getQueryParamsBlacklist())
        );
    }

    public function getQueryParamsBlacklist()
    {
        return self::QUERY_PARAMS_BLACKLIST;
    }
}