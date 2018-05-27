<?php

namespace RestApiBundle\Resource\Filtering\Role;

use RestApiBundle\Resource\Filtering\AbstractFilterDefinitionFactory;
use RestApiBundle\Resource\Filtering\FilterDefinitionFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class RoleFilterDefinitionFactory
    extends AbstractFilterDefinitionFactory
    implements FilterDefinitionFactoryInterface
{
    const ACCEPTED_SORT_FIELDS = ['playedName', 'movie'];

    public function factory(Request $request, $movie)
    {
        return new RoleFilterDefinition(
            $request->get('playedName'),
            $movie,
            $request->get('sortBy'),
            $this->sortQueryToArray($request->get('sortBy'))
        );
    }

    public function getAcceptedSortFields()
    {
        return self::ACCEPTED_SORT_FIELDS;
    }
}