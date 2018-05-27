<?php

namespace RestApiBundle\Resource\Filtering;

interface FilterDefinitionInterface
{
    public function getQueryParameters();
    public function getQueryParamsBlacklist();
    public function getParameters();
}