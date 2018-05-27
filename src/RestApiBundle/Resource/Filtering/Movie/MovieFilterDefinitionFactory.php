<?php

namespace RestApiBundle\Resource\Filtering\Movie;

use RestApiBundle\Resource\Filtering\AbstractFilterDefinitionFactory;
use RestApiBundle\Resource\Filtering\FilterDefinitionFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MovieFilterDefinitionFactory
    extends AbstractFilterDefinitionFactory
    implements FilterDefinitionFactoryInterface
{
    const ACCEPTED_SORT_FIELDS = ['id', 'title', 'year', 'time'];

    public function factory(Request $request)
    {
        return new MovieFilterDefinition(
            $request->get('title'),
            $request->get('yearFrom'),
            $request->get('yearTo'),
            $request->get('timeFrom'),
            $request->get('timeTo'),
            $request->get('sortBy'),
            $this->sortQueryToArray($request->get('sortBy'))
        );
    }

    public function getAcceptedSortFields()
    {
        return self::ACCEPTED_SORT_FIELDS;
    }
}